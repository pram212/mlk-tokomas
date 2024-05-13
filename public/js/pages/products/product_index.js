$("ul#product").siblings("a").attr("aria-expanded", "true");
$("ul#product").addClass("show");
$("ul#product #product-list-menu").addClass("active");

function confirmDelete() {
    if (confirm("Are you sure want to delete?")) {
        return true;
    }
    return false;
}

var warehouse = [];
var variant = [];
var qty = [];
var htmltext;
var slidertext;
var product_id = [];
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$("#select_all").on("change", function () {
    if ($(this).is(":checked")) {
        $("tbody input[type='checkbox']").prop("checked", true);
    } else {
        $("tbody input[type='checkbox']").prop("checked", false);
    }
});

$(document).on(
    "click",
    "tr.product-link td:not(:first-child, :last-child)",
    function () {
        productDetails(
            $(this).parent().data("product"),
            $(this).parent().data("imagedata")
        );
    }
);

$(document).on("click", ".view", function () {
    var product = $(this)
        .parent()
        .parent()
        .parent()
        .parent()
        .parent()
        .data("product");
    var imagedata = $(this)
        .parent()
        .parent()
        .parent()
        .parent()
        .parent()
        .data("imagedata");
    productDetails(product, imagedata);
});

$("#print-btn").on("click", function () {
    var divToPrint = document.getElementById("product-details");
    var newWin = window.open("", "Print-Window");
    newWin.document.open();
    newWin.document.write(
        '<link rel="stylesheet" href="' +
            url_asset_bootstrap +
            '" type="text/css"><style type="text/css">@media print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">' +
            divToPrint.innerHTML +
            "</body>"
    );
    newWin.document.close();
    setTimeout(function () {
        newWin.close();
    }, 10);
});

function formatRupiah(angka, prefix) {
    var number_string = angka.toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
}

function productDetails(product, imagedata) {
    product[11] = product[11].replace(/@/g, '"');
    htmltext = slidertext = "";

    htmltext =
        "<p><strong>" +
        lang_Type +
        ": </strong>" +
        product[0] +
        "</p><p><strong>" +
        lang_name +
        ": </strong>" +
        product[1] +
        "</p><p><strong>" +
        lang_Code +
        ": </strong>" +
        product[2] +
        "</p><p><strong>" +
        lang_Brand +
        ": </strong>" +
        product[3] +
        "</p><p><strong>" +
        lang_Category +
        ": </strong>" +
        product[4] +
        "</p><p><strong>" +
        lang_Quantity +
        ": </strong>" +
        product[16] +
        "</p><p><strong>" +
        lang_Unit +
        ": </strong>" +
        product[5] +
        "</p><p><strong>" +
        lang_Cost +
        ": </strong>Rp " +
        this.formatRupiah(product[6]) +
        "</p><p><strong>" +
        lang_Price +
        ": </strong>Rp " +
        this.formatRupiah(product[7], "") +
        "</p><p><strong>" +
        lang_Tax +
        ": </strong>" +
        product[8] +
        "</p><p><strong>" +
        lang_TaxMethod +
        " : </strong>" +
        product[9] +
        "</p><p><strong>" +
        lang_AlertQuantity +
        " : </strong>" +
        product[10] +
        "</p><p><strong>" +
        lang_ProductDetails +
        ": </strong></p>" +
        product[11];

    if (product[17]) {
        var product_image = product[17].split(",");
        if (product_image.length > 1) {
            slidertext =
                '<div id="product-img-slider" class="carousel slide" data-ride="carousel"><div class="carousel-inner">';
            for (var i = 0; i < product_image.length; i++) {
                if (!i)
                    slidertext +=
                        '<div class="carousel-item active"><img src="public/images/product/' +
                        product_image[i] +
                        '" height="300" width="100%"></div>';
                else
                    slidertext +=
                        '<div class="carousel-item"><img src="public/images/product/' +
                        product_image[i] +
                        '" height="300" width="100%"></div>';
            }
            slidertext +=
                '</div><a class="carousel-control-prev" href="#product-img-slider" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#product-img-slider" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a></div>';
        } else {
            slidertext =
                '<img src="public/images/product/' +
                product[17] +
                '" height="300" width="100%">';
        }
    }

    $("#combo-header").text("");
    $("table.item-list thead").remove();
    $("table.item-list tbody").remove();
    $("table.product-warehouse-list thead").remove();
    $("table.product-warehouse-list tbody").remove();
    $(".product-variant-warehouse-list thead").remove();
    $(".product-variant-warehouse-list tbody").remove();
    $("#product-warehouse-section").addClass("d-none");
    $("#product-variant-warehouse-section").addClass("d-none");
    if (product[0] == "combo") {
        $("#combo-header").text(lang_ComboProducts);
        product_list = product[13].split(",");
        qty_list = product[14].split(",");
        price_list = product[15].split(",");
        $(".item-list thead").remove();
        $(".item-list tbody").remove();
        var newHead = $("<thead>");
        var newBody = $("<tbody>");
        var newRow = $("<tr>");
        newRow.append(
            `<th>${lang_product}</th><th>${Quantity}</th><th>${Price}</th>`
        );
        newHead.append(newRow);

        $(product_list).each(function (i) {
            $.get("products/getdata/" + product_list[i], function (data) {
                var newRow = $("<tr>");
                var cols = "";
                cols += "<td>" + data["name"] + " [" + data["code"] + "]</td>";
                cols += "<td>" + qty_list[i] + "</td>";
                cols += "<td>" + price_list[i] + "</td>";

                newRow.append(cols);
                newBody.append(newRow);
            });
        });

        $("table.item-list").append(newHead);
        $("table.item-list").append(newBody);
    } else if (product[0] == "standard") {
        $.get("products/product_warehouse/" + product[12], function (data) {
            if (data.product_warehouse[0].length != 0) {
                warehouse = data.product_warehouse[0];
                qty = data.product_warehouse[1];
                var newHead = $("<thead>");
                var newBody = $("<tbody>");
                var newRow = $("<tr>");
                newRow.append(`<th>${Warehouse}</th><th>${lang_Quantity}</th>`);
                newHead.append(newRow);
                $.each(warehouse, function (index) {
                    var newRow = $("<tr>");
                    var cols = "";
                    cols += "<td>" + warehouse[index] + "</td>";
                    cols += "<td>" + qty[index] + "</td>";

                    newRow.append(cols);
                    newBody.append(newRow);
                    $("table.product-warehouse-list").append(newHead);
                    $("table.product-warehouse-list").append(newBody);
                });
                $("#product-warehouse-section").removeClass("d-none");
            }
            if (data.product_variant_warehouse[0].length != 0) {
                warehouse = data.product_variant_warehouse[0];
                variant = data.product_variant_warehouse[1];
                qty = data.product_variant_warehouse[2];
                var newHead = $("<thead>");
                var newBody = $("<tbody>");
                var newRow = $("<tr>");
                newRow.append(
                    `<th>${Warehouse}</th><th>${Variant}</th><th>${Quantity}</th>`
                );
                newHead.append(newRow);
                $.each(warehouse, function (index) {
                    var newRow = $("<tr>");
                    var cols = "";
                    cols += "<td>" + warehouse[index] + "</td>";
                    cols += "<td>" + variant[index] + "</td>";
                    cols += "<td>" + qty[index] + "</td>";

                    newRow.append(cols);
                    newBody.append(newRow);
                    $("table.product-variant-warehouse-list").append(newHead);
                    $("table.product-variant-warehouse-list").append(newBody);
                });
                $("#product-variant-warehouse-section").removeClass("d-none");
            }
        });
    }

    $("#product-content").html(htmltext);
    $("#slider-content").html(slidertext);
    $("#product-details").modal("show");
    $("#product-img-slider").carousel(0);
}

