/* many function from sales_pos_cart.js */
const $payment_table = $("#payment_table").DataTable({
    paging: false,
    ordering: false,
    info: false,
    searching: false,
    autoWidth: false,
    responsive: true,
});
const $btn_payment = $("#btn-payment");
const $modal_payment = $("#add-payment");
const $paid_amount = $("#paid_amount");
const $paying_amount = $("#paying_amount");
const $payment_discount = $("#payment_discount");
const $payment_change = $("#payment_change");
const $btn_submit_payment = $("#btn-submit-payment");
const payment_method = [];
const banks = [];

$(function () {
    getPaymentMethod();
    getBanks();
    createQuickCashButton();

    $btn_payment.click(handlePaymentButtonClick);
    $("#btn_payment_add_row").click(addPaymentMethod);
    $("#btn_payment_remove_row").click(removePaymentMethod);

    $payment_table.on("change", ".select-payment", handlePaymentChange);
    $payment_table.on("input", ".format-money", handleMoneyFormat);
    $payment_table.on("click", ".format-money", handleMoneyFormatClick);
    $payment_table.on(
        "input",
        ".format-card-number",
        handleMoneyFormatCardNumber
    );

    // Other Event Bindings
    $(".format-money").on("input", handleMoneyFormat);
    $(".format-money").on("click", handleMoneyFormatClick);

    /* Calculate change */
    $paying_amount.on("change", handlePayingAmountChange);

    /* On Submit Payment */
    $btn_submit_payment.click(handlePaymentSubmitClick);
});

function createQuickCashButton() {
    const $quick_cash = $("#quick_cash");
    const quick_cash = [100000, 200000, 500000, 1000000];
    const clearBtn = `<button class="btn btn-block btn-danger btn-quick-cash" data-amount="0">Clear</button>`;
    quick_cash.forEach((item) => {
        const btn = `<button class="btn btn-block btn-primary btn-quick-cash" data-amount="${item}">${formatMoney(
            item
        )}</button>`;
        $quick_cash.append(btn);
    });

    $quick_cash.append(clearBtn);

    $quick_cash.on("click", ".btn-quick-cash", function () {
        const amount = $(this).data("amount");
        $paying_amount.val(formatMoney(amount));
        calculateChange();
    });
}

function setPaymentMethod() {
    const $payment_method = $("#payment_select_section");
    let payment_option = `<option value="">-- Choose Payment Method --</option>`;
    payment_method.forEach((item) => {
        payment_option += `<option value="${item.id}">${item.name}</option>`;
    });
    const payment = `<select class="form-control select-payment" name="payment_method_id[]" data-live-search="true">${payment_option}</select>`;

    $payment_method.append(payment);
}

