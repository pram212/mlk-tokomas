const $search_box_product = $("#product_search");
const $cart_table = $("#cart-table");
const $btn_redeem_coupon = $("#btn_redeem_coupon");
const $btn_discount = $("#btn_discount_percent");
const $btn_modal_tax = $("#modalTax");
const $input_redeem_coupon = $("#coupon_code");
const $input_discount_percent = $("#discount_percent");
const $hdn_coupon_code = $("input[name='coupon_code_val']");

const cart_info = {
    coupon: {
        code: "",
        amount: 0,
        type: "",
    },
    tax: 0,
    discount: 0,
};

const tax = {
    id: 0,
    rate: 0,
    data: [],
};

/* init datatable */
const $cartTable = $cart_table.DataTable({
    paging: true,
    searching: false,
    info: false,
    ordering: false,
    dom: 't<"row"<"col-md-12 "p>>',
    lengthChange: false,
    lengthMenu: [5],
});

$(function () {
    /* search product autocomplete */
    $search_box_product.autocomplete({
        source: function (request, response) {
            /* get product from api */
            const warehouse_id = $("select[id='warehouse_id']").val();
            $.ajax({
                url: baseUrl + "/api/products",
                type: "GET",
                data: {
                    search: request.term,
                    warehouse_id: warehouse_id,
                },
                success: function (data) {
                    const products = data.map((product) => {
                        return {
                            label: `${product.name} (${product.code})`,
                            value: product.code,
                        };
                    });

                    response(products);
                },
            });
        },
        // on select product
        select: function (event, ui) {
            const product_id = ui.item.value;
            addProductToCart(product_id);

            // clear search box
            $search_box_product.val("");
            return false;
        },
    });

    /* remove product from cart */
    $cart_table.on("click", ".remove-product", handleCartRemoveProduct);

    /* on click plus minus button */
    $cart_table.on("click", ".btn-qty-counter", handleCartQtyCounter);

    /* Modal Coupon */
    $btn_redeem_coupon.click(handleReedemCoupon);

    /* Modal Discount */
    $btn_discount.click(handleDiscount);

    /* Modal Tax */
    $("#btn_modal_tax").click(handleModalTax);

    $("#btn_submit_tax").click(handleModalTaxSubmit);
});

function handleCartRemoveProduct() {
    $cartTable.row($(this).parents("tr")).remove().draw();
    updateInfo();
}

function handleCartQtyCounter() {
    const $qty_input = $(this)
        .parents(".input-group")
        .find("input[name='qty[]']");
    const qty = parseInt($qty_input.val());
    const max_qty = parseInt($qty_input.attr("max"));
    const type = $(this).data("type");

    if (type === "plus") {
        /* Make sure user just can add product with qty 1 */
        if (countTotalQty() + 1 > 1) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "You just can add 1 qty product in cart",
            });
            $search_box_product.autocomplete("close");
            return;
        }

        if (qty < max_qty) $qty_input.val(qty + 1);
        else Swal.fire("Error", "Quantity is not enough", "error");
    }

    if (type === "minus") {
        if (qty > 1) $qty_input.val(qty - 1);
        else Swal.fire("Error", "Quantity can't be less than 1", "error");
    }

    updateSubtotalItem($(this).parents("tr"));
}

function handleReedemCoupon() {
    /* check if there minimum 1 product in cart */
    if (countTotalItems() < 1) {
        // show alert error
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Cart is empty, please add product first",
        });
        return;
    }

    // create axios request to redeem coupon code
    axios
        .get(
            baseUrl + "/api/coupons/redeem/?code=" + $input_redeem_coupon.val()
        )
        .then(function (response) {
            const data = response.data;

            if (!data.status) {
                // show alert error
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: data.message,
                });
                return;
            }

            /* check minimum amount */
            if (calculateSubtotal() < data.data.minimum_amount) {
                // show alert error
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Minimum amount not reached",
                });
                return;
            }

            // set coupon code to input
            $hdn_coupon_code.val(data.data.code);
            cart_info.coupon.code = data.data.code;
            cart_info.coupon.amount = data.data.amount;
            cart_info.coupon.type = data.data.type;

            // show alert success
            Swal.fire({
                icon: "success",
                title: "Success",
                text: data.message,
            });

            /*modal close*/
            $("#modalCoupon").modal("hide");

            updateInfo();
        })
        .catch(function (error) {
            const response = error.response.data;

            // show alert error
            Swal.fire({
                icon: "error",
                title: "Error",
                text: response.message,
            });
        });
}

function handleModalTax() {
    /* check if there is minimum 1 data_tax */
    if (tax.data.length < 1) {
        axios
            .get(baseUrl + "/api/tax")
            .then(function (response) {
                tax.data = response.data.data;

                /* set tax data to select option */
                const $select_tax = $("#select_tax");
                $select_tax.selectpicker("destroy");

                $select_tax.html("");

                tax.data.forEach((datatax) => {
                    $select_tax.append(
                        `<option value="${datatax.id}" ${
                            datatax.id === tax.id ? "selected" : ""
                        } data-rate="${datatax.rate}">${datatax.name} (${
                            datatax.rate
                        }%)</option>`
                    );
                });

                $select_tax.selectpicker();
            })
            .catch(function (error) {
                console.error("Error fetching tax data:", error);
            });
    }
}

function handleModalTaxSubmit() {
    const $select_tax = $("#select_tax");
    tax.id = $select_tax.val();
    tax.rate = $select_tax.find("option:selected").data("rate");

    $("#modalTax").modal("hide");
    updateInfo();
}

