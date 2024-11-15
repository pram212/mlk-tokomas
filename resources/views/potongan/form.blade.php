@extends('layout.main')
@section('title', trans('file.Discount'))
@section('content')
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
                @php
                $action = @$potongan ? route('master.potongan.update', @$potongan->id) :
                route('master.potongan.store');
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
                    @if (@$potongan)
                    @method('put')
                    @endif
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>{{ __('file.Code Discount') }} *</strong> </label>
                            <input type="text" name="code" class="form-control" id="code"
                                value="{{ old('code', @$potongan->code) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>{{ __('file.Discount') }} *</strong> </label>
                            <input type="text" name="discount" class="form-control" id="discount"
                                value="{{ old('discount', @$potongan->discount) }}">
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
