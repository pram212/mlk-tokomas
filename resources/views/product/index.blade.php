@extends('layout.main') @section('content')
<section>
    <div class="container-fluid">
        @can('create', App\Product::class)
        <a href="{{ route('products.create') }}" class="btn btn-info"><i class="dripicons-plus"></i>
            {{ __('file.add_product') }}</a>
        <a href="#" data-toggle="modal" data-target="#importProduct" class="btn btn-primary"><i
                class="dripicons-copy"></i> {{ __('file.import_product') }}</a>
        @endcan
    </div>
    <div class="table-responsive">

        <table id="product-data-table" class="table" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{ trans('file.Code') }}</th>
                    <th>{{ __('file.Product Name') }}</th>
                    <th>{{ __('file.Product Image') }}</th>
                    <th>{{ __('file.Date') }}</th>
                    <th>{{ trans('file.Price') }}</th>
                    <th>{{ __('file.Tag Type Code') }}</th>
                    <th>{{ __('file.Color') }}</th>
                    <th>Miligram</th>
                    <th>Gramasi</th>
                    <th>{{ __('file.Product Property') }}</th>
                    <th>{{ __('file.Product Status') }}</th>
                    <th>{{ __('file.Invoice') }}</th>
                    <th class="not-exported">{{ trans('file.action') }}</th>
                </tr>
            </thead>

        </table>
    </div>
</section>

