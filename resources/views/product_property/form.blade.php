@extends('layout.main') @section('content')
    @if (session()->has('create_message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('create_message') }}</div>
    @endif
    @if (session()->has('edit_message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('edit_message') }}</div>
    @endif
    @if (session()->has('import_message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('import_message') }}</div>
    @endif
    @if (session()->has('not_permitted'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
    @endif
    @if (session()->has('message'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div>
    @endif

    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4>{{ __('file.Add Product Property') }}</h4>
                </div>
                <div class="card-body">
                    <span style="background-color: #e69a1e; height:70%px; width: 100%;"></span>
                    <p class="italic">
                        <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small></p>
                    @php
                        $action = @$productProperty ? route('product-categories.productproperty.update', @$productProperty->id) : route('product-categories.productproperty.store');
                    @endphp
                    <form action="{{ $action }}" class="row" method="POST">
                        @csrf
                        @if (@$productProperty)
                            @method('put')
                        @endif
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('file.Product Property Code') }} *</strong> </label>
                                <input type="text" name="code" class="form-control" id="code"
                                    value="{{ old('code', @$productProperty->code) }}">
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('file.Description') }} *</strong> </label>
                                <textarea name="description" class="form-control" id="description">{{ old('description', @$productProperty->description) }}</textarea>
                                @error('description')
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
