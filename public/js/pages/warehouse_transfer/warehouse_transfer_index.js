$("ul#warehouse_transfer").siblings("a").attr("aria-expanded", "true");
$("ul#warehouse_transfer").addClass("show");
$("ul#warehouse_transfer #warehouse_transfer-list-menu").addClass("active");

const $table = $("#data-table");
const $datatable = $table.DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: baseUrl + "/api/warehouse-transfers",
        type: "GET",
        dataType: "json",
        data: function (d) {
            // d.warehouse_id = $("#warehouse_id").val();
            // d.start_date = $("input[name='starting_date']").val();
            // d.end_date = $("input[name='ending_date']").val();
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
        {
            data: "product.name",
            name: "product.name",
            render: function (data, type, row) {
                return `${data} (${row.code ?? row.product.code})`;
            },
        },
        { data: "status_warehouse", name: "status_warehouse" },
        { data: "created_at", name: "created_at" },
        {
            data: "action",
            orderable: false,
            searchable: false,
            responsivePriority: 1,
        },
    ],
    order: [["2", "desc"]],
    columnDefs: [
        // {
        //     orderable: false,
        //     targets: [0, 2, 9],
        // },
    ],
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
        // var api = this.api();
        // sumDatatableColumn(api, 7);
        // sumDatatableColumn(api, 8);
    },
});

// on ready
$(function () {});
