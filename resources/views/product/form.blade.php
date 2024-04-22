@extends('layout.main')

@section('content')

<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>
                            @switch($mode)
                            @case('create')
                            {{ trans('file.Create') }} {{ trans('file.product') }}
                            @break
                            @case('edit')
                            {{ trans('file.Edit') }} {{ trans('file.product') }}
                            @break
                            @case('show')
                            {{ trans('file.Detail') }} {{ trans('file.product') }}
                            @break
                            @endswitch
                        </h4>
                    </div>
                    <div class="card-body">
                        <p class="italic">
                            <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                        </p>
                        <form id="product-form" method="POST"
                            action=" {{ !isset($product) ? url('products') : url('products/update/' . $product->id) }}"
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
                                                        @if($mode !='show')
                                                        <input type="file" name="image" class="form-control" id="image"
                                                            onchange="readURL(this)"
                                                            value="@if(@$product){{ @$product->image }}@endif">
                                                        @endif
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
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <label for="">{{ __('file.Product Name') }} *</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ old('name', @$product->name) }}" id="input-name"
                                                    @if($mode=='show' ) readonly @endif required>
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('file.Tag Type Code') }} *</strong> </label>
                                                <select name="tag_type_id" class="form-control" @if($mode=='show' )
                                                    readonly @endif id="tag_type_id">
                                                    <option value="">{{ __('file.Select') }}</option>
                                                    @foreach ($tagType as $item)
                                                    <option value="{{ $item->id }}"
                                                        style="color: {{ $item->color }}; font-weight: bold" {{ $item->
                                                        id == @$product->tag_type_id ?
                                                        'selected' : '' }}>
                                                        {{ $item->code }} - {{ $item->color }}
                                                    </option>
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
                                                    <input type="text" name="code" @if($mode=='show' ) readonly @endif
                                                        class="form-control" id="code" aria-describedby="code"
                                                        value="{{ @$product->code}}" readonly>
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
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('file.category') }} *</strong></label>
                                                        <select name="category_id" @if($mode=='show' ) readonly @endif
                                                            class="form-control" id="input-kd-category">
                                                            <option value="">{{ __('file.Select') }}
                                                            </option>
                                                            @foreach ($category as $item)
                                                            <option value="{{ $item->id }}" @if ( $item->id ==
                                                                @$product->category_id) selected @endif>
                                                                {{ $item->name }}
                                                            </option>
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
                                                        <select name="product_type_id" @if($mode=='show' ) readonly
                                                            @endif class="form-control selectpicker"
                                                            id="product_type_id" @if(!@$product) disabled @endif
                                                            data-live-search="true">
                                                            <option value="" disabled>{{ __('file.Select') }}</option>
                                                            @if (@$product)
                                                            @foreach ($product_type as $item)
                                                            <option value="{{ $item->id }}" @if ($item->id ==
                                                                @$product->product_type_id)
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
                                                        <label for="">{{ __('file.Gold Content') }} *</label>
                                                        <input type="text" @if($mode=='show' ) readonly @endif
                                                            class="form-control" name="gold_content"
                                                            value="{{ old('gold_content', @$product->gold_content) }}"
                                                            id="input-gold_content" required>
                                                        @error('gold_content')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">{{ __('file.Additional Code') }} *</label>
                                                        <input type="text" class="form-control" @if($mode=='show' )
                                                            readonly @endif name="additional_code"
                                                            value="{{ old('additional_code', @$product->additional_code ) }}"
                                                            id="input-additional_code" required>
                                                        @error('additional_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('file.Product Property Code') }}*</strong> </label>
                                                <select name="product_property_id" @if($mode=='show' ) readonly @endif
                                                    class="form-control" id="input-kd-sifat">
                                                    <option value="">{{ __('file.Select') }}
                                                    </option>
                                                    @foreach ($productProperty as $item)
                                                    <option value="{{ $item->id }}" @if ($item->id ==
                                                        @$product->product_property_id) selected @endif>
                                                        {{ $item->code }} -
                                                        {{ $item->description }}</option>
                                                    @endforeach
                                                </select>
                                                @error('product_property_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ trans('file.Product Price') }} *</strong> </label>
                                                        <input type="text" id="price" name="price" @if($mode=='show' )
                                                            readonly @endif class="form-control" step="any"
                                                            value="{{ @$product->price ?? '' }}" readonly>
                                                        @error('price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <span class="validation-msg"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('file.Discount') }} *</strong> </label>
                                                        <input type="number" class="form-control" @if($mode=='show' )
                                                            readonly @endif name="discount" id="input-diskon"
                                                            value="{{ @$product->discount ?? '' }}">
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
                                                        <div id="text-kd-gramasi">{{ @$product->gramasi->gramasi ?? '-'
                                                            }}
                                                        </div>
                                                        <input class="form-control" type="hidden" name="gramasi_id"
                                                            id="input-kd-gramasi"
                                                            value="{{ old('gramasi_id',@$product->gramasi_id) }}">
                                                        @error('gramasi_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>



                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Miligram *</label>
                                                        <input type="number" class="form-control" @if($mode=='show' )
                                                            readonly @endif name="mg" class="mg" id="input-mg"
                                                            value="{{ @$product->mg  ?? ''}}">
                                                        @error('mg')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ trans('file.Split Set Type') }} *</strong> </label>
                                                <select name="split_set_type" @if($mode=='show' ) readonly @endif
                                                    class="form-control" id="input-split-type">
                                                    <option value="">{{ __('file.Select') }}
                                                    </option>
                                                    @foreach ($split_set_type as $item)
                                                    <option value="{{ $item['id'] }}" @if ( $item['id']==@$product->
                                                        split_set_type) selected @endif>
                                                        {{ $item['name'] }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('split_set_type')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div id="detail_split_set" class="bg-dark text-light p-2 d-none">
                                                {{ __('file.Detail Split Set') }}
                                                <div class="form-group">
                                                    <label for="detail_split_set_qty">{{ __('file.Product Qty')
                                                        }}</label>
                                                    <input class="form-control" type="number"
                                                        name="detail_split_set_qty" id="detail_split_set_qty">
                                                </div>
                                                <table>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col-md-6"></div>

                                        <div class="col-md-9 border mt-3">
                                            <div class="row" id="product-preview"
                                                style="background-color: {{ @$product->tagType->color ?? '' }}">
                                                <div class="col-md-6 pt-3">
                                                    <div class="row font-weight-bold">
                                                        <div class="col-md-6 mb-3">
                                                            <h1 id="prev-gold_content"></h1>
                                                            {{-- <h1 id="prev-kd-gramasi"></h1> --}}
                                                        </div>

                                                        <div class="col-md-6 text-right mb-3">
                                                            <div class="add_disc">
                                                                <span id="prev-additional_code"></span> / <span
                                                                    id="prev-diskon"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 text-center">
                                                            <h1 class="d-inline display-4" id="prev-gramasi"></h1>
                                                            <span class="align-top" id="prev-mg"></span>
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
                                <a href="{{url('products')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i>
                                    {{trans('file.Back')}}</a>
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
    const input_categories_id = $('#input-kd-category');
    const input_product_type_id = $('#product_type_id');
    const input_gramasi_id = $('#input-kd-gramasi');
    const text_gramasi_id = $('#text-kd-gramasi');
    let old_image = '{{ $product->image ?? '' }}';
    const image_preview = $('#image-preview');
    const product_property_id = $('#input-kd-sifat');
    const price_col = $('#price');
    const input_split_type = $('#input-split-type');
    const detail_split_set = $('#detail_split_set');
    const genbutton = $('#genbutton');
    const btn_detail_split_add = $('.btn_detail_split_add');
    const btn_detail_split_delete = $('.btn_detail_split_delete');
    let code = $("input[name='code']");
    const table_detail_split_set = $('#detail_split_set table tbody')
    const detail_split_set_qty = $('#detail_split_set_qty');
    
    const produk = @if(@$product) JSON.parse('{!! $product  !!}') @else null @endif;

    $(document).ready(function() {
        input_split_type.attr('disabled', true);
        detail_split_add();
        
    });

    input_split_type.change(function() {
        let split_set_type = $(this).val();
        if (split_set_type == 2) {
            detail_split_set.removeClass('d-none');
            detail_split_set.find('table tbody').html('');
            detail_split_add();
        } else {
            detail_split_set.addClass('d-none');
        }
    });

    detail_split_set_qty.change(function() {
        let qty = $(this).val();
        let last_btn = table_detail_split_set.find('.detail_split_add').last();
        // jumlah qty tidak boleh kurang dari split_set_qty[]
        let split_set_qty = table_detail_split_set.find('input[name="split_set_qty[]"]');

        let total_qty = 0;

        split_set_qty.each(function() {
            if($(this).val() == '') {
                return;
            }
            total_qty += parseInt($(this).val());
        });

        if (qty < total_qty) {
            alert('Jumlah qty tidak boleh kurang dari split set qty');
            $(this).val('');
            
            last_btn.prop('disabled', true);
        }
        
        if (qty > total_qty) {
            last_btn.prop('disabled', false);
        }

        if (qty == total_qty) {
            last_btn.prop('disabled', true);
        }
    });

    // onchange split_set_qty[]
    $(document).on('change', 'input[name="split_set_qty[]"]', function() {
        let product_qty = detail_split_set_qty.val() ? parseInt(detail_split_set_qty.val()) : 0;
        let split_set_qty = table_detail_split_set.find('input[name="split_set_qty[]"]');
        let last_btn = table_detail_split_set.find('.detail_split_add').last();

        let total_qty = 0;

        split_set_qty.each(function() {
            if($(this).val() == '') {
                return;
            }
            total_qty += parseInt($(this).val());
        });

        if (total_qty > product_qty) {
            alert('Jumlah qty tidak boleh lebih dari Qty Product');
            $(this).val('');
            last_btn.prop('disabled', true);
        }

        if (product_qty > total_qty) {
            last_btn.prop('disabled', false);
        }

        if (product_qty == total_qty) {
            last_btn.prop('disabled', true);
        }

    });


    function detail_split_delete(){
            let table = table_detail_split_set;
            const last_row = table_detail_split_set.find('tr').last();
            last_row.remove();

            // show add button
            table_detail_split_set.find('.detail_split_add').last().show();
            table_detail_split_set.find('.btn_detail_split_delete').last().show();

            if (table.find('tr').length == 1) {
                table.find('.btn_detail_split_delete').hide();
            }
    }

    function detail_split_add(){
            let table = table_detail_split_set;
            table.find('.detail_split_add').hide();
            btn_detail_split_delete.hide();
            table.find('.btn_detail_split_delete').hide();

            const row_number = table.find('tr').length + 1;
            const code_split = `${code.val()} - SP${row_number}`;

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
                            <input type="number" name="split_set_qty[]" class="form-control">
                            <button type="button" class="btn btn-danger ml-1 btn_detail_split_delete"><i class="fa fa-times" onclick="detail_split_delete()"></i></button>
                            <button type="button" class="btn btn-success ml-2 detail_split_add" onclick="detail_split_add()"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </td>
            </tr>`;

            table.append(tr);

            // check if there is only one row
            if (table.find('tr').length == 1) {
                table.find('.btn_detail_split_delete').hide();
            }
    }

        

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

        setPrice();

        
    });

    product_property_id.change(function() {
        setPrice();
    });

    function setPrice (){
        let product_property_id_val = product_property_id.val();
        let categories_id = input_categories_id.val();
        let product_type_id = input_product_type_id.val();

        // make sure categories_id and product_type_id is not empty
        if (!categories_id || !product_type_id) {
            return;
        }
        
        price_col.val('');
        $.ajax({
            type: "GET",
            url: "{{ url('master/price-getProductPrice') }}/" + categories_id+"/"+product_type_id+"/"+product_property_id_val,
            success: function(data) {
                if(data){
                    let price = data.price;

                    price_col.val(price);
                }
            }
        });
    }

    input_categories_id.add(input_product_type_id).change(function() {
        input_gramasi_id.val('');
        text_gramasi_id.text('-');
    });

    // old image
    if (old_image) {
        image_preview.html('<img style="max-height:100px" src="{{ asset('') }}/' + old_image + '" class="img-fluid" />');
    }

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

        genbutton.on("click", function() {
            $.get('{!! url("products-gencode") !!}', function(data) {
                $("input[name='code']").val(data);
                generateQRCode(data, "prev-qrcode")
            });

            input_split_type.attr('disabled', false);
            input_split_type.val('');
            input_split_type.trigger('change');
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

        // if edit mode
        if (produk) {
            $("#prev-kd-sifat").text(produk.product_property.code)
            $("#prev-kd-gramasi").text(produk.gramasi.code)
            $("#prev-gramasi").text(produk.gramasi.gramasi)
            $("#prev-diskon").text(produk.discount)
            $("#prev-gold_content").text(produk.gold_content)
            $("#prev-additional_code").text(produk.additional_code)
            $("#prev-mg").text(produk.mg)
            generateQRCode(produk.code, "prev-qrcode");
        }

        @if($mode == 'show')

        $("#tag_type_id").prop('disabled', true);
        $("#input-kd-category").prop('disabled', true);
        $("#product_type_id").prop('disabled', true);
        $("#input-kd-sifat").prop('disabled', true);
        $('#submit-btn').remove();

        @endif

        

        

        
        
        
</script>
@endsection