function handlePaymentSubmitClick() {
    Swal.fire({
        text: "Processing data..",
        allowOutsideClick: false,
        showConfirmButton: false,
    });

    const $btn = $(this);
    const loading = `Loading...`;
    const text = $btn.html();

    $btn.html(loading).prop("disabled", true);

    try {
        /* Get info */
        const warehouse_id = $("select[id='warehouse_id']").val();
        const customer_id = $("select[id='customer_id']").val();
        const cashier_id = $("select[name='cashier_id']").val();

        /* validate */
        if (warehouse_id === "" || customer_id === "" || cashier_id === "")
            throw new Error("Please select Warehouse, Customer and Cashier");

        /* Get All Item (Qty and Product Id) From cart */
        const items = [];
        $('input[name="qty[]"]').each(function () {
            const qty = $(this).val();
            const product_id = $(this).data("product_id");
            items.push({ qty, product_id });
        });

        /* validate */
        if (items.length === 0) throw new Error("Please add item to cart");

        const coupon_code = cart_info.coupon.code;
        const discount = cart_info.discount;
        const tax = cart_info.tax;

        const paying_amount = formatMoneyToDecimal($paying_amount.val());
        const paid_amount = formatMoneyToDecimal($paid_amount.val());

        /* validate */
        if (paying_amount < paid_amount)
            throw new Error(
                "Received amount must be less than or equal to paying amount"
            );

        const payment_note = $("#payment_note").val();
        const payment_sale_note = $("textarea[name='sale_note']").val();
        const payment_staff_note = $("textarea[name='staff_note']").val();

        /* Payment */
        const payment_methods = $("select[name='payment_method_id[]']").val();
        if (payment_methods === null || payment_methods === "")
            throw new Error("Please select payment method");
        // if (countPaymentMethod() === 0)
        //     throw new Error("Please add at least one payment method");

        /* Get Payment Method */
        // const payment_methods = getPaymentMethodData();

        /* validate */
        // if (!validate_payment_method(payment_methods)) return;

        const data = {
            warehouse_id,
            customer_id,
            cashier_id,
            items,
            coupon_code,
            discount,
            tax,
            paying_amount,
            paid_amount,
            payment_note,
            payment_sale_note,
            payment_staff_note,
            payment_methods,
        };

        axios
            .post(baseUrl + "/api/sales-pos", data)
            .then((response) => {
                const data = response.data.data;
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Transaction success",
                });

                window.location.href =
                    baseUrl + `/sales/gen_invoice/${data.id}`;
                $("#btn-submit-payment").html(text).prop("disabled", false);
            })
            .catch((error) => {
                const msg = error.response.data.message;
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: msg,
                    confirmButtonText: "Close",
                });
                $("#btn-submit-payment").html(text).prop("disabled", false);
            })
            .finally(() => {
                $("#btn-submit-payment").html(text).prop("disabled", false);
            });
    } catch (error) {
        const msg = error.message || "Something went wrong";
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: msg,
            confirmButtonText: "Close",
        }).then(() => {
            $("#btn-submit-payment").html(text).prop("disabled", false);
        });

        $("#btn-submit-payment").html(text).prop("disabled", false);
    }
}

function handlePaymentButtonClick() {
    try {
        if (countTotalItems() === 0) throw new Error("Please add item to cart");

        updatePaymentInfo();
        $modal_payment.modal("show");

        if (countPaymentMethod() === 0) addPaymentMethod();
    } catch (err) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: err.message,
        });
    }
}

function handleMoneyFormatCardNumber() {
    const value = $(this).val();
    $(this).val(value.replace(/\D/g, "").replace(/(.{4})/g, "$1 "));

    if (value.length > 19) {
        $(this).val(value.substring(0, 19));
    }
}

function handlePaymentChange() {
    const payment_method_id = $(this).val();
    const row = $(this).closest("tr");
    const note = row.find(".select-bank");
    const card_number = row.find('input[name="credit_card_number[]"]');

    switch (payment_method_id) {
        case "1":
            note.hide();
            card_number.hide();
            break;
        case "2" || "3":
            note.show();
            card_number.show();
            break;
    }
}

function handlePayingAmountChange() {
    const value = formatMoneyToDecimal($(this).val()) || 0;
    if (value < calculateGrandTotal()) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Paying amount must be greater than or equal to grand total",
        });
        $(this).val(formatMoney(calculateGrandTotal()));
    }

    calculateChange();
}

function handleMoneyFormat() {
    const value = formatMoneyToDecimal($(this).val()) || 0;
    $(this).val(formatMoney(value));
}

function handleMoneyFormatClick() {
    $(this).select();
}

function getPaymentMethod() {
    axios.get(baseUrl + "/api/payment-method").then((response) => {
        const data = response.data.data;

        data.forEach((item) => {
            payment_method.push(item);
        });
        setPaymentMethod();
    });
}

function getBanks() {
    axios.get(baseUrl + "/api/banks/search").then((response) => {
        const data = response.data.data;

        data.forEach((item) => {
            banks.push(item);
        });
    });
}

function getPaymentMethodData() {
    const payment_methods = [];
    $payment_table.rows().every(function () {
        const data = this.node();
        const payment_method_id = $(data)
            .find("select[name='payment_method_id[]']")
            .val();
        const amount = formatMoneyToDecimal(
            $(data).find("input[name='amount[]']").val()
        );
        const bank_id = $(data).find("select[name='credit_card_bank[]']").val();
        const card_number = $(data)
            .find("input[name='credit_card_number[]']")
            .val()
            .replace(/\s/g, "");

        payment_methods.push({
            payment_method_id,
            amount,
            bank_id,
            card_number,
        });
    });

    return payment_methods;
}

