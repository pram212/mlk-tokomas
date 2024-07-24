@extends('layout.main') @section('content')
<section>
    <div class="container-fluid">
        @can('create', App\Product::class)
        <a href="{{ route('products.create') }}" class="btn btn-info"><i class="dripicons-plus"></i>
            {{ __('file.add_product') }}</a>
        <a href="#" data-toggle="modal" data-target="#importProduct" class="btn btn-primary"><i
                class="dripicons-copy"></i> {{ __('file.import_product') }}</a>
        @endcan
    </div>
    <div class="table-responsive">

        <table id="product-data-table" class="table" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    {{-- <th>Barcode</th> --}}
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
                    <th class="not-exported">{{ trans('file.action') }}</th>
                </tr>
            </thead>

        </table>
    </div>
</section>

<div id="importProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'products.import', 'method' => 'post', 'files' => true]) !!}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Import Product</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic">
                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                </p>
                <p>{{ trans('file.The correct column order is') }} (image, name*, code*, type*, brand, category*,
                    unit_code*, cost*, price*, product_details, variant_name, item_code, additional_price)
                    {{ trans('file.and you must follow this') }}.
                </p>
                <p>{{ trans('file.To display Image it must be stored in') }} public/images/product
                    {{ trans('file.directory') }}. {{ trans('file.Image name must be same as product name') }}
                </p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ trans('file.Upload CSV File') }} *</label>
                            {{ Form::file('file', ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> {{ trans('file.Sample File') }}</label>
                            <a href="public/sample_file/sample_products.csv" class="btn btn-info btn-block btn-md"><i
                                    class="dripicons-download"></i> {{ trans('file.Download') }}</a>
                        </div>
                    </div>
                </div>
                {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div id="product-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{ trans('Product Details') }}</h5>
                <button id="print-btn" type="button" class="btn btn-default btn-sm ml-3"><i class="dripicons-print"></i>
                    {{ trans('file.Print') }}</button>
                <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close"><span
                        aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5" id="slider-content"></div>
                    <div class="col-md-5 offset-1" id="product-content"></div>
                    <div class="col-md-5 mt-2" id="product-warehouse-section">
                        <h5>{{ trans('file.Warehouse Quantity') }}</h5>
                        <table class="table table-bordered table-hover product-warehouse-list">
                            <thead>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-7 mt-2" id="product-variant-warehouse-section">
                        <h5>{{ trans('file.Warehouse quantity of product variants') }}</h5>
                        <table class="table table-bordered table-hover product-variant-warehouse-list">
                            <thead>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <h5 id="combo-header"></h5>
                <table class="table table-bordered table-hover item-list">
                    <thead>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">{{ __('file.Product Details') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-12 mb-3 border">
                        <div class="h-100 d-flex align-items-center justify-content-center">
                            <div class="text-center" id="prev-qrcode">
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="code">{{ __('file.Product Code') }} :</label>
                            <input type="text" id="dtl-code" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="code">{{ __('file.Price') }} :</label>
                            <input type="text" id="dtl-price" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="code">{{ __('file.Tag Type Code') }} :</label>
                            <input type="text" id="dtl-tag-code" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="code">{{ __('file.Gramasi Code') }} :</label>
                            <input type="text" id="dtl-gramasi-code" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="code">{{ __('file.Discount') }} :</label>
                            <input type="text" id="dtl-discount" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="code">{{ __('file.Product Property Code') }} :</label>
                            <input type="text" id="dtl-product-property" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
{{-- qrcode --}}
<script src="{{ asset('public/js/qrcode.min.js') }}"></script>
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
<script src="{{ asset('public/js/pages/products/product_index.js?timestamp=' . time()) }}"></script>
@endsection