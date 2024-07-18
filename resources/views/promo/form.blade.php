@extends('layout.main')
@section('title', trans('file.promo'))
@section('content')

<section>
    <div class="container">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4>{{__('file.add_promo') }}</h4>
            </div>

            <div class="card-body">
                <p class="italic">
                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                </p>
                @php
                $action = @$promo ? route('promo.update', @$promo->id) :
                route('promo.store');
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
                    @if (@$promo)
                    @method('put')
                    @endif
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('file.name') }} *</label>
                            <input type="text" name="promo_name" class="form-control" id="promo_name"
                                value="{{ old('promo_name', @$promo->promo_name) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('file.Product Property') }} * </label>
                            <select name="product_properties_id" class="form-control" id="product_properties_id"
                                data-live-search="true">
                                <option value="">{{ __('file.Select') }}</option>
                                @foreach ($product_properties as $item)
                                <option value="{{ $item->id }}" {{ old('product_properties_id', @$promo->
                                    product_properties_id) ==
                                    $item->id ? 'selected' : '' }}>
                                    {{ $item->code.' - '.$item->description }}
                                </option>
                                @endforeach
                            </select>
                            @error('product_properties_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('file.Discount') }} *</label>
                            <input type="text" name="discount" class="form-control" id="discount"
                                value="{{ old('discount', @$promo->discount) }}">
                        </div>
                    </div>

                    {{-- daterange --}}
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label>{{ __('file.Promotion Starts') }} *</label>
                            <input type="text" name="start_period" class="form-control datepicker" id="start_period"
                                value="{{ old('start_period', @$promo->start_period) }}">
                            @error('start_period')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group ">
                            <label>{{ __('file.Promotion Ends') }} *</label>
                            <input type="text" name="end_period" class="form-control datepicker" id="end_period"
                                value="{{ old('end_period', @$promo->end_period) }}">
                            @error('end_period')
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
@endsection

@section('scripts')
<script>
    const $discount = $('#discount');
    $(function () {
        $('.datepicker').datepicker(
            {
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            }
        );

            $discount.on('input', onInputDiscount);
            $discount.on('click', onClickDiscount);

    });

    function onInputDiscount() {
        const value = formatMoneyToDecimal($(this).val()) || 0;
        $(this).val(formatMoney(value));
    }

    function onClickDiscount() {
        $(this).select();
    }
</script>
@endsection