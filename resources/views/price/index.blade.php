@extends('layout.main')
@section('title', trans('file.Price'))
@section('content')
<section>
    <div class="container-fluid">
        <h3>{{ trans('file.Gold Price') }} - {{ date('d M Y') }}</h3>
        <hr>
        {{-- @if (in_array('products-add', $all_permission)) --}}
        <a href="{{ route('master.price.create') }}" class="btn btn-info"><i class="dripicons-plus"></i>
            {{ __('file.Add Price') }}</a>
        {{-- @endif --}}
    </div>
    <div class="table-responsive">
        <table id="price-datatable" class="table" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{ __('file.Tag Type') }}</th>
                    <th>{{ __('file.Gramasi') }}</th>
                    <th>{{ __('file.Carat') }}</th>
                    <th>{{ __('file.category') }}</th>
                    {{-- <th>{{ __('file.Product Type') }}</th> --}}
                    <th>{{ __('file.Created By') }}</th>
                    <th>{{ __('file.Updated By') }}</th>
                    <th>{{ __('file.Created At') }}</th>
                    <th>{{ __('file.Updated At') }}</th>
                    <th class="not-exported">{{ trans('file.action') }}</th>
                </tr>
            </thead>

        </table>
    </div>
</section>

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
    const lang_price = '{{ trans('file.price') }}';
</script>
<script src="{{ asset('public/js/pages/price/price_index.js') }}"></script>
@endsection
