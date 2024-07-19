const table_product_info = $("#table_product_info").DataTable({
    processing: true,
    serverSide: true,
    createdRow: function (row, data, dataIndex) {
        // column 1 as no
        let number = table_product_info.page.info().start + dataIndex + 1;
        $("td", row).eq(0).html(number);
    },
    ajax: {
        url: baseUrl + "/api/products/datatables",
        type: "GET",
    },
    columns: [
        { data: null },
        { data: "code" },
        { data: "name" },
        { data: "price" },
    ],
    columnDefs: [
        {
            targets: [0],
            searchable: false,
        },
        {
            targets: [3],
            render: $.fn.dataTable.render.number(",", ".", 2, "Rp. "),
        },
        {
            targets: [0],
            orderable: false,
        },
    ],
    order: [[1, "desc"]],
    dom: "rtp",
    lengthChange: false,
    pageLength: 5,
});
const $filter_category = $("#filter_category");

$(function () {
    getFilterCategoryData()
        .then((filter_category_list) => {
            $filter_category.selectpicker("destroy").filterMultiSelect({
                selectAllText: "Select All",
                placeholderText: "Click to select a category",
                filterText: "Search",
                labelText: "Category",
                caseSensitive: false,
                items: filter_category_list,
            });

            // filter category change
            $("#filter_category").on("optionselected", function (event) {
                filterProduct();
            });
            $("#filter_category").on("optiondeselected", function (event) {
                filterProduct();
            });
        })
        .catch((error) => {
            console.error("Error initializing filter category:", error);
        });
});

function getFilterCategoryData() {
    return new Promise((resolve, reject) => {
        axios
            .get(baseUrl + "/api/category")
            .then((response) => {
                const filter_category_list = response.data.map((category) => [
                    category.name,
                    category.id,
                ]);
                resolve(filter_category_list);
            })
            .catch((error) => {
                reject(error);
            });
    });
}

function filterProduct() {
    const selected_category = getJson(false).filter_category;
    table_product_info.ajax.url(
        baseUrl + "/api/products/datatables?category_id=" + selected_category
    );
    table_product_info.ajax.reload();
}

var getJson = function (b) {
    var result = $.fn.filterMultiSelect.applied
        .map((e) => JSON.parse(e.getSelectedOptionsAsJson(b)))
        .reduce((prev, curr) => {
            prev = {
                ...prev,
                ...curr,
            };
            return prev;
        });
    return result;
};
