$("ul#warehouse_transfer").siblings("a").attr("aria-expanded", "true");
$("ul#warehouse_transfer").addClass("show");
$("ul#warehouse_transfer #warehouse_transfer-list-menu").addClass("active");

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
    /* check if product exist in table */
    if (isProductExistInTable(product_code)) {
        Swal.fire("Product already exist in table", "", "warning");
        return;
    }

    /* get product data, then add to table */
    $.ajax({
        url: baseUrl + "/api/products/getByCode/?code=" + product_code,
        type: "GET",
        success: function (data) {
            const product = data;

            // add product to table
            $dataTable.row.add([
                `${product.name} (${product.code})<input type='hidden' name='product_code[]' value="${product.code}">`,
                product.code,
                `<button type="button" class="btn btn-danger btn-sm remove-product"><i class="dripicons-trash"></i></button>`,
            ]);
            $dataTable.draw();
        },
    });
}

function isProductExistInTable(product_code) {
    /* get product id from product_code[] input */
    const product_codes = $("input[name='product_code[]']");
    const product_codes_array = [];

    product_codes.each(function () {
        product_codes_array.push($(this).val());
    });

    return product_codes_array.includes(product_code);
}
