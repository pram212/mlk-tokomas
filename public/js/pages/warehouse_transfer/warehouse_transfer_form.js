const $search_box_product = $("#product_search");
const $table = $("#table");

/* init datatable */
const $dataTable = $table.DataTable({
    paging: true,
    searching: false,
    info: false,
    ordering: false,
    dom: 't<"row"<"col-md-12 "p>>',
    lengthChange: false,
    lengthMenu: [5],
});

$(function () {
    $search_box_product.autocomplete({
        source: function (request, response) {
            /* get product from api */
            $.ajax({
                url: baseUrl + "/api/products",
                type: "GET",
                data: {
                    search: request.term,
                    product_status: 1,
                },
                success: function (data) {
                    const products = data.map((product) => {
                        return {
                            label: `${product.name} (${product.code})`,
                            value: product.id,
                            code: product.code,
                        };
                    });

                    response(products);
                },
            });
        },
        // on select product
        select: function (event, ui) {
            const product_code = ui.item.code;
            addProductToTable(product_code);

            // clear search box
            $search_box_product.val("");
            return false;
        },
    });

    /* remove product from Table */
    $dataTable.on("click", ".remove-product", handleTableRemoveProduct);
});

function handleTableRemoveProduct() {
    $dataTable.row($(this).parents("tr")).remove().draw();
}

function addProductToTable(product_code) {
    /* get product data, then add to table */
    $.ajax({
        url: baseUrl + "/api/products/getByCode/?code=" + product_code,
        type: "GET",
        success: function (data) {
            const product = data;

            // add product to table
            $dataTable.row.add([
                `${product.name} (${product.code})<input type='hidden' name='product_id[]' value="${product.id}">`,
                product.code,
                `<button type="button" class="btn btn-danger btn-sm remove-product"><i class="dripicons-trash"></i></button>`,
            ]);
            $dataTable.draw();
        },
    });
}

function isProductExistInTable(product_id) {
    /* get product id from product_id[] input */
    const product_ids = $("input[name='product_id[]']");
    const product_ids_array = [];

    product_ids.each(function () {
        product_ids_array.push(parseInt($(this).val()));
    });

    return product_ids_array.includes(product_id);
}
