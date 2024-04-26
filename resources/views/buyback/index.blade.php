@extends('layout.main') @section('content')
<style>
    .modal-header .buybackModalLabel {
        font-size: 20px;
        font-weight: bold;
        /* justify content center and verticaly center */
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }

    .modal_desc {
        height: 50%;
        border-bottom: 3px solid rgba(0, 0, 0, 0.2);
    }

    #modal_desc_value {
        position: absolute;
        font-size: 20px;
        font-weight: bold;
        top: 20%;
    }

    .modal_desc span {
        position: absolute;
        display: flex;
        align-items: top;
        justify-content: left;
        left: 0;
        top: 0%;

        background-color: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 5px;
    }

    .modal_price span {
        background-color: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 5px;

        /* top left .modal_price */
        position: absolute;
        display: flex;
        align-items: top;
        justify-content: left;
        left: 0;
        top: 50%;

    }

    #modal_price_value::before {
        content: "Rp. ";
    }

    .modal_price {
        height: 50%;
        display: flex;
        align-items: center;
        justify-content: center;

    }

    #modal_price_value {
        font-size: 20px;
        font-weight: bold;
    }

    .modal_right {
        /* font-size: 20px; */
        /* font-weight: bold; */
        /* height: 50px; */

        border-left: 3px solid rgba(0, 0, 0, 0.2);
    }
</style>
<section>
    <div class="container-fluid">
        <div class="row">
            {{-- Tambahkan Filter Pencarian by Nomor Invoice (products.invoice_number) dan Kode Barang
            (products.code)--}}
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('file.buy back') }} List </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label for="invoice_number" class="col-md-4 col-form-label text-md-right">{{
                                        __('file.Invoice') }}</label>
                                    <div class="col-md-8">
                                        {{-- select2 --}}
                                        <div class="form-group">
                                            <select class="form-control" id="invoice_number" name="invoice_number"
                                                data-live-search="true">
                                                <option value="">{{ __('file.Select') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="code" class="col-md-4 col-form-label text-md-right">
                                        {{ __('file.Product Code') }}</label>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <select class="form-control" id="code" name="code" data-live-search="true">
                                                <option value="">{{ __('file.Select') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- filter button --}}
                            <div class="col-md-2">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary" id="filter">
                                            {{ __('file.Filter') }}
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table id="buyback-data-table" class="table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('file.Code') }}</th>
                                            <th>{{ __('file.Product Name') }}</th>
                                            <th>{{ __('file.Product Image') }}</th>
                                            <th>{{ __('file.Date') }}</th>
                                            <th>{{ trans('file.Price') }}</th>
                                            <th>{{ __('file.Tag Type Code') }}</th>
                                            <th>{{ __('file.Color') }}</th>
                                            <th>Miligram</th>
                                            <th>Gramasi</th>
                                            <th>{{ __('file.Product Property') }}</th>
                                            <th>{{ __('file.Product Status') }}</th>
                                            <th>{{ __('file.Invoice') }}</th>
                                            <th>Buy Back Status</th>
                                            <th class="not-exported">{{ trans('file.action') }}</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- modal --}}
<div class="modal fade" id="buybackModal" tabindex="-1" role="dialog" aria-labelledby="buybackModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row p-2">
                    <span class="buybackModalLabel" id="buybackModalLabel">Perhitungan
                        BuyBack
                    </span>
                    <img class="mr-2 "
                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logo/bima_logo_1.png'))) }}"
                        height="40px" alt="">
                    <img class=""
                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logo/bima_text_1.png'))) }}"
                        height="40px" alt="">
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row p-2 modal_desc">
                            <p id="modal_desc_value"></p>
                            <span>Deskripsi</span>
                        </div>
                        <div class="row p-2 modal_price">
                            <p id="modal_price_value"></p>
                            <span>Harga</span>
                        </div>
                    </div>
                    <div class="col-md-6 p-2 modal_right">
                        <div class="row mb-2">
                            <div class="col-md-6">Harga Awal</div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="modal_price_default" readonly>
                                <input type="hidden" class="form-control" id="product_id">
                                <input type="hidden" class="form-control" id="product_code">
                                <input type="hidden" class="form-control" id="final_price">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">Potongan</div>
                            <div class="col-md-6"><input type="text" class="form-control" id="modal_discount" readonly>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">Biaya tambahan</div>
                            <div class="col-md-6"><input type="text" class="form-control"
                                    onchange="hitungTotalPotongan()" id="modal_additional_cost">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">Keterangan</div>
                            <div class="col-md-6"><input type="text" class="form-control" id="modal_description">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">Sifat Barang</div>
                            <div class="col-md-6">
                                {{-- product properties --}}
                                <select class="form-control" id="modal_product_properties"
                                    name="modal_product_properties">
                                    <option value="">{{ __('file.Select') }}</option>
                                    @foreach ($productProperties as $product_property)
                                    <option value="{{ $product_property->id }}">{{ $product_property->code." -
                                        ".$product_property->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">Totalnya potongan</div>
                            <div class="col-md-6"><input type="text" class="form-control" id="modal_total_discount"
                                    readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary" id="btn_submit">Beli Kembali</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                        {{-- Harga Awal : otomatis tampil sesuai produknya
                        Potongan : Otomatis tampil perhitungannya
                        Biaya tambahan : diinput lg
                        Keterangan : diinput lg
                        Sifat Barang : Dipilih kembali
                        Totalnya potongan : perhitungan potongan + biaya tambahan --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('public/js/qrcode.min.js') }}"></script>
<script>
    const lang_visibility = '{{ __('file.Column visibility') }}';
    const invoice_number = $('#invoice_number');
    const code = $('#code');
    const btn_filter = $('#filter');
    const btn_submit = $('#btn_submit');
    const table_body =$('#buyback-data-table tbody');
    const buybackModal = $('#buybackModal');
    const lang_select = '{{ __('file.Select') }}';
</script>
<script src="{{ asset('public/js/pages/buyback/buyback_list.js') }}"></script>
@endsection