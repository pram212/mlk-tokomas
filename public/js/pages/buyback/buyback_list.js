$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).ready(function () {
    var table = $("#product-data-table").DataTable({
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
    $("#filter").click(function () {
        table.ajax.reload();
    });
});

// $("select").selectpicker();
