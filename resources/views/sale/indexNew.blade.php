@extends('layout.main') @section('content')
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div>
@endif
@if(session()->has('not_permitted'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif

<section>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header mt-2">
                <h3 class="text-center">{{trans('file.Sale List')}}</h3>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'sales.index', 'method' => 'get']) !!}
                <div class="row mb-3 align-items-end">
                    @php
                    $now = \Carbon\Carbon::now();
                    $date = $now->hour >= 12 ? $now->format('Y-m-d') :
                    $now->subDay()->format('Y-m-d');
                    @endphp
                    <div class="col-md-3 mt-3">
                        <div class="form-group">
                            <label class="d-tc mt-2"><strong>{{ trans('file.start_date') }}</strong> &nbsp;</label>
                            <input type="text" name="start_date" class="form-control datepicker" id="start_date"
                                value="{{ $date }}">
                        </div>
                    </div>
                    <div class="col-md-3 mt-3">
                        <div class="form-group">
                            <label class="d-tc mt-2"><strong>{{ trans('file.end_date') }}</strong> &nbsp;</label>
                            <input type="text" name="end_date" class="form-control datepicker" id="end_date"
                                value="{{ $date }}">
                        </div>
                    </div>

                    <div class="col-md-4 mt-3">
                        <div class="form-group">
                            <label class="d-tc mt-2"><strong>{{trans('file.Warehouse')}}</strong> &nbsp;</label>
                            <div class="d-tc">
                                <select id="warehouse_id" name="warehouse_id" class="selectpicker form-control"
                                    data-live-search="true" data-live-search-style="begins">
                                    <option value="">{{trans('file.All Warehouse')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mt-3 d-flex align-items-end">
                        <div class="form-group">
                            <button class="btn btn-primary" id="filter-btn"
                                type="button">{{trans('file.submit')}}</button>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="sale-table" class="table sale-list" style="width: 100%">
            <thead>
                <tr>
                    <th>{{trans('file.No')}}</th>
                    <th>{{trans('file.Date')}}</th>
                    <th>{{trans('file.Invoice')}}</th>
                    <th>{{trans('file.Cashier')}}</th>
                    <th>{{trans('file.customer')}}</th>
                    <th>{{trans('file.grand total')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>

            <tfoot class="tfoot active">
                <th></th>
                <th>{{trans('file.Total')}}</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tfoot>
        </table>
    </div>
</section>

@include('sale.partials.modal_sale_detail')
@include('sale.partials.modal_sale_view_payment')
@include('sale.partials.modal_sale_add_payment')
@include('sale.partials.modal_sale_add_delivery')


@endsection

@section('scripts')
<script>
    const lang_records_per_page = '{{ trans('file.records per page') }}';
    const lang_Showing = '{{ trans('file.Showing') }}' ;
    const lang_search = '{{ trans('file.Search') }}' ;
    const lang_PDF = '{{ trans('file.PDF') }}';
    const lang_CSV = '{{ trans('file.CSV') }}';
    const lang_print = '{{ trans('file.Print') }}';
    const lang_delete = '{{ trans('file.delete') }}';
    const lang_visibility = '{{ trans('file.Column visibility') }}';
    const asset_url = '{{ asset('public/vendor/bootstrap/css/bootstrap.min.css') }}';
</script>
<script src="{{ asset('public/js/pages/sales/sale_index.js?timestamp=' . now()->timestamp) }}"></script>
@endsection