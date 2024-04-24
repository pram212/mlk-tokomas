@extends('layout.main') @section('content')
<section>
    <div class="container-fluid">
        <div class="row">

        </div>
    </div>
    <div class="table-responsive">

        <table id="product-data-table" class="table" style="width: 100%">
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
                    <th class="not-exported">{{ trans('file.action') }}</th>
                </tr>
            </thead>

        </table>
    </div>
</section>


<script src="{{ asset('public/js/qrcode.min.js') }}"></script>
<script>
    const lang_visibility = '{{ __('file.Column visibility') }}';
</script>
<script src="{{ asset('public/js/pages/buyback/buyback_list.js') }}"></script>
@endsection