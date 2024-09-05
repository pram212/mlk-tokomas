@extends('layout.main')
@section('title', trans('file.Price'))
@section('content')
<section>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4>{{ __('file.Price') }}</h4>
            </div>

            <div class="card-body">
                @error('duplicate_data')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ $message }}</strong>
                </div>

                <script>
                    $(".alert").alert();
                </script>
                @enderror

                <span style="background-color: #e69a1e; height:70%px; width: 100%;"></span>
                <p class="italic">
                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                </p>
                @php
                $action = @$price ? route('master.price.update', @$price->id) : route('master.price.store');
                @endphp
                <form action="{{ $action }}" class="row" method="POST">
                    @csrf
                    @if (@$price)
                    @method('put')
                    @endif

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('file.Tag Type') }} *</strong></label>
                            <select name="tag_type_id" class="form-control" id="input-kd-tag-type">
                                <option value="">{{ __('file.Select') }}
                                </option>
                                @foreach ($tagType as $item)
                                <option value="{{ $item->id }}" @if ($item->id == @$price->tag_type_id)
                                    selected
                                    @endif>
                                    {{ $item->code.' - '.$item->description }}</option>
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
                            {{-- Default 0 By Request --}}
                            {{-- <label>{{ __('file.Carat') }} *</strong> </label> --}}
                            <input type="hidden" name="carat" class="form-control" id="carat">
                            {{-- @error('carat')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('file.category') }} *</strong></label>
                                            <select name="categories_id" class="form-control" id="input-kd-category">
                                                <option value="">{{ __('file.Select') }}
                                                </option>
                                                @foreach ($category as $item)
                                                <option value="{{ $item->id }}" @if ($item->id ==
                                                    @$price->categories_id)
                                                    selected
                                                    @endif>
                                                    {{ $item->name }}</option>
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('categories_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
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
                                                    {{ $item->code." - ".$item->description }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @error('product_type_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{-- Hide by Request --}}
                                            {{-- <label>{{ __('file.Gramasi') }} *</strong></label> --}}
                                            {{-- <div id="text-kd-gramasi">{{ $price->gramasi->gramasi ?? '-' }}</div> --}}
                                            <input class="form-control" type="hidden" name="gramasi_id"
                                                id="input-kd-gramasi"
                                                value="{{ old('gramasi_id',@$price->gramasi_id) }}">
                                            @error('gramasi_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('file.Created By') }} *</strong></label>
                                            <input type="text" name="created_by" class="form-control" id="created_by"
                                                value="{{ auth()->user()->name }}" disabled>
                                            @error('code')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mt-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    {{ trans('file.Product Property') }}
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>{{ trans('file.Product Property') }}</th>
                                                                <th>{{ trans('file.Price') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($productProperty as $item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td title="{{ $item->description }}">{{ $item->code }}
                                                                </td>
                                                                <td>
                                                                    @php
                                                                    if(@$price){
                                                                    $productPropertyPrice =
                                                                    $product_property_price->where('product_property_id',
                                                                    $item->id)->first();
                                                                    $priceValue = $productPropertyPrice ?
                                                                    $productPropertyPrice->price : '';
                                                                    }else{
                                                                    $priceValue = '';
                                                                    }
                                                                    @endphp
                                                                    <input type="text"
                                                                        name="product_property_price[{{ $item->id }}]"
                                                                        class="form-control product_property_price"
                                                                        value="{{ $priceValue }}" required>

                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            @if(@$price)
                                                            <input type="hidden" name="price_id"
                                                                value="{{ $product_property_price->isNotEmpty() ? $product_property_price->first()->price_id : '' }}">
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    let price = $("#price");
    let input_categories_id = $('#input-kd-category');
    let input_product_type_id = $('#product_type_id');
    let input_gramasi_id = $('#input-kd-gramasi');
    let text_gramasi_id = $('#text-kd-gramasi');
    let carat = $("#carat");
    let product_property_price= $('.product_property_price');

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
                    options += `<option value="${element.id}">${element.code+' - '+element.description}</option>`;
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
                }
            }
        });
    });

    input_categories_id.add(input_product_type_id).change(function() {
        input_gramasi_id.val('');
        text_gramasi_id.text('-');
    });



    price.maskMoney()

    product_property_price.maskMoney()
    // product_property_type.maskMoney()

    // carat handle number
    carat.on("input", function() {
        var value = $(this).val();
        var value = value.replace(/[^0-9.]/g, '');
        $(this).val(value);
    });
</script>
@endsection
