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
