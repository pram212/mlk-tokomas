@extends('layout.main') @section('content')
<section>
    <div class="container-fluid">
        {{-- @can('create', App\warehouse_transfer::class) --}}
        <a href="{{ route('warehouse_transfer.create') }}" class="btn btn-info"><i class="dripicons-plus"></i>
            {{ __('file.warehouse_transfer_add') }}</a>
        {{-- @endcan --}}
    </div>
    <div class="table-responsive">
        <table id="data-table" class="table" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported">{{ __('file.No') }}</th>
                    <th>{{ __('file.Product Name') }}</th>
                    <th>{{ __('file.warehouse_transfer_date') }}</th>
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
<script src="{{ asset('public/js/pages/warehouse_transfer/warehouse_transfer_index.js?timestamp=' . time()) }}">
</script>
@endsection