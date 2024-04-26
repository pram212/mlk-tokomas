$(document).ready(function () {
    $('button[data-id="input-split-type"]').attr("disabled", true);

    if (!product_split_set_detail) {
        detail_split_add();
    }
});

btn_historical_split_set.click(function () {
    let split_set_id = input_split_type.val();
    if (!split_set_id) {
        alert("Please select split set type first");
        return;
    }

    // axios to GET products/product-detail-split-set-history/{product_id}
    axios
        .get(baseUrl + "/product-detail-split-set-history/" + product_id)
        .then((response) => {
            let data = response.data;
            if (data.length == 0) {
                let table = historical_split_set_modal.find("table tbody");
                table.html("");
                table.append(
                    `<tr>
                        <td colspan="3" class="text-center">No data found</td>
                    </tr>`
                );
                return;
            }

            let table = historical_split_set_modal.find("table tbody");
            table.html("");

            data.forEach((item) => {
                let tr = `<tr>
                    <td>${item.split_set_code}</td>
                    <td>${item.qty_product}</td>
                    <td>${item.created_at}</td>
                </tr>`;

                table.append(tr);
            });

            historical_split_set_modal.find("table").DataTable({
                searching: false,
                order: [[2, "desc"]],
            });
        });

    // test show modal
    historical_split_set_modal.modal("show");
});

input_split_type.change(function () {
    let split_set_type = $(this).val();
    if (split_set_type == 2) {
        detail_split_set.removeClass("d-none");
        detail_split_set.find("table tbody").html("");
        detail_split_add();
    } else {
        detail_split_set.addClass("d-none");
    }
});

detail_split_set_qty.change(function () {
    let qty = $(this).val();
    let last_btn = table_detail_split_set.find(".detail_split_add").last();
    // jumlah qty tidak boleh kurang dari split_set_qty[]
    let split_set_qty = table_detail_split_set.find(
        'input[name="split_set_qty[]"]'
    );

    let total_qty = 0;

    split_set_qty.each(function () {
        if ($(this).val() == "") {
            return;
        }
        total_qty += parseInt($(this).val());
    });

    if (qty < total_qty) {
        alert("Jumlah qty tidak boleh kurang dari split set qty");
        $(this).val("");

        last_btn.prop("disabled", true);
    }

    if (qty > total_qty) {
        last_btn.prop("disabled", false);
    }

    if (qty == total_qty) {
        last_btn.prop("disabled", true);
    }
});

// onchange split_set_qty[]
$(document).on("change", 'input[name="split_set_qty[]"]', function () {
    let product_qty = detail_split_set_qty.val()
        ? parseInt(detail_split_set_qty.val())
        : 0;
    let split_set_qty = table_detail_split_set.find(
        'input[name="split_set_qty[]"]'
    );
    let last_btn = table_detail_split_set.find(".detail_split_add").last();

    let total_qty = 0;

    split_set_qty.each(function () {
        if ($(this).val() == "") {
            return;
        }
        total_qty += parseInt($(this).val());
    });

    if (total_qty > product_qty) {
        alert("Jumlah qty tidak boleh lebih dari Qty Product");
        $(this).val("");
        last_btn.prop("disabled", true);
    }

    if (product_qty > total_qty) {
        last_btn.prop("disabled", false);
    }

    if (product_qty == total_qty) {
        last_btn.prop("disabled", true);
    }
});

function detail_split_delete() {
    let table = table_detail_split_set;
    const last_row = table_detail_split_set.find("tr").last();
    last_row.remove();

    // show add button
    table_detail_split_set.find(".detail_split_add").last().show();
    table_detail_split_set.find(".btn_detail_split_delete").last().show();

    if (table.find("tr").length == 1) {
        table.find(".btn_detail_split_delete").hide();
    }
}

