@extends('layout.main') @section('content')
@if (session()->has('create_message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('create_message') }}</div>
@endif
@if (session()->has('edit_message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('edit_message') }}</div>
@endif
@if (session()->has('import_message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('import_message') }}</div>
@endif
@if (session()->has('not_permitted'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
@if (session()->has('message'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div>
@endif
<section>
    <div class="container">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4>{{$subTitle }}</h4>
            </div>

            <div class="card-body">
                <p class="italic">
                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                </p>
                @php
                $action = @$gramasi ? route('product-categories.gramasi.update', @$gramasi->id) :
                route('product-categories.gramasi.store');
                @endphp
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
                <form action="{{ $action }}" class="row" method="POST">
                    @csrf
                    @if (@$gramasi)
                    @method('put')
                    @endif
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>{{ __('file.Product Category') }} *</strong> </label>
                            <select name="categories_id" class="form-control" id="categories_id"
                                data-live-search="true">
                                <option value="">{{ __('file.Select') }}</option>
                                @foreach ($category as $item)
                                <option value="{{ $item->id }}" {{ old('categories_id', @$gramasi->categories_id) ==
                                    $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('categories_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>{{ __('file.Product Gramasi Type Code') }} *</strong> </label>
                            <input type="text" name="code" class="form-control" id="code"
                                value="{{ old('code', @$gramasi->code) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>{{ __('file.Product Type') }} *</strong> </label>
                            <select name="product_type_id" class="form-control selectpicker" id="product_type_id"
                                disabled data-live-search="true">
                                <option value="" disabled>{{ __('file.Select') }}</option>
                            </select>
                            @error('product_type_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>{{ __('file.Gramasi') }} *</strong> </label>
                            <input type="number" name="gramasi" class="form-control" id="gramasi"
                                value="{{ old('gramasi', @$gramasi->gramasi) }}">
                            @error('gramasi')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary">{{__('file.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    let product_type_id = $('#product_type_id');
    let button_product_type_id = $('button[data-id="product_type_id"]');
        
    $('#categories_id').change(function() {
        let categories_id = $(this).val();
       
        getProductType(categories_id);
    });

    function getProductType(categories_id) {
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
    }

    $('#product_type_id').change(function() {
            var selectedText = $(this).find('option:selected').text();
            var code = selectedText.split('-')[0];
            $("#product_code").val(code);
        });
    

    // on load
    $(document).ready(function() {
        // if edit mode
    @if (@$gramasi)
    let categories_id = '{{ @$gramasi->categories_id }}';
    let product_type_id = '{{ @$gramasi->product_type_id }}';

    // // trigger change to set the value
    $('#categories_id').trigger('change');

    // set #product_type_id selected value
    // wait for #product_type_id to be enabled
    setTimeout(() => {
        $('#product_type_id').val(product_type_id);
    $('#product_type_id').trigger('change');
    }, 1000);

    // trigger change to set the value
    @endif

    // if add mode, set the value of product_type_id
    @if (!@$gramasi)
    
    @endif
    });
    
    
    
</script>

@endsection