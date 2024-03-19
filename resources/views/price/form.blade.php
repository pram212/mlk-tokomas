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
                    <h4>{{ __('file.Price') }}</h4>
                </div>
                <div class="card-body">
                    <span style="background-color: #e69a1e; height:70%px; width: 100%;"></span>
                    <p class="italic">
                        <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small></p>
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
                                <label>{{ __('file.Product Property') }} *</strong></label>
                                <select name="product_property_id" class="form-control" id="input-kd-gramasi">
                                    <option value="">{{ __('file.Select') }}
                                    </option>
                                    @foreach ($productProperty as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id == @$price->product_property_id) selected @endif>
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
                                            {{ $item->code }}</option>
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
                                <input type="text" name="created_by" class="form-control" id="created_by" value="{{ auth()->user()->name }}" disabled>
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
       
       $("#price").keyup(function (e) { 
            $(this).val(formatRupiah(e.target.value, 'input'))
        });

        function formatRupiah(angka, type) {
            var number_string = '';
            var split = '';
            var sisa = '';
            var rupiah = '';
            var ribuan = '';
            if (angka.toString().includes("-")) {
                var reverse = angka.toString().split('').reverse().join(''),
                    ribuan = reverse.match(/\d{1,3}/g);
                ribuan = ribuan.join('.').split('').reverse().join('');
                return "-" + ribuan;
            }
            if (type == 'input') {
                number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(',');
                sisa = split[0].length % 3;
                rupiah = split[0].substr(0, sisa);
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            } else {
                number_string = angka.toString();
                split = number_string.split(',');
                sisa = split[0].length % 3;
                rupiah = split[0].substr(0, sisa);
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            }


            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            // return prefix == undefined || ? rupiah : (rupiah ? '' + rupiah : '');
            return (rupiah);
        }
    </script>
@endsection