function detail_split_add(data = []) {
    let table = table_detail_split_set;
    table.find(".detail_split_add").hide();
    btn_detail_split_delete.hide();
    table.find(".btn_detail_split_delete").hide();

    const row_number = table.find("tr").length + 1;
    const code_split = data.code_split ?? `${code.val()} - SP${row_number}`;
    const split_id = data.id ?? "";
    const qty = data.qty_product ?? "";
    const mg = data.mg ?? "";
    const gramasi = data.gramasi ?? "";
    const harga = data.price ?? "";
    const is_show =
        split_set_id && data.id != null
            ? split_set_id == split_id
                ? true
                : false
            : true;
    const is_readonly = is_show ? "" : "readonly";

    if (is_show) generateQRCode(code_split, "prev-qrcode");
    if (is_show) $("#prev-gramasi").text(gramasi);
    if (is_show) $("#prev-mg").text(mg);

    const btn_delete = is_show
        ? `<button type="button" class="btn btn-danger ml-1 btn_detail_split_delete"><i class="fa fa-times" onclick="detail_split_delete()"></i></button>`
        : "";

    let tr = `<tr>
          <td>
              <div class="form-group">
                  <label for="">Kode Split Set ${row_number}</label>
                  <input type="text" name="split_set_code[]" class="form-control" value="${code_split}" readonly>
              </div>
          </td>
          <td>
              <div class="form-group">
                  <label for="">Qty Product Split Set ${row_number}</label>
                  <div class="input-group">
                      <input type="number" name="split_set_qty[]" class="form-control" value="${qty}" ${is_readonly}>
                  </div>
              </div>
          </td>
          <td>
              <div class="form-group">
                  <label for="">Gramasi Split Set ${row_number}</label>
                  <div class="input-group">
                      <input type="number" name="split_set_gramasi[]" class="form-control" value="${gramasi}" ${is_readonly}>
                  </div>
              </div>
          </td>
          <td>
              <div class="form-group">
                  <label for="">Miligram Split Set ${row_number}</label>
                  <div class="input-group">
                      <input type="number" name="split_set_mg[]" class="form-control" value="${mg}" ${is_readonly}>
                  </div>
              </div>
          </td>
          <td>
              <div class="form-group">
                  <label for="">Harga Split Set ${row_number}</label>
                  <div class="input-group">
                      <input type="number" name="split_set_harga[]" class="form-control" value="${harga}" ${is_readonly}>
                      ${btn_delete}
                      <button type="button" class="btn btn-success ml-2 detail_split_add" onclick="detail_split_add()"><i class="fa fa-plus"></i></button>
                  </div>
              </div>
          </td>
      </tr>`;

    table.append(tr);

    // check if there is only one row
    if (table.find("tr").length == 1) {
        table.find(".btn_detail_split_delete").hide();
    }
}

input_categories_id.change(function () {
    let categories_id = $(this).val();
    let product_type_id = $("#product_type_id");
    let button_product_type_id = $('button[data-id="product_type_id"]');
    $.ajax({
        type: "GET",
        url:
            baseUrl +
            "/product-categories/producttype-getByCategory/" +
            categories_id,
        success: function (data) {
            let res = data;
            button_product_type_id.toggleClass(
                "disabled",
                res.data.length == 0
            );
            product_type_id.prop("disabled", res.data.length == 0);

            let options = `<option value="">${lang_select}</option>`;
            if (res.data.length != 0)
                res.data.forEach((element) => {
                    options += `<option value="${element.id}">${element.code}</option>`;
                });

            product_type_id.html(options);

            // trigger change to set the value
            $(".selectpicker").selectpicker("refresh");
        },
    });
});

input_product_type_id.change(function () {
    let product_type_id = $(this).val();
    let categories_id = input_categories_id.val();

    $.ajax({
        type: "GET",
        url:
            baseUrl +
            "/product-categories/gramasi-getByCategoryAndProductType/" +
            categories_id +
            "/" +
            product_type_id,
        success: function (data) {
            if (data.data) {
                input_gramasi_id.val(data.data.id);
                text_gramasi_id.text(data.data.gramasi);

                prevGramasi(data.data.id);
            }
        },
    });

    setPrice();
});

product_property_id.change(function () {
    setPrice();
});

function setPrice() {
    let product_property_id_val = product_property_id.val();
    let categories_id = input_categories_id.val();
    let product_type_id = input_product_type_id.val();

    // make sure categories_id and product_type_id is not empty
    if (!categories_id || !product_type_id) {
        return;
    }

    price_col.val("");
    $.ajax({
        type: "GET",
        url:
            baseUrl +
            "/master/price-getProductPrice/" +
            categories_id +
            "/" +
            product_type_id +
            "/" +
            product_property_id_val,
        success: function (data) {
            if (data) {
                let price = data.price;

                price_col.val(price);
            }
        },
    });
}

input_categories_id.add(input_product_type_id).change(function () {
    input_gramasi_id.val("");
    text_gramasi_id.text("-");
});

// old image
if (old_image) {
    image_preview.html(
        '<img style="max-height:100px" src="' +
            baseUrl +
            "/" +
            old_image +
            '" class="img-fluid" />'
    );
}