function countPaymentMethod() {
    return $payment_table.rows().count();
}

function addPaymentMethod() {
    try {
        if (countPaymentMethod() >= payment_method.length)
            throw new Error("You have added all payment method");

        const paying_amount = formatMoneyToDecimal($paying_amount.val());
        const current_amount_in_payment_method = getPaymentMethodData().reduce(
            (acc, item) => acc + formatMoneyToDecimal(item.amount),
            0
        );

        const no = countPaymentMethod() + 1;
        let payment_option = `<option value="">-- Choose Payment Method --</option>`;
        payment_method.forEach((item) => {
            payment_option += `<option value="${item.id}">${item.name}</option>`;
        });
        const payment = `<select class="form-control select-payment" name="payment_method_id[]" data-live-search="true">${payment_option}</select>`;
        const amount = `<input type="text" class="form-control text-right format-money" name="amount[]" value="${formatMoney(
            paying_amount - current_amount_in_payment_method
        )}">`;
        let bank_option = `<option value="">-- Choose Bank --</option>`;
        banks.forEach((item) => {
            bank_option += `<option value="${item.id}">${item.name}</option>`;
        });
        const note = `<div class="select-bank"><select class="form-control" name="credit_card_bank[]" data-live-search="true">${bank_option}</select></div>`;
        const card_number = `<input type="text" placeholder="card number.." class="form-control format-card-number" name="credit_card_number[]" value="">`;

        $payment_table.row
            .add([no, payment, amount, note, card_number])
            .draw()
            .node();

        $payment_table.columns.adjust().draw();

        $('[data-live-search="true"]').selectpicker();
    } catch (err) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: err.message,
        });

        $("#btn-submit-payment").html("OK").prop("disabled", false);
    }
}

function removePaymentMethod() {
    try {
        if (countPaymentMethod() <= 1)
            throw new Error("You must have at least one payment method");
        $payment_table
            .row(countPaymentMethod() - 1)
            .remove()
            .draw();
    } catch (err) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: err.message,
        });

        $("#btn-submit-payment").html("OK").prop("disabled", false);
    }
}

function updatePaymentInfo() {
    const grand_total = calculateGrandTotal();

    $paying_amount.val(formatMoney(grand_total));
    $paid_amount.val(formatMoney(grand_total));
    $payment_discount.val(
        formatMoney(calculateDiscountPercent() + calculateCouponDiscount())
    );
    $payment_change.val(formatMoney(0));
}

function calculateChange() {
    const paying_amount = formatMoneyToDecimal($paying_amount.val());
    const paid_amount = formatMoneyToDecimal($paid_amount.val());
    const change = paying_amount - paid_amount;

    $payment_change.text(formatMoney(change));
}

function validate_payment_method(data) {
    let pay_amount = 0;
    let res_status = true;
    try {
        data.forEach((item) => {
            pay_amount += formatMoneyToDecimal(item.amount);

            if (
                item.payment_method_id === "" ||
                item.payment_method_id === null
            )
                throw new Error("Please fill all payment method");

            if (item.payment_method_id != "1" && item.bank_id === "")
                throw new Error(
                    "Please select bank, for non cash payment method"
                );

            if (item.payment_method_id != "1" && item.credit_card_number === "")
                throw new Error(
                    "Please fill credit card number, for non cash payment method"
                );

            if (item.amount === 0) throw new Error("Please fill amount");

            if (item.amount < 0)
                throw new Error("Amount must be greater than 0");
        });

        if (
            formatMoneyToDecimal(pay_amount) !==
            formatMoneyToDecimal($paying_amount.val())
        )
            throw new Error("Payment amount must be equal to Received amount");
    } catch (err) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: err.message,
        });
        res_status = false;
        $("#btn-submit-payment").html("OK").prop("disabled", false);
    }

    return res_status;
}