function handleDiscount() {
    /* check if there minimum 1 product in cart */
    if (countTotalItems() < 1) {
        // show alert error
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Cart is empty, please add product first",
        });
        return;
    }

    /* check if discount percent is empty */
    if ($input_discount_percent.val() === "") {
        // show alert error
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Discount percent is empty",
        });
        return;
    }

    /* check if discount percent is more than 100 */
    if (parseInt($input_discount_percent.val()) > 100) {
        // show alert error
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Discount percent is more than 100",
        });
        return;
    }

    // set discount percent
    cart_info.discount = parseInt($input_discount_percent.val());

    // show alert success
    Swal.fire({
        icon: "success",
        title: "Success",
        text: "Discount percent has been set",
    });

    /*modal close*/
    $("#modalDiscount").modal("hide");

    updateInfo();
}

function addProductToCart(product_code) {
    /* check if product already exist in cart, then increase qty */
    if (isProductExistInCart(product_code)) {
        // addQtyByProductId(product_code);
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "You can't add the same product twice",
        });
        $search_box_product.autocomplete("close");
        return;
    }

    /* Make sure user just can add product with qty 1 */

    /* Make sure just 1 product in cart */
    if (countTotalItems() > 0) {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "You can't add more than 1 product",
        });
        $search_box_product.autocomplete("close");
        return;
    }

    /* get product data, then add to cart */
    $.ajax({
        url: baseUrl + "/api/products/getByCode/?code=" + product_code,
        type: "GET",
        success: function (data) {
            const product = data;

            // add product to cart
            $cartTable.row.add([
                `${product.name} (${product.code})
                <br>
                <small>In Stock: 1</small>
                    <input type='hidden' name='product_id[]' value="${product.code}">`,
                product.price,
                `
                <div>
                <div class="input-group">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default minus btn-qty-counter" data-type="minus">
                            <span class="dripicons-minus"></span>
                        </button>
                    </span>
                    <input type="text" name="qty[]" data-product_id="${product.code}" class="form-control qty numkey input-number" step="any" value="1" min="1" max="1" readonly>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default plus btn-qty-counter" data-type="plus">
                            <span class="dripicons-plus"></span>
                        </button>
                    </span>
                </div>
                </div>
                `,
                product.price,
                `<button type="button" class="btn btn-danger btn-sm remove-product"><i class="dripicons-trash"></i></button>`,
            ]);
            $cartTable.draw();
            updateInfo();
        },
    });
}

function isProductExistInCart(product_code) {
    /* get product id from product_id[] input */
    const product_ids = $("input[name='product_id[]']");
    const product_ids_array = [];

    product_ids.each(function () {
        product_ids_array.push($(this).val());
    });

    return product_ids_array.includes(product_code);
}

function updateSubtotalItem($tr) {
    const price = parseFloat($tr.find("td:eq(1)").text());
    const qty = parseInt($tr.find("input[name='qty[]']").val());
    const subtotal = price * qty;

    $tr.find("td:eq(3)").text(formatMoney(subtotal));
    updateInfo();
}

function addQtyByProductId(product_id) {
    /* get qty input by product_id */
    const $qty_input = $(`input[data-product_id='${product_id}']`);

    const qty = parseInt($qty_input.val());

    if (qty < parseInt($qty_input.attr("max"))) $qty_input.val(qty + 1);
    else Swal.fire("Error", "Quantity is not enough", "error");

    updateSubtotalItem($qty_input.parents("tr"));
    updateInfo();
}

function calculateSubtotal() {
    let total = 0;

    if (countTotalItems() > 0) {
        $cartTable.rows().every(function () {
            const data = this.data();
            const price = formatMoneyToDecimal(data[3]);
            const qty = parseInt(
                $(this.node()).find("input[name='qty[]']").val()
            );

            total += price * qty;
        });
    }

    return total;
}

function calculateGrandTotal() {
    let grand_total = 0;

    grand_total = calculateSubtotal();
    grand_total -= calculateCouponDiscount();
    grand_total -= calculateDiscountPercent();
    grand_total += calculateTax();

    grand_total = Math.ceil(grand_total);

    return grand_total;
}

function calculateCouponDiscount() {
    let discount = 0;
    const subtotal = calculateSubtotal();

    if (cart_info.coupon.type === "percentage") {
        discount = Math.ceil((cart_info.coupon.amount / 100) * subtotal);
    } else {
        discount = cart_info.coupon.amount;
    }

    return discount;
}

function calculateDiscountPercent() {
    return Math.ceil((cart_info.discount / 100) * calculateSubtotal());
}

function calculateTax() {
    return Math.ceil((parseFloat(tax.rate) / 100) * calculateSubtotal());
}

/* info section */
function updateInfo() {
    const $info_total_items = $("#info-total-items");
    const $info_subtotal = $("#info-subtotal");
    const $info_coupon = $("#info-coupon");
    const $info_tax = $("#info-tax");
    const $info_discount = $("#info-discount");
    const $grand_total = $("#grand-total");

    $info_total_items.text(`${countTotalItems()}(${countTotalQty()})`);
    $info_subtotal.text(formatMoney(calculateSubtotal()));
    $info_coupon.text(formatMoney(calculateCouponDiscount()));
    $info_discount.text(formatMoney(calculateDiscountPercent()));
    $info_tax.text(formatMoney(calculateTax()));
    $grand_total.text(formatMoney(calculateGrandTotal(), { showSymbol: true }));
}

function countTotalItems() {
    const total_items = $cartTable.rows().count();
    return total_items;
}

function countTotalQty() {
    let total_qty = 0;
    $cartTable.rows().every(function () {
        const qty = parseInt($(this.node()).find("input[name='qty[]']").val());
        total_qty += qty;
    });

    return total_qty;
}
