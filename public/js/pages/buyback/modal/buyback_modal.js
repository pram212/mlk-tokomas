const $btn_submit = $("#btn_submit");
const $buybackModal = $("#buybackModal");
const $detailModal = $("#detailModal");
const $btn_save_additional_cost = $("#btn_save_additional_cost");
const $btn_save_additional_cost_2 = $("#btn_save_additional_cost_2");
const $Buyback_desc = $("#modal_desc_value");
const $Buyback_desc_2 = $("#modal_desc_value_2");
const $Buyback_price = $("#modal_price_value");
const $Buyback_price_2 = $("#modal_price_value_2");
const $_buyback_price_start = $("#modal_price_default");
const $_buyback_price_start_2 = $("#modal_price_default_2");
const $_buyback_price_decrease = $("#modal_discount");
const $_buyback_price_decrease_2 = $("#modal_discount_2");
const $_product_id = $("#product_id");
const $_product_code = $("#product_code");
const $_buyback_additional_cost = $("#modal_additional_cost");
const $_buyback_additional_cost_2 = $("#modal_additional_cost_2");
const $_buyback_desc = $("#modal_description");
const $_final_price = $("#final_price");
const $_final_price_2 = $("#final_price_2");
const $_total_discount = $("#modal_total_discount");
const $_total_discount_2 = $("#modal_total_discount_2");
const $_barang_meleot = $("#barang_meleot");
const $_barang_meleot_detail = $("#barang_meleot_detail");
const $Sale_note = $("#sale_note");
const $Sale_note_2 = $("#sale_note_2");
const $Gramasi = $("#gramasi");
const $Gramasi_2 = $("#gramasi_2");
const $ProductProperty = $("#product_property");
const $ProductProperty_2 = $("#product_property_2");
const $Invoice_number = $("#invoice_number_sales");
const $Invoice_number_2 = $("#invoice_number_sales_2");

$(function () {
    const $table_body = $("#buyback-data-table").find("tbody");

    $btn_submit.click(handleSubmit);
    $btn_save_additional_cost.click(handleSubmitAdditionalCost);
    $btn_save_additional_cost_2.click(handleSubmitAdditionalCost);

    // onclick buyback button
    $table_body.on("click", "a.btn-buyback", showBuyBackModal);
    $table_body.on("click", "a.btn-detail", showDetailModalToPrint);

    $_barang_meleot.change(hitungTotalPotongan);
    $_barang_meleot_detail.change(hitungTotalPotonganDetail);
});

function handleSubmitAdditionalCost() {
    const code = $_product_code.val();
    const additional_cost = $_buyback_additional_cost.val() ?? 0;

    // POST to buyback/update_add_cost with axios
    axios
        .post(`${baseUrl}/buyback/update_add_cost`, {
            code: code,
            additional_cost: additional_cost,
        })
        .then((response) => {
            // show alert success
            Swal.fire({
                icon: "success",
                title: "Success",
                text: response.data.message,
            });
        })
        .catch((error) => {
            // show alert error
            Swal.fire({
                icon: "error",
                title: "Error",
                text: error.response.data.message,
            });
        });
}
function showBuyBackModal() {
    const id = $(this).data("productid");
    const code = $(this).data("productcode").toString();
    let url = `${baseUrl}/buyback/getDataModalProductBuyBack/${id}${
        code.includes("-") ? `/${code}` : ""
    }`;

    // GET data product from buyback/getDataModalProductBuyBack{id} with axios
    axios.get(url).then((response) => {
        // insert data to modal
        $Buyback_desc.text(
            "(" + code + ")" + " - " + response.data.product.name
        );

        let modal_price =
            parseFloat(response.data.price) -
            parseFloat(response.data.discount);
        const additional_cost = parseFloat(
            response.data.product_split_set_detail?.additional_cost ??
                response.data.product?.additional_cost ??
                0
        );

        let gramasi =
            response.data.product_split_set_detail?.gramasi ??
            response.data.product?.gramasi?.gramasi ??
            0;
        const mg =
            response.data.product_split_set_detail?.mg ??
            response.data.product?.mg ??
            0;
        gramasi = `${gramasi}<sup>${mg}</sup> gram`;

        const product_property =
            `${response.data.product?.product_property?.code} - ${response.data.product?.product_property?.description}` ??
            "-";

        // Memastikan bahwa additional_cost adalah angka yang valid
        const additionalCostIsValid = isNaN(additional_cost)
            ? 0
            : additional_cost;

        $Buyback_price.text(formatMoney(modal_price));
        $_buyback_price_start.val(formatMoney(parseFloat(response.data.price)));
        $_buyback_price_decrease.val(
            formatMoney(parseFloat(response.data.discount))
        );
        $_product_id.val(response.data.product_id);
        $_product_code.val(code);
        $_buyback_additional_cost.val(formatMoney(additionalCostIsValid));
        $_buyback_desc.val("");

        $ProductProperty.text(product_property);
        $Gramasi.html(gramasi);
        $Invoice_number.text(response.data.sale.invoice_number);
        $Sale_note.text(response.data.sale.sale_note);
        $_barang_meleot.prop("checked", false);

        // show modal buybackModal
        $buybackModal.modal("show");

        hitungTotalPotongan();
    });
}

