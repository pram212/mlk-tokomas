@extends('layout.main')

@section('content')

<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        @php
                        $modeTexts = [
                        'create' => trans('file.Create') . ' ' . trans('file.product'),
                        'edit' => trans('file.Edit') . ' ' . trans('file.product'),
                        'show' => trans('file.Detail') . ' ' . trans('file.product'),
                        ];
                        @endphp

                        <div class="card-header d-flex align-items-center">
                            <h4>{{ $modeTexts[$mode] ?? '' }}</h4>
                        </div>
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

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('file.Warehouse') }} *</strong> </label>
                                                <select name="warehouse_id" class="form-control selectpicker"
                                                    @if($mode=='show' ) readonly @endif id="warehouse_id"
                                                    data-live-search="true">
                                                    <option value="">{{ __('file.Select') }}</option>
                                                    @foreach ($warehouses as $item)
                                                    <option value="{{ $item->id }}"
                                                        style="color: {{ $item->color }}; font-weight: bold" {{ $item->
                                                        id == @$product->product_warehouse->warehouse_id ?
                                                        'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('warehouse_id')
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
                                                        <select data-live-search="true" name="category_id"
                                                            @if($mode=='show' ) readonly @endif class="form-control"
                                                            id="input-kd-category">
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
                                                        <input type="number" @if($mode=='show' ) readonly @endif
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
                                                        <div class="input-group">
                                                            <input type="text" id="price" name="price" @if($mode=='show' )
                                                            readonly @endif class="form-control" step="any"
                                                            value="{{ @$product->product_warehouse->price ?? '' }}"
                                                            readonly>
                                                            @error('price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                            <span class="validation-msg"></span>
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">/ gram</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('file.Total Price') }} *</strong> </label>
                                                        <input type="text" class="form-control" name="total_price" id="total_price"
                                                            value="{{ @$product->total_price ?? '' }}" readonly>
                                                        @error('total_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
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
                                        </div>

                                        <div class="col-md-12">
                                            <div id="detail_split_set" class="bg-dark text-light p-2 d-none">
                                                <div class="row">
                                                    <div class="col-6">{{ __('file.Detail Split Set') }}</div>
                                                    <div class="col-6 d-flex justify-content-end"><button type="button"
                                                            class="btn btn-xs btn_historical_split_set">{{
                                                            __('file.Historical Split Set') }}</button></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="detail_split_set_qty">{{ __('file.Product Qty')
                                                        }}</label>
                                                    <input class="form-control" type="number"
                                                        name="detail_split_set_qty" id="detail_split_set_qty"
                                                        value="{{ $product->qty ?? 0 }}">
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

                            @if($mode == 'show')
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <h4>Historical Products</h4>
                                            <table id="detail_historical_products" class="table table-bordered"
                                                width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>{{ __('file.Product Code') }}</th>
                                                        <th>Status</th>
                                                        <th>Tanggal</th>
                                                        <th>Invoice</th>
                                                        <th>{{ __('file.Product Property') }}</th>
                                                        <th>{{ __('file.Price') }}</th>
                                                        <th>{{ __('file.Gramasi') }}</th>
                                                        <th>Miligram</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="form-group">
                                <a href="{{url()->previous()}}" class="btn btn-info"><i class="fa fa-arrow-left"></i>
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

{{-- modal --}}
@include('product.modal_split_set')


@endsection

@section('scripts')
<script src="{{ asset('public/js/qrcode.min.js') }}"></script>

<script type="text/javascript">
    const mode = '{{ $mode }}';
    const product_id = '{{ @$product->id }}';
    const $input_categories_id = $('#input-kd-category');
    const $input_product_type_id = $('#product_type_id');
    const $input_gramasi_id = $('#input-kd-gramasi');
    const $text_gramasi_id = $('#text-kd-gramasi');
    let old_image = '{{ $product->image ?? '' }}';
    const $image_preview = $('#image-preview');
    const $product_property_id = $('#input-kd-sifat');
    const price_col = $('#price');
    const price_total = $('#total_price');
    const $prev_diskon = $('#prev-diskon');
    const input_split_type = $('#input-split-type');
    const detail_split_set = $('#detail_split_set');
    const genbutton = $('#genbutton');
    const btn_detail_split_add = $('.btn_detail_split_add');
    const btn_detail_split_delete = $('.btn_detail_split_delete');
    let code = $("input[name='code']");
    const table_detail_split_set = $('#detail_split_set table tbody')
    const detail_split_set_qty = $('#detail_split_set_qty');

    const produk = @if(@$product) JSON.parse('{!! $product  !!}') @else null @endif;
    const product_split_set_detail = @if(@$product) produk['product_split_set_detail'] @else null @endif;
    const split_set_id = @if(@$split_set_id) {!! $split_set_id  !!} @else null @endif;

    const lang_select = '{!! __('file.Select') !!}';

    const gramasis = @if(@$gramasi) JSON.parse('{!! $gramasi  !!}') @else null @endif;
    const properties = @if(@$productProperty) JSON.parse('{!! $productProperty  !!}') @else null @endif;

    const btn_historical_split_set = $('.btn_historical_split_set');
    const historical_split_set_modal = $('#historical_split_set_modal');

    const modal_table_detail_split_set = $('#modal_table_detail_split_set tbody');

    const $table_historical = $('#detail_historical_products');

    @if($mode == 'show')
    const split_set_code = '{{ @$split_set_code }}';
    @endif
</script>
<script src="{{ asset('public/js/pages/products/product_form.js') }}"></script>

@endsection
