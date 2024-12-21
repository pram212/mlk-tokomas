@extends('layout.main') @section('content')

<section class="forms">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">{{trans('file.Sale Report')}} ({{ $dateToDisplay }})</h3>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'report.sale', 'method' => 'GET']) !!}
                <div class="row mb-3 align-items-end">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="d-tc mt-2"><strong>{{ trans('file.start_date') }}</strong> &nbsp;</label>
                            <input type="text" name="start_date" class="form-control datepicker" id="start_date"
                                value="{{ $startDate->format('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="d-tc mt-2"><strong>{{ trans('file.end_date') }}</strong> &nbsp;</label>
                            <input type="text" name="end_date" class="form-control datepicker" id="end_date"
                                value="{{ $endDate->format('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <div class="form-group">
                            <button class="btn btn-primary" id="filter-btn"
                                type="submit">{{trans('file.submit')}}</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}

                <div class="table-responsive">
                    <table id="report-table" class="table table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">{{trans('file.No')}}</th>
                                <th>{{trans('file.category')}}</th>
                                <th>{{trans('file.Qty')}}</th>
                                <th>{{trans('file.Gramasi')}}</th>
                                <th>{{trans('file.Total')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataSale as $sale)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $sale->category_name }}</td>
                                <td class="text-right">{{ $sale->qty }}</td>
                                <td class="text-right">{{ $sale->gramasi }}</td>
                                <td class="text-right total-value" data-total="{{ $sale->qty + $sale->gramasi }}">{{ $sale->qty + $sale->gramasi }}</td>
                                @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">Penjualan</th>
                                <th class="text-right">{{ $saleQty }}</th>
                                <th class="text-right">{{ $saleGramasi }}</th>
                                <th class="text-right" id="totalPenjualan">{{ $saleTotal }}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Buyback</th>
                                <th class="text-right">{{ $buybackQty }}</th>
                                <th class="text-right">{{ $buybackGramasi }}</th>
                                <th class="text-right" id="totalBuyback">{{ $buybackQty + $buybackGramasi }}</th>
                            </tr>
                            <tr>
                                <th colspan="4">Total</th>
                                <th class="text-right" id="finalTotalCell"></th>
                            </tr>
                            <tr>
                                <th colspan="2">Return</th>
                                <th class="text-right">{{ $returnQty }}</th>
                                <th class="text-right">{{ $returnGramasi }}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>


@endsection

@section('scripts')
<script src="{{ asset('js/pages/report/sale_report.js?timestamp=' . now()->timestamp) }}"></script>

<script>
    $(document).ready(function () {

    var totalPenjualan = parseFloat($('#totalPenjualan').text()) || 0;
    var totalBuyback = parseFloat($('#totalBuyback').text()) || 0;

    var finalTotal = totalPenjualan + totalBuyback;
    $('#finalTotalCell').text(finalTotal);
});

</script>
@endsection
