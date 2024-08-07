@extends('layout.main') @section('content')
<section>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <select class="form-control" multiple id="filter_warehouse" name="filter_warehouse">
                    </select>
                </div>
                <div class="col-md-6">
                    <select class="form-control" multiple id="filter_status" name="filter_status">
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table id="product-data-table" class="table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="not-exported"></th>
                                    {{-- <th>Barcode</th> --}}
                                    <th>{{ trans('file.Code') }}</th>
                                    <th>{{ __('file.Product Name') }}</th>
                                    <th>{{ __('file.Product Image') }}</th>
                                    <th>{{ __('file.Warehouse') }}</th>
                                    <th>{{ __('file.Date') }}</th>
                                    <th>{{ trans('file.Price') }}</th>
                                    <th>{{ __('file.Tag Type Code') }}</th>
                                    <th>{{ __('file.Color') }}</th>
                                    <th>Miligram</th>
                                    <th>Gramasi</th>
                                    <th>{{ __('file.Product Property') }}</th>
                                    <th>{{ __('file.Product Status') }}</th>
                                    <th>{{ __('file.Invoice') }}</th>

                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('scripts')
{{-- qrcode --}}
<script>
    const lang_records_per_page = '{{ trans("file.records per page") }}';
    const lang_Showing = '{{ trans("file.Showing") }}';
    const lang_search = '{{ trans("file.Search") }}';
    const lang_PDF = '{{ trans("file.PDF") }}';
    const lang_CSV = '{{ trans("file.CSV") }}';
    const lang_print = '{{ trans("file.Print") }}';
    const lang_delete = '{{ trans("file.delete") }}';
    const lang_visibility = '{{ trans("file.Column visibility") }}';

    const lang_Type = '{{ trans("file.Type") }}';
    const lang_name = '{{ trans("file.name") }}';
    const lang_Code = '{{ trans("file.Code") }}';
    const lang_Brand = '{{ trans("file.Brand") }}';
    const lang_category = '{{ trans("file.category") }}';
    const lang_Quantity = '{{ trans("file.Quantity") }}';
    const lang_Unit = '{{ trans("file.Unit") }}';
    const lang_Cost = '{{ trans("file.Cost") }}';
    const lang_Price = '{{ trans("file.Price") }}';
    const lang_Tax = '{{ trans("file.Tax") }}';
    const lang_TaxMethod = '{{ trans("file.Tax Method") }}';
    const lang_AlertQuantity = '{{ trans("file.Alert Quantity") }}';
    const lang_ProductDetails = '{{ trans("file.Product Details") }}';
    const lang_ComboProducts = '{{ trans("file.Combo Products") }}';
    const lang_Warehouse = '{{ trans("file.Warehouse") }}';
    const lang_product = '{{ trans("file.product") }}';


    const url_asset_bootstrap = '{{ asset("public/vendor/bootstrap/css/bootstrap.min.css") }}';
</script>
<script src="{{ asset('public/js/pages/products_stock/product_stock_index.js?timestamp=' . time()) }}"></script>
@endsection
