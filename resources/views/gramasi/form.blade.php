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
        <div class="container">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4>{{ __('file.Add Gramasi') }}</h4>
                </div>

                <div class="card-body">
                    <p class="italic">
                        <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small></p>
                    @php
                        $action = @$gramasi ? route('gramasi.update', @$gramasi->id) : route('gramasi.store');
                    @endphp
                    <form action="{{ $action }}" class="row" method="POST">
                        @csrf
                        @if (@$gramasi)
                            @method('put')
                        @endif
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('file.Product Gramasi Type Code') }} *</strong> </label>
                                <select name="product_type_id" class="form-control" id="product_type_id">
                                    <option value="">{{ __('file.Select') }}</option>
                                    @foreach ($productType as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id == @$gramasi->product_type_id) selected @endif>{{ $item->code }} -
                                            {{ $item->description }}</option>
                                    @endforeach
                                </select>
                                @error('product_type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('file.Product Type') }} *</strong> </label>
                                <input type="text" name="product_code" class="form-control" id="product_code"
                                    value="{{ @$gramasi->productType->code }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('file.Freetext') }} *</strong> </label>
                                <input type="number" name="freetext" class="form-control" id="freetext"
                                    value="{{ old('freetext', @$gramasi->freetext) }}">
                                @error('freetext')
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

    <script>
        $('#product_type_id').change(function() {
            var selectedText = $(this).find('option:selected').text();
            var code = selectedText.split('-')[0];
            $("#product_code").val(code);
        });
    </script>
    
@endsection