function showDetailModalToPrint() {
    const id = $(this).data("productid");
    const code = $(this).data("productcode").toString();
    let url = `${baseUrl}/buyback/getDataModalDetailProductBuyBack/${id}${
        code.includes("-") ? `/${code}` : ""
    }`;

    // GET data product from buyback/getDataModalDetailProductBuyBack{id} with axios
    axios.get(url).then((response) => {
        // insert data to modal
        $Buyback_desc_2.text(
            "(" + code + ")" + " - " + response.data.product.name
        );

        let modal_price =
            parseFloat(response.data.price) -
            parseFloat(response.data.discount);
        const additional_cost = parseFloat(
            response.data.product_split_set_detail?.additional_cost ??
                response.data.product?.additional_cost ??
                0
        );

        let gramasi =
            response.data.product_split_set_detail?.gramasi ??
            response.data.product?.gramasi?.gramasi ??
            0;
        const mg =
            response.data.product_split_set_detail?.mg ??
            response.data.product?.mg ??
            0;
        gramasi = `${gramasi}<sup>${mg}</sup> gram`;

        const product_property =
            `${response.data.product?.product_property?.code} - ${response.data.product?.product_property?.description}` ??
            "-";

        // Memastikan bahwa additional_cost adalah angka yang valid
        const additionalCostIsValid = isNaN(additional_cost)
            ? 0
            : additional_cost;

        $Buyback_price_2.text(formatMoney(modal_price));
        $_buyback_price_start_2.val(formatMoney(parseFloat(response.data.price)));
        $_buyback_price_decrease_2.val(
            formatMoney(parseFloat(response.data.discount))
        );
        $_product_id.val(response.data.product_id);
        $_product_code.val(code);
        $_buyback_additional_cost_2.val(formatMoney(additionalCostIsValid));
        $_buyback_desc.val("");

        $ProductProperty_2.text(product_property);
        $Gramasi_2.html(gramasi);
        $Invoice_number_2.text(response.data.sale.invoice_number);
        $Sale_note_2.text(response.data.sale.sale_note);
        $_barang_meleot_detail.prop("checked", false);

        // show modal buybackModal
        $detailModal.modal("show");

        hitungTotalPotonganDetail();
    });
}

function handleSubmit() {
    // validation
    if (!validation_buyback()) return;

    // POST to buyback/store with axios
    axios
        .post(`${baseUrl}/buyback/store`, {
            product_id: $_product_id.val(),
            product_code: $_product_code.val(),
            description: $_buyback_desc.val(),
            is_barang_meleot: $_barang_meleot.is(":checked"),
        })
        .then((response) => {
            // // show alert success
            Swal.fire({
                icon: "success",
                title: "Success",
                text: response.data.message,
            });

            // hide modal buybackModal
            $buybackModal.modal("hide");

            // reload datatable
            $table.ajax.reload();
        })
        .catch((error) => {
            // show alert error
            Swal.fire({
                icon: "error",
                title: "Error",
                text: error.response.data.message,
            });
        });
}

function validation_buyback() {
    const modal_additional_cost = parseFloat(
        formatMoneyToDecimal($_buyback_additional_cost.val())
    );

    // if modal_additional_cost null then fill with 0
    if (!modal_additional_cost) $_buyback_additional_cost.val(0);

    return true;
}

function hitungTotalPotongan() {
    const isBarangMeleot = $(this).is(":checked");
    const price_start = parseFloat(
        formatMoneyToDecimal($_buyback_price_start.val())
    );
    let discount = parseFloat(
        formatMoneyToDecimal($_buyback_price_decrease.val())
    );
    discount = isBarangMeleot ? discount * 2 : discount; // jika barang meleot maka potongan di double
    const additional_cost = parseFloat(
        formatMoneyToDecimal($_buyback_additional_cost.val())
    );
    const total_potongan = discount + additional_cost;
    const final_price = price_start - total_potongan;

    $Buyback_price.text(formatMoney(final_price));
    $_total_discount.val(formatMoney(total_potongan));
    $_final_price.text(formatMoney(final_price));
}

function hitungTotalPotonganDetail() {
    const isBarangMeleot = $(this).is(":checked");
    const price_start = parseFloat(
        formatMoneyToDecimal($_buyback_price_start_2.val())
    );
    let discount = parseFloat(
        formatMoneyToDecimal($_buyback_price_decrease_2.val())
    );
    discount = isBarangMeleot ? discount * 2 : discount; // jika barang meleot maka potongan di double
    const additional_cost = parseFloat(
        formatMoneyToDecimal($_buyback_additional_cost.val())
    );
    const total_potongan = discount + additional_cost;
    const final_price = price_start - total_potongan;

    $Buyback_price_2.text(formatMoney(final_price));
    $_total_discount_2.val(formatMoney(total_potongan));
    $_final_price_2.text(formatMoney(final_price));
}
