@extends('layout.main')
@section('title', trans('file.warehouse_transfer'))
@section('content')

<section>
    <div class="container">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4>{{__('file.warehouse_transfer_add') }}</h4>
            </div>

            <div class="card-body">
                <p class="italic">
                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                </p>
                @php
                $action = @$warehouse_transfer ? route('warehouse_transfer.update', @$warehouse_transfer->id) :
                route('warehouse_transfer.store');
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
                    @if (@$warehouse_transfer)
                    @method('put')
                    @endif
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('file.name') }} *</label>
                            <input type="text" name="warehouse_transfer_name" class="form-control"
                                id="warehouse_transfer_name"
                                value="{{ old('warehouse_transfer_name', @$warehouse_transfer->warehouse_transfer_name) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('file.Discount') }} *</label>
                            <input type="text" name="discount" class="form-control" id="discount"
                                value="{{ old('discount', @$warehouse_transfer->discount) }}">
                        </div>
                    </div>

                    {{-- daterange --}}
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label>{{ __('file.warehouse_transfertion Starts') }} *</label>
                            <input type="text" name="start_period" class="form-control datepicker" id="start_period"
                                value="{{ old('start_period', @$warehouse_transfer->start_period) }}">
                            @error('start_period')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group ">
                            <label>{{ __('file.warehouse_transfertion Ends') }} *</label>
                            <input type="text" name="end_period" class="form-control datepicker" id="end_period"
                                value="{{ old('end_period', @$warehouse_transfer->end_period) }}">
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