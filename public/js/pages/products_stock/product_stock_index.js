var warehouse = [];
var variant = [];
var qty = [];
var htmltext;
var slidertext;
var product_id = [];
const $filter_warehouse = $("#filter_warehouse");
const $filter_status = $("#filter_status");
const $table = $("#product-data-table");
const table = $table.DataTable({
    responsive: true,
    fixedHeader: {
        header: true,
        footer: true,
    },
    processing: true,
    serverSide: true,
    fixedColumns: {
        start: 1,
        end: 1,
    },
    scrollX: true,
    ajax: {
        url: baseUrl + "/product-datatable",
        dataType: "json",
        type: "get",
    },
    columns: [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            orderable: false,
            searchable: false,
        },
        // {
        //     data: "barcode",
        // },
        {
            data: "code",
            render: function (data, type, row) {
                const product_id = row.id;
                const split_set_code = row.split_set_code ?? "";
                let param = product_id;
                if (split_set_code) {
                    param = product_id + "/?split_set_code=" + split_set_code;
                }
                return (
                    '<a href="' +
                    baseUrl +
                    "/products/" +
                    param +
                    '" class="btn-detail-product" style="color: blue">' +
                    data +
                    "</a>"
                );
            },
            responsivePriority: 1,
        },

        {
            data: "name",
            responsivePriority: 1,
        },
        {
            data: "image_preview",
            orderable: false,
            responsivePriority: 1,
            className: "none",
        },
        {
            data: "warehouse_name",
            responsivePriority: 1,
        },
        {
            data: "created_at",
        },
        {
            data: "price",
            searchable: false,
            responsivePriority: 1,
            className: "text-right",
        },
        {
            data: "tag_type_code",
            responsivePriority: 10001,
            className: "none",
        },
        {
            data: "tag_type_color",
            responsivePriority: 10001,
            className: "none",
        },
        {
            data: "mg",
            responsivePriority: 10001,
            className: "none",
        },
        {
            data: "gramasi_gramasi",
            responsivePriority: 10001,
            className: "none",
        },
        {
            data: "product_property_description",
            responsivePriority: 1,
            className: "none",
        },
        {
            data: "product_status",
            responsivePriority: 1,
        },
        {
            data: "invoice_number",
            responsivePriority: 1,
            className: "none",
        },
    ],
    order: [["3", "desc"]],
    columnDefs: [],
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"],
    ],
    dom: '<"row"lfB>rtip',
    buttons: [],
});

$(function () {
    getFilterWarehouseData()
        .then((items) => {
            $filter_warehouse.selectpicker("destroy").filterMultiSelect({
                selectAllText: "Select All",
                placeholderText: "Click to filter by warehouse",
                filterText: "Search",
                labelText: "Warehouse",
                caseSensitive: false,
                items: items,
            });

            // Detach previous event listeners before attaching new ones
            $(this).off("optionselected optiondeselected");
            $(this).on("optionselected optiondeselected", function (event) {
                filterProduct();
            });
        })
        .catch((error) => {
            console.error("Error initializing filter category:", error);
        });

    getFilterStatus()
        .then((items) => {
            $filter_status.selectpicker("destroy").filterMultiSelect({
                selectAllText: "Select All",
                placeholderText: "Click to filter by product status",
                filterText: "Search",
                labelText: "Status",
                caseSensitive: false,
                items: items,
            });

            // Detach previous event listeners before attaching new ones
            $(this).off("optionselected optiondeselected");
            $(this).on("optionselected optiondeselected", function (event) {
                filterProduct();
            });
        })
        .catch((error) => {
            console.error("Error initializing filter category:", error);
        });
});

function getFilterWarehouseData() {
    return new Promise((resolve, reject) => {
        axios
            .get(baseUrl + "/api/warehouses")
            .then((response) => {
                const items = response.data.data.map((item) => [
                    item.name,
                    item.id,
                ]);
                resolve(items);
            })
            .catch((error) => {
                reject(error);
            });
    });
}

function getFilterStatus() {
    return new Promise((resolve, reject) => {
        axios
            .get(baseUrl + "/api/common/product-status")
            .then((response) => {
                const items = response.data.data.map((item) => [
                    item.name,
                    item.id,
                ]);
                resolve(items);
            })
            .catch((error) => {
                reject(error);
            });
    });
}

function filterProduct() {
    const warehouse_ids = filterMultiSelect_getJson(false).filter_warehouse;
    const status_ids = filterMultiSelect_getJson(false).filter_status;
    table.ajax.url(
        baseUrl +
            "/product-datatable" +
            "?warehouse_ids=" +
            warehouse_ids +
            "&status_ids=" +
            status_ids
    );
    table.ajax.reload();
}
