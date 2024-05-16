const sale_date = $("#sale-date");
const sale_reference = $("#sale-reference");
const sale_warehouse = $("#sale-warehouse");
const sale_status = $("#sale-status");
const biller_name = $("#biller-name");
const biller_company = $("#biller-company");
const biller_email = $("#biller-email");
const customer_name = $("#customer-name");
const customer_phone_number = $("#customer-phone-number");
const customer_address = $("#customer-address");
const table = $(".product-sale-list");
const table_body = $(".product-sale-list tbody");
const sale_footer = $("#sale-footer");
const sale_details = $("#sale-details");
const print_btn = $("#print-btn");

// datatable
saleTable = $("#sale-table").DataTable({
    processing: true,
    serverSide: true,
    ajax: baseUrl + "/sales/datatables",
    columns: [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            orderable: false,
            searchable: false,
            className: "text-center",
        },
        { data: "created_at", name: "created_at" },
        { data: "reference_no", name: "reference_no" },
        { data: "biller.name", name: "biller.name" },
        { data: "customer.name", name: "customer.name" },
        { data: "sale_status", name: "sale_status" },
        { data: "payment_status", name: "payment_status" },
        { data: "grand_total", name: "grand_total" },
        { data: "paid_amount", name: "paid_amount" },
        { data: "options", name: "options" },
    ],
    order: [["1", "desc"]],
    columnDefs: [
        {
            orderable: false,
            targets: [0, 2, 9],
        },
    ],
    dom: '<"row"lfB>rtip',
    language: {
        lengthMenu: `_MENU_ ${lang_records_per_page}`,
        info: `<small>${lang_Showing} _START_ - _END_ (_TOTAL_)</small>`,
        search: `${lang_search}`,
        paginate: {
            previous: '<i class="dripicons-chevron-left"></i>',
            next: '<i class="dripicons-chevron-right"></i>',
        },
    },
    buttons: [
        {
            extend: "pdf",
            text: lang_PDF,
            exportOptions: {
                columns: ":visible:Not(.not-exported)",
                rows: ":visible",
            },
            footer: true,
        },
        {
            extend: "csv",
            text: lang_CSV,
            exportOptions: {
                columns: ":visible:Not(.not-exported)",
                rows: ":visible",
            },
            footer: true,
        },
        {
            extend: "print",
            text: lang_print,
            exportOptions: {
                columns: ":visible:Not(.not-exported)",
                rows: ":visible",
            },
            footer: true,
        },
        {
            extend: "colvis",
            text: lang_visibility,
            columns: ":gt(0)",
        },
    ],
    drawCallback: function () {
        var api = this.api();
        sumDatatableColumn(api, 7);
        sumDatatableColumn(api, 8);
    },
});

// View sale button action
$(document).on("click", ".view", function () {
    // Get the record's ID via attribute
    var sale_id = $(this).attr("data-id");
    saleDetails(sale_id);
});

// Print button action
print_btn.on("click", function () {
    var divToPrint = document.getElementById("sale-details");
    var newWin = window.open("", "Print-Window");
    newWin.document.open();
    newWin.document.write(
        '<link rel="stylesheet" href="' +
            asset_url +
            '" type="text/css"><style type="text/css">@media print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">' +
            divToPrint.innerHTML +
            "</body>"
    );
    newWin.document.close();
    setTimeout(function () {
        newWin.close();
    }, 10);
});

// View payment button action
$(document).on("click", "table.sale-list tbody .get-payment", function (event) {
    const id = $(this).data("id");

    axios.get(baseUrl + "/sales/payment/" + id).then((response) => {
        const status = response.data.status;
        const data = response.data.data;
        const message = response.data.message;
        const paymentListTableBody = $(".payment-list tbody");

        paymentListTableBody.html("");

        if (!status) {
            Swal.fire({ icon: "error", title: "Error", text: message });
            return;
        }

        data.forEach((payment, index) => {
            paymentListTableBody.append(`
                <tr>
                    <td>${index + 1}</td>
                    <td>${payment.created_at}</td>
                    <td>${payment.payment_reference}</td>
                    <td>${payment.account.name}</td>
                    <td>${payment.amount}</td>
                    <td>${payment.user.name}</td>
                </tr>
            `);
            console.log(paymentListTableBody);
        });

        $("#view-payment").modal("show");
    });
});

// formating number to rupiah and add prefix
function formatRupiahs(angka, prefix) {
    var number_string = angka.toString(),
        split = number_string.split("."),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        var separator = sisa ? "," : "";
        rupiah += separator + ribuan.join(",");
    }

    rupiah = split[1] !== undefined ? rupiah + "." + split[1] : rupiah + ".00";
    return prefix === undefined ? rupiah : prefix + rupiah;
}

