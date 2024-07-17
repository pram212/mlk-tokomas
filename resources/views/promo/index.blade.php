@extends('layout.main') @section('content')
<section>
    <div class="container-fluid">
        {{-- @can('create', App\promo::class) --}}
        <a href="{{ route('promo.create') }}" class="btn btn-info"><i class="dripicons-plus"></i>
            {{ __('file.add_promo') }}</a>
        {{-- @endcan --}}
    </div>
    <div class="table-responsive">
        <table id="promo-data-table" class="table" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{ __('file.Product Property') }}</th>
                    <th>{{ __('file.Discount') }}</th>
                    <th>{{ __('file.Promotion Starts') }}</th>
                    <th>{{ __('file.Promotion Ends') }}</th>
                    <th class="not-exported">{{ trans('file.action') }}</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</section>


@endsection
@section('scripts')
<script>
    const lang_records_per_page = '{{ trans("file.records per page") }}';
    const lang_Showing = '{{ trans("file.Showing") }}';
    const lang_search = '{{ trans("file.Search") }}';
    const lang_PDF = '{{ trans("file.PDF") }}';
    const lang_CSV = '{{ trans("file.CSV") }}';
    const lang_print = '{{ trans("file.Print") }}';
    const lang_delete = '{{ trans("file.delete") }}';
    const lang_visibility = '{{ trans("file.Column visibility") }}';
</script>
<script src="{{ asset('public/js/pages/promo/promo_index.js?timestamp=' . time()) }}"></script>
@endsection