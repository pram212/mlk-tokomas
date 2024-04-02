@extends('layout.main')
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
                            <label>{{ __('file.Price') }} *</strong> </label>
                            <input type="text" name="price" class="form-control" id="price"
                                value="{{ old('price', @$price->price) }}">
                            @error('price')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('file.Carat') }} *</strong> </label>
                            <input type="text" name="carat" class="form-control" id="carat"
                                value="{{ old('carat', @$price->carat) }}">
                            @error('carat')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('file.Product Property') }} *</strong></label>
                            <select name="product_property_id" class="form-control" id="input-kd-gramasi">
                                <option value="">{{ __('file.Select') }}
                                </option>
                                @foreach ($productProperty as $item)
                                <option value="{{ $item->id }}" @if ($item->id == @$price->product_property_id) selected
                                    @endif>
                                    {{ $item->code }}</option>
                                @endforeach
                            </select>
                            @error('product_property_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('file.Gramasi Code') }} *</strong></label>
                            <select name="gramasi_id" class="form-control" id="input-kd-gramasi">
                                <option value="">{{ __('file.Select') }}
                                </option>
                                @foreach ($gramasi as $item)
                                <option value="{{ $item->id }}" @if ($item->id == @$price->gramasi_id) selected @endif>
                                    {{ $item->code }} - {{ $item->gramasi }} gr</option>
                                @endforeach
                            </select>
                            @error('gramasi_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('file.Created By') }} *</strong></label>
                            <input type="text" name="created_by" class="form-control" id="created_by"
                                value="{{ auth()->user()->name }}" disabled>
                            @error('code')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
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
    $("#price").maskMoney()
    
    // carat handle number
    $("#carat").on("input", function() {
        var value = $(this).val();
        var value = value.replace(/[^0-9.]/g, '');
        $(this).val(value);
    });
</script>
@endsection