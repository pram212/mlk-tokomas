$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function hitungTotalPotongan() {
    let modal_price = parseFloat($("#modal_price_default").val());
    let discount = parseFloat($("#modal_discount").val());
    let additional_cost = parseFloat($("#modal_additional_cost").val());
    let total_potongan = discount + additional_cost;
    let final_price = modal_price - total_potongan;
    $("#modal_price_value").text(final_price);
    $("#modal_total_discount").val(total_potongan);
    $("#final_price").text(final_price);
}

$(document).ready(function () {
    var table = $("#buyback-data-table").DataTable({
        responsive: true,
        fixedHeader: {
            header: true,
            footer: true,
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: `${baseUrl}/buyback/buyback-datatable`,
            dataType: "json",
            type: "get",
            data: function (d) {
                d.invoice_number = invoice_number.val();
                d.code = code.val();
            },
        },
        columns: [
            {
                data: "code",
                name: "products.code",
                searchable: true,
                render: function (data, type, row) {
                    const product_id = row.id;
                    const split_set_code = row.split_set_code ?? "";
                    let param = product_id;
                    if (split_set_code) {
                        param =
                            product_id + "/?split_set_code=" + split_set_code;
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
            },
            {
                data: "name",
                name: "products.name",
                searchable: true,
            },
            {
                data: "image_preview",
                searchable: false,
                orderable: false,
            },
            {
                data: "created_at",
                searchable: false,
            },
            {
                data: "price",
                searchable: false,
            },
            {
                data: "tag_type_code",
                searchable: false,
                orderable: false,
            },
            {
                data: "tag_type_color",
                searchable: false,
                orderable: false,
            },
            {
                data: "mg",
                searchable: false,
            },
            {
                data: "gramasi_gramasi",
                searchable: false,
            },
            {
                data: "product_property_description",
                searchable: false,
            },
            {
                data: "product_status",
                searchable: false,
            },
            {
                data: "invoice_number",
                name: "products.invoice_number",
                searchable: true,
            },
            {
                data: "buyback_status",
                searchable: false,
            },
            {
                data: "action",
                orderable: false,
                searchable: false,
            },
            {
                data: "invoice_number",
                name: "split.invoice_number",
                searchable: true,
                visible: false,
            },
            {
                data: "code",
                name: "split.split_set_code",
                searchable: true,
                visible: false,
            },
        ],
        order: [["3", "desc"]],
        columnDefs: [
            {
                orderable: false,
                targets: [0, 2, 6],
            },
            {
                visible: false,
                targets: [5, 6, 7, 8],
            },
        ],
        select: {
            style: "multi",
            selector: "td:first-child",
        },
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: "colvis",
                text: lang_visibility,
                // columns: ":gt(0)",
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
            },
        ],
    });

    filterCode();
    filterInvoice();

    // on key up searchBox
    $("#invoice_number")
        .closest(".btn-group")
        .find('.bs-searchbox input[type="text"]')
        .on("keyup", function () {
            // Ambil nilai dari input teks
            let searchText = $(this).val();

            // Periksa panjang nilai
            if (searchText.length % 3 === 0) {
                filterInvoice(searchText);
            }
        });

    $("#code")
        .closest(".btn-group")
        .find('.bs-searchbox input[type="text"]')
        .on("keyup", function () {
            // Ambil nilai dari input teks
            let searchText = $(this).val();

            // Periksa panjang nilai
            if (searchText.length % 3 === 0) {
                filterCode(searchText);
            }
        });

    // onclick filter button
    btn_filter.click(function () {
        table.ajax.reload();
    });

    btn_submit.click(function () {
        // validation
        if (!validation_buyback()) {
            return;
        }

        // POST to buyback/store with axios
        axios
            .post(`${baseUrl}/buyback/store`, {
                product_id: $("#product_id").val(),
                code: $("#product_code").val(),
                price: $("#modal_price_default").val(),
                discount: $("#modal_discount").val(),
                additional_cost: $("#modal_additional_cost").val(),
                final_price: $("#final_price").text(),
                description: $("#modal_description").val(),
            })
            .then((response) => {
                // // show alert success
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: response.data.message,
                });

                // hide modal buybackModal
                $("#buybackModal").modal("hide");

                // reload datatable
                table.ajax.reload();
            })
            .catch((error) => {
                // show alert error
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: error.response.data.message,
                });
            });
    });

    // onclick buyback button
    $("#buyback-data-table tbody").on("click", "a.btn-buyback", function (e) {
        const id = $(this).data("productid");
        const code = $(this).data("productcode").toString();
        let url = `${baseUrl}/buyback/getDataModalProductBuyBack/${id}${
            code.includes("-") ? `/${code}` : ""
        }`;

        // GET data product from buyback/getDataModalProductBuyBack{id} with axios
        axios.get(url).then((response) => {
            // insert data to modal
            $("#modal_desc_value").text(
                "(" + code + ")" + " - " + response.data.name
            );

            let modal_price =
                parseFloat(response.data.price) -
                parseFloat(response.data.discount);

            $("#modal_price_value").text(modal_price);
            $("#modal_price_default").val(parseFloat(response.data.price));
            $("#modal_discount").val(parseFloat(response.data.discount));
            $("#product_id").val(response.data.id);
            $("#product_code").val(code);
            // show modal buybackModal
            $("#buybackModal").modal("show");
        });
    });
});

function filterInvoice(search = "") {
    $("#invoice_number")
        .empty()
        .append(`<option value="">${lang_select}</option>`);

    //  GET to buyback/getInvoiceNumber with axios
    axios
        .get(`${baseUrl}/buyback/getInvoiceNumber/?search=${search}`)
        .then((response) => {
            // insert data to selectpicker with loop
            response.data.forEach((element) => {
                $("#invoice_number").append(
                    `<option value="${element.invoice_number}">${element.invoice_number}</option>`
                );
            });

            // refresh selectpicker
            $("#invoice_number").selectpicker("refresh");
        });
}

function filterCode(search = "") {
    $("#code").empty().append(`<option value="">${lang_select}</option>`);
    //  GET to buyback/getCode with axios
    axios
        .get(`${baseUrl}/buyback/getCode/?search=${search}`)
        .then((response) => {
            // insert data to selectpicker with loop
            response.data.forEach((element) => {
                $("#code").append(
                    `<option value="${element.code}">${element.code}</option>`
                );
            });

            // refresh selectpicker
            $("#code").selectpicker("refresh");
        });
}

function validation_buyback() {
    const modal_additional_cost = parseFloat($("#modal_additional_cost").val());

    // if modal_additional_cost null then fill with 0
    if (!modal_additional_cost) {
        $("#modal_additional_cost").val(0);
    }
    return true;
}