// Fungsi untuk menghasilkan QR code
function generateQRCode(data, elementId) {
    document.getElementById(elementId).innerHTML = "";
    var qrcode = new QRCode(document.getElementById(elementId), {
        text: data,
        width: 180,
        height: 180,
    });
}

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
            // url: '{!! route('product-datatable') !!}',
            url: baseUrl + "/product-datatable",
            dataType: "json",
            type: "get",
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "code",
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
            },
        ],
        // 'language': {
        //     /*'searchPlaceholder': "{{ trans('file.Type Product Name or Code...') }}",*/
        //     'lengthMenu': '_MENU_ {{ trans('file.records per page') }}',
        //      "info":      '<small>{{ trans('file.Showing') }} _START_ - _END_ (_TOTAL_)</small>',
        //     "search":  '{{ trans('file.Search') }}',
        //     'paginate': {
        //             'previous': '<i class="dripicons-chevron-left"></i>',
        //             'next': '<i class="dripicons-chevron-right"></i>'
        //     }
        // },
        order: [["3", "desc"]],
        columnDefs: [
            {
                orderable: false,
                targets: [0, 3],
            },
            {
                render: function (data, type, row, meta) {
                    if (type === "display") {
                        data =
                            '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                    }

                    return data;
                },
                checkboxes: {
                    selectRow: true,
                    selectAllRender:
                        '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>',
                },
                targets: [0],
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
                extend: "pdf",
                text: lang_PDF,
                exportOptions: {
                    columns: ":visible:not(.not-exported)",
                    rows: ":visible",
                    stripHtml: false,
                },
                customize: function (doc) {
                    for (var i = 1; i < doc.content[1].table.body.length; i++) {
                        if (
                            doc.content[1].table.body[i][0].text.indexOf(
                                "<img src="
                            ) !== -1
                        ) {
                            var imagehtml =
                                doc.content[1].table.body[i][0].text;
                            var regex = /<img.*?src=['"](.*?)['"]/;
                            var src = regex.exec(imagehtml)[1];
                            var tempImage = new Image();
                            tempImage.src = src;
                            var canvas = document.createElement("canvas");
                            canvas.width = tempImage.width;
                            canvas.height = tempImage.height;
                            var ctx = canvas.getContext("2d");
                            ctx.drawImage(tempImage, 0, 0);
                            var imagedata = canvas.toDataURL("image/png");
                            delete doc.content[1].table.body[i][0].text;
                            doc.content[1].table.body[i][0].image = imagedata;
                            doc.content[1].table.body[i][0].fit = [30, 30];
                        }
                    }
                },
            },
            {
                extend: "csv",
                text: lang_CSV,
                exportOptions: {
                    columns: ":visible:not(.not-exported)",
                    rows: ":visible",
                    format: {
                        body: function (data, row, column, node) {
                            if (
                                column === 0 &&
                                data.indexOf("<img src=") !== -1
                            ) {
                                var regex = /<img.*?src=['"](.*?)['"]/;
                                data = regex.exec(data)[1];
                            }
                            return data;
                        },
                    },
                },
            },
            {
                text: lang_delete,
                className: "buttons-delete",
                action: async function (e, dt, node, config) {
                    if (!user_verified) {
                        return Swal.fire(
                            "Error",
                            "This feature is disabled for demo!",
                            "error"
                        );
                    }
                    const ids = [];
                    const split_ids = [];

                    $.each(
                        $(".dt-checkboxes:checked"),
                        function (indexInArray, valueOfElement) {
                            const tr = $(this).closest("tr");
                            const data = table.row(tr).data();
                            if (data !== undefined) {
                                ids.push(data.id);
                                split_ids.push(data.split_id);
                            }
                        }
                    );

                    // $(".dt-checkboxes:checked").each(function (index, element) {
                    //     const tr = $(element).closest("tr"); // get the row target
                    //     const data = table.row(tr).data(); // get detail data
                    //     if (data !== undefined) ids.push(data.id);
                    // });

                    if (ids.length < 1) {
                        return Swal.fire("Error", "No data selected!", "error");
                    }
                    const confirmation = await Swal.fire({
                        title: "Are you sure?",
                        text: "Are you sure want to delete?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, delete it!",
                    });
                    if (confirmation.value) {
                        const url = `${baseUrl}/products/deletebyselection`;
                        try {
                            const response = await axios.post(url, {
                                ids: ids,
                                split_ids: split_ids,
                            });

                            const status = response.data.status;
                            const msg = response.data.message;

                            if (!status) throw new Error(msg);

                            Swal.fire("Success", msg, "success");

                            table.ajax.reload();
                        } catch (error) {
                            Swal.fire("Error", error.message, "error");
                        }
                    }
                },
            },
            {
                extend: "colvis",
                text: lang_visibility,
                columns: ":gt(0)",
            },
        ],
    });

    // handle button lihat untuk menapilkan detail produk
    $("#product-data-table tbody").on("click", "a.btn-view", function (e) {
        e.preventDefault(); // Menghentikan perilaku default dari tombol a
        let id = $(this).data("id"); // Mengambil nilai dari atribut data-id

        // lakukan proses ajax untuk mengambil data detail produk
        $.get(baseUrl + "/products/getDetailById" + "/" + id, function (data) {
            // isi inputan yang ada di modal box detail product
            $("#dtl-code").val(data.code);
            $("#dtl-price").val(data.price);
            $("#dtl-tag-code").val(data.tag_type?.code);
            $("#dtl-gramasi-code").val(data.gramasi?.code);
            $("#dtl-discount").val(data.discount);
            $("#dtl-product-property").val(data.product_property?.description);
            generateQRCode(data.code, "prev-qrcode");
            // tampilkan modal box detil produk
            $("#detailModal").modal("show");
        });
    });

    // handle button hapus untuk menghapus data
    $("#product-data-table tbody").on(
        "click",
        "a.btn-delete",
        async function (e) {
            e.preventDefault(); // Menghentikan perilaku default dari tombol a
            let id = $(this).data("id"); // Mengambil nilai dari atribut data-id
            let splitId = $(this).data("splitid"); // Mengambil nilai dari atribut data-splitid

            const confirmation = await Swal.fire({
                title: "Are you sure?",
                text: "Are you sure want to delete this data?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!",
            });

            if (confirmation.value) {
                // Lakukan proses hapus data dengan axios
                try {
                    const response = await axios.delete(
                        baseUrl +
                            "/products" +
                            "/" +
                            id +
                            "?split_id=" +
                            splitId
                    );
                    Swal.fire(
                        "Success",
                        "Data successfully deleted",
                        "success"
                    );
                    table.ajax.reload();
                } catch (error) {
                    if (error.response.status === 404) {
                        Swal.fire("Error", "Not Found", "error");
                    } else if (error.response.status === 500) {
                        Swal.fire("Error", error.response.data, "error");
                    } else {
                        Swal.fire("Error", "Something went wrong!", "error");
                    }
                }
            }
        }
    );
});
