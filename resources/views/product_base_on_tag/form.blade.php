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
                    <h4>{{ __('file.Add Product Type') }}</h4>
                </div>
                <div class="card-body">
                    <span style="background-color: #e69a1e; height:70%px; width: 100%;"></span>
                    <p class="italic">
                        <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small></p>
                    @php
                        $action = @$productBaseOnTag ? route('productbaseontag.update', @$productBaseOnTag->id) : route('productbaseontag.store');
                    @endphp
                    <form action="{{ $action }}" class="row" method="POST">
                        @csrf
                        @if (@$productBaseOnTag)
                            @method('put')
                        @endif
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('file.Tag Type Code') }} *</strong> </label>
                                <select name="tag_type_id" class="form-control" id="tag_type_id">
                                    <option value="">{{ __('file.Select') }}</option>
                                    @foreach ($tagType as $item)
                                        <option value="{{ $item->id }}" style="color: {{ $item->color }}; font-weight: bold"
                                            @if ($item->id == @$productBaseOnTag->tag_type_id) selected @endif>{{ $item->code }} - {{ $item->color }}</option>
                                    @endforeach
                                </select>
                                @error('tag_type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                
                        </div>

                        <div class="col-md-12">
                            <div class="card" id="product-preview" style="background-color: {{ @$productBaseOnTag->tagType->color }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('file.Gramasi Code') }} *</strong> </label>
                                                <select name="gramasi_id" class="form-control" id="gramasi_id">
                                                    <option value="">{{ __('file.Select') }}</option>
                                                    @foreach ($gramasi as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if ($item->id == @$productBaseOnTag->gramasi_id) selected @endif>{{ $item->code }}</option>
                                                    @endforeach
                                                </select>
                                                @error('gramasi_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('file.Discount') }} *</strong> </label>
                                                <input type="number" class="form-control" name="discount">
                                                {{-- <select name="product_type_id" class="form-control" id="product_type_id">
                                                    <option value="">{{ __('file.Select') }}</option>
                                                    @foreach ($productType as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if ($item->id == @$productBaseOnTag->product_type_id) selected @endif>{{ $item->code }} - {{ $item->description }}</option>
                                                    @endforeach
                                                </select> --}}
                                                @error('discount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12 d-flex justify-content-center">
                                            <input type="number" class="form-control form-control-sm w-50 my-2 text-center" name="mg" placeholder="MG" value="{{ @$productBaseOnTag->mg }}">
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('file.Gramasi') }}</strong> </label>
                                                <input type="text" class="form-control" readonly id="gramasi" value="{{ @$productBaseOnTag->gramasi->gramasi }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('file.Product Property Code') }} *</strong> </label>
                                                <select name="product_property_id" class="form-control" id="product_property_id">
                                                    <option value="">{{ __('file.Select') }}</option>
                                                    @foreach ($productProperty as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if ($item->id == @$productBaseOnTag->product_property_id) selected @endif>{{ $item->code }} - {{ $item->description }}</option>
                                                    @endforeach
                                                </select>
                                                @error('product_property_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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

    <script>

        const getGramasi = (id_gramasi) => {
            const gramasis = JSON.parse('{!! $gramasi !!}')
            const selectedGramasi = gramasis.find( ({ id }) => id === id_gramasi );
            return selectedGramasi.gramasi
        }

        $("#tag_type_id").change(function (e) { 
            e.preventDefault();
            var selectedText = $(this).find('option:selected').text();
            var color = selectedText.split('-')[1];
            $("#product-preview").css("background-color", color);
        });

        $("#gramasi_id").change(function (e) { 
            e.preventDefault();
            id = parseInt(e.target.value)
            const gramasi = getGramasi(id)
            $("#gramasi").val(gramasi);
        });

    </script>
@endsection
