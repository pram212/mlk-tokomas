@extends('layout.main') @section('content')
<link rel="stylesheet" href="{{asset('public/css/pages/buyback/buyback_list.css')}}">
<section>
    <div class="container-fluid">
        <div class="row">
            {{-- Tambahkan Filter Pencarian by Nomor Invoice (products.invoice_number) dan Kode Barang
            (products.code)--}}
            <div class=" col-md-12">
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
@include('partials.buyback.modal_buyback')


@endsection

@section('scripts')
<script>
    const lang_visibility = '{{ __("file.Column visibility") }}';
    const invoice_number = $('#invoice_number');
    const code = $('#code');
    const btn_filter = $('#filter');
    const btn_submit = $('#btn_submit');
    const table_body = $('#buyback-data-table tbody');
    const buybackModal = $('#buybackModal');
    const lang_select = '{{ __("file.Select") }}';
    const btn_save_additional_cost = $('#btn_save_additional_cost');
</script>
<script src="{{ asset('public/js/pages/buyback/buyback_list.js?timestamp=' . now()->timestamp) }}"></script>
@endsection