<div id="importProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'products.import', 'method' => 'post', 'files' => true]) !!}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Import Product</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic">
                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                </p>
                <p>{{ trans('file.The correct column order is') }} (image, name*, code*, type*, brand, category*,
                    unit_code*, cost*, price*, product_details, variant_name, item_code, additional_price)
                    {{ trans('file.and you must follow this') }}.</p>
                <p>{{ trans('file.To display Image it must be stored in') }} public/images/product
                    {{ trans('file.directory') }}. {{ trans('file.Image name must be same as product name') }}</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ trans('file.Upload CSV File') }} *</label>
                            {{ Form::file('file', ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> {{ trans('file.Sample File') }}</label>
                            <a href="public/sample_file/sample_products.csv" class="btn btn-info btn-block btn-md"><i
                                    class="dripicons-download"></i> {{ trans('file.Download') }}</a>
                        </div>
                    </div>
                </div>
                {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div id="product-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{ trans('Product Details') }}</h5>
                <button id="print-btn" type="button" class="btn btn-default btn-sm ml-3"><i class="dripicons-print"></i>
                    {{ trans('file.Print') }}</button>
                <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close"><span
                        aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5" id="slider-content"></div>
                    <div class="col-md-5 offset-1" id="product-content"></div>
                    <div class="col-md-5 mt-2" id="product-warehouse-section">
                        <h5>{{ trans('file.Warehouse Quantity') }}</h5>
                        <table class="table table-bordered table-hover product-warehouse-list">
                            <thead>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-7 mt-2" id="product-variant-warehouse-section">
                        <h5>{{ trans('file.Warehouse quantity of product variants') }}</h5>
                        <table class="table table-bordered table-hover product-variant-warehouse-list">
                            <thead>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <h5 id="combo-header"></h5>
                <table class="table table-bordered table-hover item-list">
                    <thead>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">{{ __('file.Product Details') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-12 mb-3 border">
                        <div class="h-100 d-flex align-items-center justify-content-center">
                            <div class="text-center" id="prev-qrcode">
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="code">{{ __('file.Product Code') }} :</label>
                            <input type="text" id="dtl-code" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="code">{{ __('file.Price') }} :</label>
                            <input type="text" id="dtl-price" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="code">{{ __('file.Tag Type Code') }} :</label>
                            <input type="text" id="dtl-tag-code" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="code">{{ __('file.Gramasi Code') }} :</label>
                            <input type="text" id="dtl-gramasi-code" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="code">{{ __('file.Discount') }} :</label>
                            <input type="text" id="dtl-discount" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="code">{{ __('file.Product Property Code') }} :</label>
                            <input type="text" id="dtl-product-property" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- qrcode --}}
<script src="{{ asset('public/js/qrcode.min.js') }}"></script>

<script>
    $("ul#product").siblings('a').attr('aria-expanded', 'true');
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
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#select_all").on("change", function() {
            if ($(this).is(':checked')) {
                $("tbody input[type='checkbox']").prop('checked', true);
            } else {
                $("tbody input[type='checkbox']").prop('checked', false);
            }
        });

        $(document).on("click", "tr.product-link td:not(:first-child, :last-child)", function() {
            productDetails($(this).parent().data('product'), $(this).parent().data('imagedata'));
        });

        $(document).on("click", ".view", function() {
            var product = $(this).parent().parent().parent().parent().parent().data('product');
            var imagedata = $(this).parent().parent().parent().parent().parent().data('imagedata');
            productDetails(product, imagedata);
        });

        $("#print-btn").on("click", function() {
            var divToPrint = document.getElementById('product-details');
            var newWin = window.open('', 'Print-Window');
            newWin.document.open();
            newWin.document.write(
                '<link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap.min.css'); ?>" type="text/css"><style type="text/css">@media print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">' +
                divToPrint.innerHTML + '</body>');
            newWin.document.close();
            setTimeout(function() {
                newWin.close();
            }, 10);
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
        }

        function productDetails(product, imagedata) {
            product[11] = product[11].replace(/@/g, '"');
            htmltext = slidertext = '';

            htmltext = '<p><strong>{{ trans('file.Type') }}: </strong>' + product[0] +
                '</p><p><strong>{{ trans('file.name') }}: </strong>' + product[1] +
                '</p><p><strong>{{ trans('file.Code') }}: </strong>' + product[2] +
                '</p><p><strong>{{ trans('file.Brand') }}: </strong>' + product[3] +
                '</p><p><strong>{{ trans('file.category') }}: </strong>' + product[4] +
                '</p><p><strong>{{ trans('file.Quantity') }}: </strong>' + product[16] +
                '</p><p><strong>{{ trans('file.Unit') }}: </strong>' + product[5] +
                '</p><p><strong>{{ trans('file.Cost') }}: </strong>Rp ' + this.formatRupiah(product[6]) +
                '</p><p><strong>{{ trans('file.Price') }}: </strong>Rp ' + this.formatRupiah(product[7], '') +
                '</p><p><strong>{{ trans('file.Tax') }}: </strong>' + product[8] +
                '</p><p><strong>{{ trans('file.Tax Method') }} : </strong>' + product[9] +
                '</p><p><strong>{{ trans('file.Alert Quantity') }} : </strong>' + product[10] +
                '</p><p><strong>{{ trans('file.Product Details') }}: </strong></p>' + product[11];

            if (product[17]) {
                var product_image = product[17].split(",");
                if (product_image.length > 1) {
                    slidertext =
                        '<div id="product-img-slider" class="carousel slide" data-ride="carousel"><div class="carousel-inner">';
                    for (var i = 0; i < product_image.length; i++) {
                        if (!i)
                            slidertext += '<div class="carousel-item active"><img src="public/images/product/' +
                            product_image[i] + '" height="300" width="100%"></div>';
                        else
                            slidertext += '<div class="carousel-item"><img src="public/images/product/' + product_image[i] +
                            '" height="300" width="100%"></div>';
                    }
                    slidertext +=
                        '</div><a class="carousel-control-prev" href="#product-img-slider" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#product-img-slider" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a></div>';
                } else {
                    slidertext = '<img src="public/images/product/' + product[17] + '" height="300" width="100%">';
                }
            }

            $("#combo-header").text('');
            $("table.item-list thead").remove();
            $("table.item-list tbody").remove();
            $("table.product-warehouse-list thead").remove();
            $("table.product-warehouse-list tbody").remove();
            $(".product-variant-warehouse-list thead").remove();
            $(".product-variant-warehouse-list tbody").remove();
            $("#product-warehouse-section").addClass('d-none');
            $("#product-variant-warehouse-section").addClass('d-none');
            if (product[0] == 'combo') {
                $("#combo-header").text('{{ trans('file.Combo Products') }}');
                product_list = product[13].split(",");
                qty_list = product[14].split(",");
                price_list = product[15].split(",");
                $(".item-list thead").remove();
                $(".item-list tbody").remove();
                var newHead = $("<thead>");
                var newBody = $("<tbody>");
                var newRow = $("<tr>");
                newRow.append(
                    '<th>{{ trans('file.product') }}</th><th>{{ trans('file.Quantity') }}</th><th>{{ trans('file.Price') }}</th>'
                );
                newHead.append(newRow);

                $(product_list).each(function(i) {
                    $.get('products/getdata/' + product_list[i], function(data) {
                        var newRow = $("<tr>");
                        var cols = '';
                        cols += '<td>' + data['name'] + ' [' + data['code'] + ']</td>';
                        cols += '<td>' + qty_list[i] + '</td>';
                        cols += '<td>' + price_list[i] + '</td>';

                        newRow.append(cols);
                        newBody.append(newRow);
                    });
                });

                $("table.item-list").append(newHead);
                $("table.item-list").append(newBody);
            } else if (product[0] == 'standard') {
                $.get('products/product_warehouse/' + product[12], function(data) {
                    if (data.product_warehouse[0].length != 0) {
                        warehouse = data.product_warehouse[0];
                        qty = data.product_warehouse[1];
                        var newHead = $("<thead>");
                        var newBody = $("<tbody>");
                        var newRow = $("<tr>");
                        newRow.append(
                            '<th>{{ trans('file.Warehouse') }}</th><th>{{ trans('file.Quantity') }}</th>');
                        newHead.append(newRow);
                        $.each(warehouse, function(index) {
                            var newRow = $("<tr>");
                            var cols = '';
                            cols += '<td>' + warehouse[index] + '</td>';
                            cols += '<td>' + qty[index] + '</td>';

                            newRow.append(cols);
                            newBody.append(newRow);
                            $("table.product-warehouse-list").append(newHead);
                            $("table.product-warehouse-list").append(newBody);
                        });
                        $("#product-warehouse-section").removeClass('d-none');
                    }
                    if (data.product_variant_warehouse[0].length != 0) {
                        warehouse = data.product_variant_warehouse[0];
                        variant = data.product_variant_warehouse[1];
                        qty = data.product_variant_warehouse[2];
                        var newHead = $("<thead>");
                        var newBody = $("<tbody>");
                        var newRow = $("<tr>");
                        newRow.append(
                            '<th>{{ trans('file.Warehouse') }}</th><th>{{ trans('file.Variant') }}</th><th>{{ trans('file.Quantity') }}</th>'
                        );
                        newHead.append(newRow);
                        $.each(warehouse, function(index) {
                            var newRow = $("<tr>");
                            var cols = '';
                            cols += '<td>' + warehouse[index] + '</td>';
                            cols += '<td>' + variant[index] + '</td>';
                            cols += '<td>' + qty[index] + '</td>';

                            newRow.append(cols);
                            newBody.append(newRow);
                            $("table.product-variant-warehouse-list").append(newHead);
                            $("table.product-variant-warehouse-list").append(newBody);
                        });
                        $("#product-variant-warehouse-section").removeClass('d-none');
                    }
                });
            }

            $('#product-content').html(htmltext);
            $('#slider-content').html(slidertext);
            $('#product-details').modal('show');
            $('#product-img-slider').carousel(0);
        }

        // Fungsi untuk menghasilkan QR code
        function generateQRCode(data, elementId) {
            document.getElementById(elementId).innerHTML = "";
            var qrcode = new QRCode(document.getElementById(elementId), {
                text: data,
                width: 180,
                height: 180
            });
        }

        $(document).ready(function() {
            var table = $('#product-data-table').DataTable({
                responsive: true,
                fixedHeader: {
                    header: true,
                    footer: true
                },
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: '{!! route('product-datatable') !!}',
                    dataType: "json",
                    type: "get"
                },
                    "columns": [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        "data": "code",
                        render: function(data, type, row) {
                            const product_id = row.id
                            return '<a href="{{ url("products") }}/'+product_id+'" class="btn-detail-product" style="color:blue">' + data + '</a>';
                        }
                    },
                    {
                        "data": "name"
                    },
                    {
                        data: 'image_preview'
                    },
                    {
                        "data": "created_at"
                    },
                    {
                        "data": "price"
                    },
                    {
                        "data": "tag_type_code"
                    },
                    {
                        "data": "tag_type_color"
                    },
                    {
                        "data": "mg"
                    },
                    {
                        "data": "gramasi_gramasi"
                    },
                    {
                        "data": "product_property_description"
                    },
                    {
                        "data": "product_status"
                    },
                    {
                        "data": "invoice_number"
                    },
                    {
                        "data": "action"
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
                order: [
                    ['3', 'desc']
                ],
                columnDefs: [{
                    "orderable": false,
                    'targets': [0, 3]
                    },
                    {
                        'render': function(data, type, row, meta) {
                            if (type === 'display') {
                                data =
                                    '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                            }

                            return data;
                        },
                        'checkboxes': {
                            'selectRow': true,
                            'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                        },
                        'targets': [0]
                    }
                ],
                'select': {
                    style: 'multi',
                    selector: 'td:first-child'
                },
                'lengthMenu': [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                dom: '<"row"lfB>rtip',
                buttons: [{
                        extend: 'pdf',
                        text: '{{ trans('file.PDF') }}',
                        exportOptions: {
                            columns: ':visible:not(.not-exported)',
                            rows: ':visible',
                            stripHtml: false
                        },
                        customize: function(doc) {
                            for (var i = 1; i < doc.content[1].table.body.length; i++) {
                                if (doc.content[1].table.body[i][0].text.indexOf('<img src=') !== -
                                    1) {
                                    var imagehtml = doc.content[1].table.body[i][0].text;
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
                        extend: 'csv',
                        text: '{{ trans('file.CSV') }}',
                        exportOptions: {
                            columns: ':visible:not(.not-exported)',
                            rows: ':visible',
                            format: {
                                body: function(data, row, column, node) {
                                    if (column === 0 && (data.indexOf('<img src=') !== -1)) {
                                        var regex = /<img.*?src=['"](.*?)['"]/;
                                        data = regex.exec(data)[1];
                                    }
                                    return data;
                                }
                            }
                        }
                    },
                    // {
                    //     extend: 'print',
                    //     text: '{{ trans('file.Print') }}',
                    //     exportOptions: {
                    //         columns: ':visible:not(.not-exported)',
                    //         rows: ':visible',
                    //         stripHtml: false
                    //     }
                    // },
                    {
                        text: '{{ trans('file.delete') }}',
                        className: 'buttons-delete',
                        action: function(e, dt, node, config) {
                            if (!user_verified) {
                                return alert('This feature is disable for demo!')
                            }
                            ids = []
                            $.each($('.dt-checkboxes:checked'), function(indexInArray, valueOfElement) {
                                const tr = $(this).closest('tr'); // get the row target
                                const data = table.row(tr).data(); // get detail data
                                if (data !== undefined) ids.push(data.id)
                            });

                            if (ids.length < 1) {
                                return alert('No data selected!')
                            }
                            const confirmDeleteMultiple = confirm(
                                "Are you sure want to delete?");
                            if (confirmDeleteMultiple) {
                                const url = "{!! url('products/deletebyselection') !!}"
                                axios.post(url, { 
                                        ids : ids 
                                    })
                                    .then(function (response) {
                                        alert(response.data.message)
                                        table.ajax.reload();
                                    })
                                    .catch(function (error) {
                                        const errorMessage = error.response.data
                                        alert(errorMessage)
                                    })

                                return
                            }
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '{{ trans('file.Column visibility') }}',
                        columns: ':gt(0)'
                    },
                ],
            });

            // handle button lihat untuk menapilkan detail produk
            $('#product-data-table tbody').on('click', 'a.btn-view', function(e) {
                e.preventDefault(); // Menghentikan perilaku default dari tombol a
                let id = $(this).data('id'); // Mengambil nilai dari atribut data-id

                // lakukan proses ajax untuk mengambil data detail produk
                $.get("{!! url('products/getDetailById') !!}" + "/" + id, function(data) {
                    // isi inputan yang ada di modal box detail product
                    $("#dtl-code").val(data.code);
                    $("#dtl-price").val(data.price);
                    $("#dtl-tag-code").val(data.tag_type?.code);
                    $("#dtl-gramasi-code").val(data.gramasi?.code);
                    $("#dtl-discount").val(data.discount);
                    $("#dtl-product-property").val(data.product_property?.description);
                    generateQRCode(data.code, "prev-qrcode")
                    // tampilkan modal box detil produk
                    $('#detailModal').modal("show")
                });

                // isi inputan yang ada di modal box detail product
                // $("#dtl-code").val(data.code);
                // $("#dtl-price").val(data.price);
                // $("#dtl-tag-code").val(data.tag_type?.code);
                // $("#dtl-gramasi-code").val(data.gramasi?.code);
                // $("#dtl-discount").val(data.discount);
                // $("#dtl-product-property").val(data.product_property?.description);
                // generateQRCode(data.code, "prev-qrcode")
                // // tampilkan modal box detil produk
                // $('#detailModal').modal("show")
            });

            // handle button hapus untuk menghapus data
            $('#product-data-table tbody').on('click', 'a.btn-delete', function(e) {
                e.preventDefault(); // Menghentikan perilaku default dari tombol a
                let id = $(this).data('id'); // Mengambil nilai dari atribut data-id
                let splitId = $(this).data('splitid'); // Mengambil nilai dari atribut data-splitid
                
                var confirmation = confirm(
                "Apakah Anda yakin ingin menghapus data?"); // konfirmasi aksi hapus data
                if (confirmation) {
                    // lakukan proses hapus data dengan ajax
                    $.ajax({
                        type: "delete",
                        url: "{!! url('products') !!}" + "/" + id + "?split_id=" + splitId,
                        dataType: "JSON",
                        statusCode: {
                            200: function() { // jika code status = 200
                                alert("Data berhasil dihapus")
                                table.ajax.reload()
                            },
                            404: function() { // jika code status = 404
                                alert("Not Found")
                            },
                            500: function(response) { // jika code status = 500
                                alert(response.responseText)
                            },
                        }
                    });
                    return
                }
            });

        });

        // $('select').selectpicker();
</script>
@endsection