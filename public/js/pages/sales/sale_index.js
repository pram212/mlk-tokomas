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
const $saleTable = $("#sale-table");
const $saleDataTable = $saleTable.DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: baseUrl + "/api/sales",
        type: "GET",
        dataType: "json",
        data: function (d) {
            d.warehouse_id = $("#warehouse_id").val();
            d.start_date = $("#start_date").val();
            d.end_date = $("#end_date").val();
        },
    },
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
        { data: "user.name", name: "user.name" },
        { data: "customer.name", name: "customer.name" },
        { data: "grand_total", name: "grand_total", className: "text-right" },
        { data: "options", name: "options" },
    ],
    order: [["1", "desc"]],
    columnDefs: [
        {
            orderable: false,
            targets: [0, 2, 6],
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
        sumDatatableColumn(api, 5);
    },
});

const modal_add_payment = $("#add-payment");
const filter_btn = $("#filter-btn");

// on ready
$(function () {
    // init datepicker
    $(".datepicker").datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        orientation: "bottom",
    });

    // set data selectpicker warehouse_id
    getWarehouse().then((response) => {
        const status = response.status;
        const data = response.data;
        const message = response.message;

        if (!status) return;

        let warehouse_id = $("select[name='warehouse_id']");

        warehouse_id.html("");

        data.forEach((warehouse) => {
            warehouse_id.append(
                `<option value="${warehouse.id}">${warehouse.name}</option>`
            );
        });

        // refresh selectpicker
        warehouse_id.selectpicker("refresh");
    });
});

// on click filter_btn
filter_btn.on("click", reloadDatatable);

function reloadDatatable() {
    $saleDataTable.ajax.reload();
}

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

// axios get request [GET] pos-setting and return the response
function getPosSetting() {
    return axios.get(baseUrl + "/pos-setting").then((response) => {
        return response.data;
    });
}

// axios get request [GET] warehouse and return the response
function getWarehouse() {
    return axios.get(baseUrl + "/api/warehouses").then((response) => {
        return response.data;
    });
}

// axios get request [GET] account and return the response
function getAccount() {
    return axios.get(baseUrl + "/sales/account").then((response) => {
        return response.data;
    });
}