// Sum the datatable column
function sumDatatableColumn(api, column) {
    var sum = api
        .column(column, { search: "applied" })
        .data()
        .reduce(function (a, b) {
            // Remove non-numeric characters
            a = a.toString().replace(/[^\d.-]/g, "");
            b = b.toString().replace(/[^\d.-]/g, "");

            // Convert to float and add them together
            return parseFloat(a) + parseFloat(b);
        }, 0);

    // Format the sum to two decimal places
    sum = sum.toFixed(2);

    $(api.column(column).footer()).html(formatRupiahs(sum, "Rp "));
}

// Get the sale details
function saleDetails(sale_id) {
    $("#sale-details input[name='sale_id']").val(sale_id);

    // axios get request [GET] sales/details/{id}
    axios
        .get(baseUrl + "/sales/details/" + sale_id)
        .then((response) => {
            const status = response.data.status;
            const data = response.data.data;
            const message = response.data.message;

            // Check if the response is successful
            if (!status) {
                Swal.fire({ icon: "error", title: "Error", text: message });
                return;
            }

            // Set the data
            sale_date.html(data.date);
            sale_reference.html(data.invoice_number);
            sale_warehouse.html(data.warehouse.name);
            sale_status.html(data.sale_status);
            biller_name.html(data.biller.name);
            biller_company.html(data.biller.company_name);
            biller_email.html(data.biller.email);
            customer_name.html(data.customer.name);
            customer_phone_number.html(data.customer.phone_number);
            customer_address.html(data.customer.address);

            // Clear the table
            table_body.html("");

            // Set the products
            let htmltext = "";
            let htmlfooter = "";
            let total_qty = 0;
            let total_discount = 0;
            let total_tax = 0;
            const product_sale = data.product_sale;
            const user = data.user;

            product_sale.forEach((product_sale, index) => {
                let qty = product_sale.qty;
                const product = product_sale.product;
                const subtotal = parseFloat(product.price) * parseFloat(qty);

                htmltext += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${product.name} (${product.code})</td>
                        <td>${qty}</td>
                        <td>${product.price}</td>
                        <td>${product_sale.tax}(${product_sale.tax_rate}%)</td>
                        <td>${product_sale.discount}</td>
                        <td>${subtotal}</td>
                    </tr>
                `;
            });

            const product_sale_first = product_sale[0];
            const product_first = product_sale_first.product;
            const tax = parseFloat(product_sale_first.tax);
            const qty = product_sale_first.qty;
            const subtotal = parseFloat(product_first.price) * parseFloat(qty);
            const discount = parseFloat(product_sale_first.discount);
            const shipping_cost = parseFloat(data.shipping_cost);
            const grand_total = parseFloat(data.grand_total);
            const paid_amount = parseFloat(data.paid_amount);

            htmltext += `<tr><td colspan="4" class="text-left"><strong>Jumlah:</strong></td><td>${tax}</td><td>${discount}</td><td>${subtotal}</td></tr>`;
            htmltext += `<tr><td colspan="6" class="text-left"><strong>Pajak Pesanan:</strong></td><td>${tax}</td></tr>`;
            htmltext += `<tr><td colspan="6" class="text-left"><strong>Diskon Pesanan:</strong></td><td>${discount}</td></tr>`;
            htmltext += `<tr><td colspan="6" class="text-left"><strong>Biaya Pengiriman:</strong></td><td>${shipping_cost}</td></tr>`;
            htmltext += `<tr><td colspan="6" class="text-left"><strong>Grand Total:</strong></td><td>${grand_total}</td></tr>`;
            htmltext += `<tr><td colspan="6" class="text-left"><strong>Jumlah Dibayarkan:</strong></td><td>${paid_amount}</td></tr>`;

            htmlfooter += `
                <tr>
                    <td colspan="2" class="text-right"><strong>Total</strong></td>
                    <td><strong>${total_qty}</strong></td>
                    <td></td>
                    <td><strong>${formatRupiahs(
                        total_discount,
                        "Rp "
                    )}</strong></td>
                    <td><strong>${formatRupiahs(total_tax, "Rp ")}</strong></td>
                    <td></td>
                    <td><strong>${formatRupiahs(
                        grand_total,
                        "Rp "
                    )}</strong></td>
                </tr>
            `;

            table_body.html(htmltext);

            // set footer
            const sale_note = $("#sale-note");
            const sale_staff_note = $("#sale-staff-note");
            const sale_user_name = $("#sale-user-name");
            const sale_user_email = $("#sale-user-email");

            sale_note.text(product_sale_first.sale_note);
            sale_staff_note.text(product_sale_first.staff_note);
            sale_user_name.text(user.name);
            sale_user_email.text(user.email);

            // sale_footer.html(htmlfooter);
            sale_details.modal("show");
        })
        .catch((error) => {
            console.error(error);
        });
}
