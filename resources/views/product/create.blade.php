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
                                        <div class="col-md-12 mb-3">
                                            <label>{{trans('file.Product Image')}} *</label>
                                            <div class="row d-flex justify-content-center">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <input type="file" name="image" class="form-control" id="image"
                                                            onchange="readURL(this)">
                                                        <small><i>*{{ trans('Image must be in .jpg, .jpeg, .png
                                                                format
                                                                and maximum 2MB')
                                                                }}</i></small>
                                                        <div id="image-preview"
                                                            style="height: 110px; width: 100%; padding: 5px; border-radius: 5px; border: solid #ccc 1px; margin: auto; text-align: center;">
                                                            <!-- Gambar akan ditampilkan di sini -->
                                                        </div>
                                                    </div>
                                                </div>

                                                @if($errors->has('image'))
                                                <span>
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('file.Tag Type Code') }} *</strong> </label>
                                                <select name="tag_type_id" class="form-control" id="tag_type_id">
                                                    <option value="">{{ __('file.Select') }}</option>
                                                    @foreach ($tagType as $item)
                                                    <option value="{{ $item->id }}"
                                                        style="color: {{ $item->color }}; font-weight: bold" @if($item->
                                                        id == @$productBaseOnTag->tag_type_id) selected @endif> {{
                                                        $item->code }} - {{ $item->color }}</option>
                                                    @endforeach
                                                </select>
                                                @error('tag_type_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ trans('file.Product Code') }} *</strong> </label>
                                                <div class="input-group">
                                                    <input type="text" name="code" class="form-control" id="code"
                                                        aria-describedby="code">
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
                                                <label for="">{{ __('file.Gold Content') }}</label>
                                                <input type="text" class="form-control" name="gold_content"
                                                    value="{{ old('gold_content') }}" id="input-gold_content">
                                                @error('gold_content')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{ __('file.Additional Code') }}</label>
                                                <input type="text" class="form-control" name="additional_code"
                                                    value="{{ old('additional_code') }}" id="input-additional_code">
                                                @error('additional_code')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('file.category') }} *</strong></label>
                                                        <select name="category_id" class="form-control"
                                                            id="input-kd-category">
                                                            <option value="">{{ __('file.Select') }}
                                                            </option>
                                                            @foreach ($category as $item)
                                                            <option value="{{ $item->id }}" @if ($item->id ==
                                                                @$productBaseOnTag->category_id) selected @endif>
                                                                {{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('file.Product Type') }} * </label>
                                                        <select name="product_type_id" class="form-control selectpicker"
                                                            id="product_type_id" @if(!@$price)disabled @endif
                                                            data-live-search="true">
                                                            <option value="" disabled>{{ __('file.Select') }}</option>
                                                            @if (@$price)
                                                            @foreach ($product_type as $item)
                                                            <option value="{{ $item->id }}" @if ($item->id ==
                                                                @$price->product_type_id)
                                                                selected
                                                                @endif>
                                                                {{ $item->code }}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        @error('product_type_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row">
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
                                                        <label>{{ __('file.Discount') }} *</strong> </label>
                                                        <input type="number" class="form-control" name="discount"
                                                            id="input-diskon">
                                                        @error('discount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('file.Gramasi') }} *</strong></label>
                                                        <div id="text-kd-gramasi">{{ $price->gramasi->gramasi ?? '-' }}
                                                        </div>
                                                        <input class="form-control" type="hidden" name="gramasi_id"
                                                            id="input-kd-gramasi"
                                                            value="{{ old('gramasi_id',@$price->gramasi_id) }}">
                                                        @error('gramasi_id')
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
                                                    <option value="{{ $item->id }}" @if ($item->id ==
                                                        @$productBaseOnTag->product_property_id) selected @endif>
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

                                        <div class="col-md-9 border mt-3">
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
                                                                <span id="prev-additional_code"></span> / <span
                                                                    id="prev-diskon"></span>
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
    let input_categories_id = $('#input-kd-category');
    let input_product_type_id = $('#product_type_id');
    let input_gramasi_id = $('#input-kd-gramasi');
    let text_gramasi_id = $('#text-kd-gramasi');
    
    input_categories_id.change(function() {
        let categories_id = $(this).val();
        let product_type_id = $('#product_type_id');
        let button_product_type_id = $('button[data-id="product_type_id"]');
        $.ajax({
            type: "GET",
            url: "{{ url('product-categories/producttype-getByCategory/') }}/" + categories_id,
            success: function(data) {
                let res =data;
                button_product_type_id.toggleClass('disabled', res.data.length == 0);
                product_type_id.prop('disabled', res.data.length == 0);

                let options = '<option value="">{{ __('file.Select') }}</option>';
                if (res.data.length != 0)
                res.data.forEach(element => {
                    options += `<option value="${element.id}">${element.code}</option>`;
                });
                
                product_type_id.html(options);

                // trigger change to set the value
                $('.selectpicker').selectpicker('refresh');
            }
        });
    });

    input_product_type_id.change(function() {
        let product_type_id = $(this).val();
        let categories_id = input_categories_id.val();
        
        $.ajax({
            type: "GET",
            url: "{{ url('product-categories/gramasi-getByCategoryAndProductType') }}/" + categories_id+"/"+product_type_id,
            success: function(data) {
                if(data.data){
                    input_gramasi_id.val(data.data.id);
                    text_gramasi_id.text(data.data.gramasi);

                    prevGramasi(data.data.id);
                }
            }
        });
    });

    input_categories_id.add(input_product_type_id).change(function() {
        input_gramasi_id.val('');
        text_gramasi_id.text('-');
    });

    // preview image
    function readURL(input) {
        let image_preview = $('#image-preview');
        let image    = $('#image');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            // batasi ukuran gambar
            if (input.files[0].size > 2000000) {
                // hapus file yang sudah dipilih
                image.val('');
                image_preview.html('');

                alert("Max file size is 2MB");
                return;
            }

            // batasi tipe gambar
            if (input.files[0].type != 'image/jpeg' && input.files[0].type != 'image/png') {
                // hapus file yang sudah dipilih
                image.val('');
                image_preview.html('');

                alert("Only jpeg and png file type are allowed");
                return;
            }

            reader.onload = function(e) {
                image_preview.html('<img style="max-height:100px" src="' + e.target.result + '" class="img-fluid" />');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

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

        // $("#input-kd-gramasi").change(function(e) {
        //     e.preventDefault();
        //     id = parseInt(e.target.value)
        //     const gramasi = getGramasi(id)
        //     $("#prev-gramasi").text(gramasi.gramasi);
        //     $("#prev-kd-gramasi").text(gramasi.code);
        // });

        function prevGramasi(id) {
            const gramasi = getGramasi(id)
            $("#prev-gramasi").text(gramasi.gramasi);
            $("#prev-kd-gramasi").text(gramasi.code);
        }

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