// preview image
function readURL(input) {
    let image_preview = $("#image-preview");
    let image = $("#image");
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        // batasi ukuran gambar
        if (input.files[0].size > 2000000) {
            // hapus file yang sudah dipilih
            image.val("");
            image_preview.html("");

            alert("Max file size is 2MB");
            return;
        }

        // batasi tipe gambar
        if (
            input.files[0].type != "image/jpeg" &&
            input.files[0].type != "image/png"
        ) {
            // hapus file yang sudah dipilih
            image.val("");
            image_preview.html("");

            alert("Only jpeg and png file type are allowed");
            return;
        }

        reader.onload = function (e) {
            image_preview.html(
                '<img style="max-height:100px" src="' +
                    e.target.result +
                    '" class="img-fluid" />'
            );
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$('[data-toggle="tooltip"]').tooltip();

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

genbutton.on("click", function () {
    $.get(baseUrl + "/products-gencode", function (data) {
        $("input[name='code']").val(data);
        generateQRCode(data, "prev-qrcode");
    });

    $('button[data-id="input-split-type"]').attr("disabled", false);
    input_split_type.val("");
    input_split_type.trigger("change");
});

// Fungsi untuk menghasilkan QR code
function generateQRCode(data, elementId) {
    document.getElementById(elementId).innerHTML = "";
    var qrcode = new QRCode(document.getElementById(elementId), {
        text: data,
        width: 200,
        height: 200,
    });
}

//Delete product
$("table.order-list tbody").on("click", ".ibtnDel", function (event) {
    $(this).closest("tr").remove();
    calculate_price();
});

//Delete variant
$("table#variant-table tbody").on("click", ".vbtnDel", function (event) {
    $(this).closest("tr").remove();
});

$(window).keydown(function (e) {
    if (e.which == 13) {
        var $targ = $(e.target);

        if (!$targ.is("textarea") && !$targ.is(":button,:submit")) {
            var focusNext = false;
            $(this)
                .find(":input:visible:not([disabled],[readonly]), a")
                .each(function () {
                    if (this === e.target) {
                        focusNext = true;
                    } else if (focusNext) {
                        $(this).focus();
                        return false;
                    }
                });

            return false;
        }
    }
});

$("#price").maskMoney({ thousands: ".", decimal: "," });

const getGramasi = (id_gramasi) => {
    const selectedGramasi = gramasis.find(({ id }) => id === id_gramasi);
    return selectedGramasi;
};

const getKdSifat = (id_kd_sifat) => {
    const selectedProerties = properties.find(({ id }) => id === id_kd_sifat);
    return selectedProerties.code;
};

$("#tag_type_id").change(function (e) {
    e.preventDefault();
    var selectedText = $(this).find("option:selected").text();
    var color = selectedText.split("-")[1];
    $("#product-preview").css("background-color", color);
});

function prevGramasi(id) {
    const gramasi = getGramasi(id);
    $("#prev-gramasi").text(gramasi.gramasi);
    $("#prev-kd-gramasi").text(gramasi.code);
}

$("#input-kd-sifat").change(function (e) {
    e.preventDefault();
    id = parseInt(e.target.value);
    const property = getKdSifat(id);
    $("#prev-kd-sifat").text(property);
});

$("#input-mg").bind("input", function (e) {
    e.preventDefault();
    const mg = e.target.value;
    $("#prev-mg").text(mg);
});

$("#input-gold_content").bind("input", function (e) {
    e.preventDefault();
    const goldContent = e.target.value;
    $("#prev-gold_content").text(goldContent);
});

$("#input-additional_code").bind("input", function (e) {
    e.preventDefault();
    const code = e.target.value;
    $("#prev-additional_code").text(code);
});

$("#input-diskon").bind("input", function (e) {
    e.preventDefault();
    const diskon = e.target.value;
    $("#prev-diskon").text(diskon);
});

// if edit mode
if (produk) {
    $("#prev-kd-sifat").text(produk.product_property.code);
    $("#prev-kd-gramasi").text(produk.gramasi.code);
    $("#prev-gramasi").text(produk.gramasi.gramasi);
    $("#prev-diskon").text(produk.discount);
    $("#prev-gold_content").text(produk.gold_content);
    $("#prev-additional_code").text(produk.additional_code);
    $("#prev-mg").text(produk.mg);
    generateQRCode(produk.code, "prev-qrcode");

    input_split_type.trigger("change");
    // kosongkan table_detail_split_set
    table_detail_split_set.html("");

    if (product_split_set_detail) {
        product_split_set_detail.forEach((data) => {
            detail_split_add(data);
        });
    }
}

if (mode == "show") {
    $("#tag_type_id").prop("disabled", true);
    input_categories_id.prop("disabled", true);
    input_product_type_id.prop("disabled", true);
    product_property_id.prop("disabled", true);
    $("#submit-btn").remove();
    detail_split_set_qty.prop("disabled", true);
    $("input[name='split_set_qty[]']").prop("disabled", true);
    $(".btn_detail_split_delete").remove();
    $(".detail_split_add").remove();
}

if (mode == "create") {
    btn_historical_split_set.hide();
}
