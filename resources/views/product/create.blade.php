@extends('layout.main')

@section('content')
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4>{{ trans('file.add_product') }}</h4>
                        </div>
                        <div class="card-body">
                            <p class="italic">
                                <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                            </p>
                            <form id="product-form" method="POST" action="{{ url('products') }}" class="dropzone"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('file.Tag Type Code') }} *</strong> </label>
                                                    <select name="tag_type_id" class="form-control" id="tag_type_id">
                                                        <option value="">{{ __('file.Select') }}</option>
                                                        @foreach ($tagType as $item)
                                                            <option value="{{ $item->id }}"
                                                                style="color: {{ $item->color }}; font-weight: bold"
                                                                @if ($item->id == @$productBaseOnTag->tag_type_id) selected @endif>
                                                                {{ $item->code }} - {{ $item->color }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('tag_type_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for=""><strong>{{ __('file.Gold Content') }}</strong></label>
                                                    <input type="text" class="form-control" name="gold_content" value="{{ old('gold_content') }}" id="input-gold_content">
                                                    @error('gold_content')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for=""><strong>{{ __('file.Additional Code') }}</strong></label>
                                                    <input type="text" class="form-control" name="additional_code" value="{{ old('additional_code') }}" id="input-additional_code">
                                                    @error('additional_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('file.Product Code') }} *</strong> </label>
                                                    <div class="input-group">
                                                        <input type="text" name="code" class="form-control"
                                                            id="code" aria-describedby="code">
                                                        <div class="input-group-append">
                                                            <button id="genbutton" type="button"
                                                                class="btn btn-sm btn-default"
                                                                title="{{ trans('file.Generate') }}"><i
                                                                    class="fa fa-refresh"></i></button>
                                                        </div>
                                                    </div>
                                                    @error('code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <span class="validation-msg" id="code-error"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('file.Gramasi Code') }} *</strong></label>
                                                    <select name="gramasi_id" class="form-control" id="input-kd-gramasi">
                                                        <option value="">{{ __('file.Select') }}
                                                        </option>
                                                        @foreach ($gramasi as $item)
                                                            <option value="{{ $item->id }}"
                                                                @if ($item->id == @$productBaseOnTag->gramasi_id) selected @endif>
                                                                {{ $item->code }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('gramasi_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('file.Discount') }} *</strong> </label>
                                                    <input type="number" class="form-control" name="discount"
                                                        id="input-diskon">
                                                    @error('discount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Miligram</label>
                                                    <input type="number" class="form-control" name="mg" class="mg"
                                                        id="input-mg">
                                                    @error('mg')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('file.Product Price') }} *</strong> </label>
                                                    <input type="text" id="price" name="price" class="form-control"
                                                        step="any">
                                                    @error('price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <span class="validation-msg"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('file.Product Property Code') }}*</strong> </label>
                                                    <select name="product_property_id" class="form-control"
                                                        id="input-kd-sifat">
                                                        <option value="">{{ __('file.Select') }}
                                                        </option>
                                                        @foreach ($productProperty as $item)
                                                            <option value="{{ $item->id }}"
                                                                @if ($item->id == @$productBaseOnTag->product_property_id) selected @endif>
                                                                {{ $item->code }} -
                                                                {{ $item->description }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('product_property_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6"></div>

                                            <div class="col-md-9 border">
                                                <div class="row" id="product-preview"
                                                    style="background-color: {{ @$productBaseOnTag->tagType->color }}">
                                                    <div class="col-md-6 pt-3">
                                                        <div class="row font-weight-bold">
                                                            <div class="col-md-6 mb-3">
                                                                <h1 id="prev-gold_content"></h1>
                                                                {{-- <h1 id="prev-kd-gramasi"></h1> --}}
                                                            </div>

                                                            <div class="col-md-6 text-right mb-3">
                                                                <div id="prev-diskon">
                                                                    <span id="prev-additional_code"></span> / <span id="prev-diskon"></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 text-center">
                                                                <h1 class="d-inline display-4" id="prev-mg"></h1>
                                                                <span class="align-top" id="prev-gramasi"></span>
                                                            </div>

                                                            <div class="col-md-12 text-right">
                                                                <h1 id="prev-kd-sifat"></h1>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div
                                                        class="col-md-6 border border-top-0 border-top-0 border-bottom-0 border-right-0">
                                                        <div class="d-flex align-items-center justify-content-center"
                                                            style="min-height: 200px">
                                                            <div class="text-center" id="prev-qrcode">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="{{ trans('file.submit') }}" id="submit-btn"
                                        class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

    <script type="text/javascript">
        $('[data-toggle="tooltip"]').tooltip();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#genbutton').on("click", function() {
            $.get('{!! url("products-gencode") !!}', function(data) {
                $("input[name='code']").val(data);
                generateQRCode(data, "prev-qrcode")
            });
        });

        // Fungsi untuk menghasilkan QR code
        function generateQRCode(data, elementId) {
            document.getElementById(elementId).innerHTML = "";
            var qrcode = new QRCode(document.getElementById(elementId), {
                text: data,
                width: 200,
                height: 200
            });
        }

        // tinymce.init({
        //     selector: 'textarea',
        //     height: 130,
        //     plugins: [
        //         'advlist autolink lists link image charmap print preview anchor textcolor',
        //         'searchreplace visualblocks code fullscreen',
        //         'insertdatetime media table contextmenu paste code wordcount'
        //     ],
        //     toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
        //     branding: false
        // });


        //Delete product
        $("table.order-list tbody").on("click", ".ibtnDel", function(event) {
            $(this).closest("tr").remove();
            calculate_price();
        });

        //Delete variant
        $("table#variant-table tbody").on("click", ".vbtnDel", function(event) {
            $(this).closest("tr").remove();
        });

        $(window).keydown(function(e) {
            if (e.which == 13) {
                var $targ = $(e.target);

                if (!$targ.is("textarea") && !$targ.is(":button,:submit")) {
                    var focusNext = false;
                    $(this).find(":input:visible:not([disabled],[readonly]), a").each(function() {
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

        Dropzone.autoDiscover = false;

        $("#price").maskMoney({thousands:'.', decimal:','})

        const getGramasi = (id_gramasi) => {
            const gramasis = JSON.parse('{!! $gramasi !!}')
            const selectedGramasi = gramasis.find(({
                id
            }) => id === id_gramasi);
            return selectedGramasi
        }

        const getKdSifat = (id_kd_sifat) => {
            const properties = JSON.parse('{!! $productProperty !!}')
            const selectedProerties = properties.find(({
                id
            }) => id === id_kd_sifat);
            return selectedProerties.code
        }

        $("#tag_type_id").change(function(e) {
            e.preventDefault();
            var selectedText = $(this).find('option:selected').text();
            var color = selectedText.split('-')[1];
            $("#product-preview").css("background-color", color);
        });

        $("#input-kd-gramasi").change(function(e) {
            e.preventDefault();
            id = parseInt(e.target.value)
            const gramasi = getGramasi(id)
            $("#prev-gramasi").text(gramasi.gramasi);
            $("#prev-kd-gramasi").text(gramasi.code);
        });

        $("#input-kd-sifat").change(function(e) {
            e.preventDefault();
            id = parseInt(e.target.value)
            const property = getKdSifat(id)
            $("#prev-kd-sifat").text(property);
        });

        $("#input-mg").bind("input", function(e) {
            e.preventDefault();
            const mg = e.target.value
            $("#prev-mg").text(mg);
        });

        $("#input-gold_content").bind("input", function(e) {
            e.preventDefault();
            const goldContent = e.target.value
            $("#prev-gold_content").text(goldContent);
        });

        $("#input-additional_code").bind("input", function(e) {
            e.preventDefault();
            const code = e.target.value
            $("#prev-additional_code").text(code);
        });

        $("#input-diskon").bind("input", function(e) {
            e.preventDefault();
            const diskon = e.target.value
            $("#prev-diskon").text(diskon);
        });
    </script>
@endsection
