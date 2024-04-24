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
                render: function (data, type, row) {
                    const product_id = row.id;
                    return (
                        '<a href="{{ url("products") }}/' +
                        product_id +
                        '" class="btn-detail-product" style="color:blue">' +
                        data +
                        "</a>"
                    );
                },
            },
            {
                data: "name",
            },
            {
                data: "image_preview",
            },
            {
                data: "created_at",
            },
            {
                data: "price",
            },
            {
                data: "tag_type_code",
            },
            {
                data: "tag_type_color",
            },
            {
                data: "mg",
            },
            {
                data: "gramasi_gramasi",
            },
            {
                data: "product_property_description",
            },
            {
                data: "product_status",
            },
            {
                data: "invoice_number",
            },
            {
                data: "action",
                orderable: false,
            },
        ],
        order: [["3", "desc"]],
        columnDefs: [
            {
                orderable: false,
                targets: [0, 2, 6],
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
                columns: ":gt(0)",
            },
        ],
    });

    //  GET to buyback/getInvoiceNumber with axios
    axios.get(`${baseUrl}/buyback/getInvoiceNumber`).then((response) => {
        // insert data to selectpicker with loop
        response.data.forEach((element) => {
            $("#invoice_number").append(
                `<option value="${element.invoice_number}">${element.invoice_number}</option>`
            );
        });

        // refresh selectpicker
        $("#invoice_number").selectpicker("refresh");
    });

    //  GET to buyback/getTagType with axios
    axios.get(`${baseUrl}/buyback/getCode`).then((response) => {
        // insert data to selectpicker with loop
        response.data.forEach((element) => {
            $("#code").append(
                `<option value="${element.code}">${element.code}</option>`
            );
        });

        // refresh selectpicker
        $("#code").selectpicker("refresh");
    });

    // onclick filter button
    btn_filter.click(function () {
        table.ajax.reload();
    });

    btn_submit.click(function () {
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
                product_property_id: $("#modal_product_properties").val(),
            })
            .then((response) => {
                // // show alert success
                // Swal.fire({
                //     icon: "success",
                //     title: "Success",
                //     text: response.data.message,
                // });

                alert(response.data.message);

                // hide modal buybackModal
                $("#buybackModal").modal("hide");

                // reload datatable
                table.ajax.reload();
            })
            .catch((error) => {
                // show alert error
                // Swal.fire({
                //     icon: "error",
                //     title: "Error",
                //     text: error.response.data.message,
                // });

                alert(error.response.data.message);
            });
    });

    // onclick buyback button
    $("#buyback-data-table tbody").on("click", "a.btn-buyback", function (e) {
        const id = $(this).data("productid");

        // GET data product from buyback/getDataModalProductBuyBack{id} with axios
        axios
            .get(`${baseUrl}/buyback/getDataModalProductBuyBack/${id}`)
            .then((response) => {
                // insert data to modal
                $("#modal_desc_value").text(
                    response.data.code + " - " + response.data.name
                );

                let modal_price =
                    parseFloat(response.data.price) -
                    parseFloat(response.data.discount);

                $("#modal_price_value").text(modal_price);
                $("#modal_price_default").val(parseFloat(response.data.price));
                $("#modal_discount").val(parseFloat(response.data.discount));
                $("#product_id").val(response.data.id);
                $("#product_code").val(response.data.code);
                // show modal buybackModal
                $("#buybackModal").modal("show");
            });
    });
});
