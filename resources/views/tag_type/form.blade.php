@extends('layout.main') @section('title', trans('file.Tagging Type'))@section('content')
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
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4>{{ __('file.Add Tag Type') }}</h4>
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
                $action = @$tagType ? route('product-categories.tagtype.update', @$tagType->id) :
                route('product-categories.tagtype.store');
                @endphp
                <form action="{{ $action }}" class="row" method="POST">
                    @csrf
                    @if (@$tagType)
                    @method('put')
                    @endif
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('file.Tag Type Code') }} *</strong> </label>
                            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                                id="code" value="{{ old('code', @$tagType->code) }}">
                            @error('code')
                            <small class="text-danger text-sm">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('file.Color Code') }}*</strong> </label>
                            <input type="color" name="color" class="form-control @error('color')
                                        is-invalid
                                    @enderror" id="color" value="{{ old('color', @$tagType->color) }}">
                            @error('color')
                            <small class="text-danger text-sm">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ __('file.Description') }} *</strong> </label>
                            <textarea name="description" class="form-control @error('description')
                                        is-invalid
                                    @enderror"
                                id="description">{{ old('description', @$tagType->description) }}</textarea>
                            @error('description')
                            <small class="text-danger text-sm">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        {{-- back button --}}
                        <a href="{{ route('product-categories.tagtype.index') }}" class="btn btn-danger">{{
                            __('file.Back') }}</a>
                        {{-- submit button --}}
                        <button class="btn btn-primary">{{ __('file.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection