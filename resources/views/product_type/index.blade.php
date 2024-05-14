@extends('layout.main') @section('content')
@if (session()->has('create_message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('create_message') }}</div>
@endif
@if (session()->has('edit_message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('edit_message') }}</div>
@endif
@if (session()->has('import_message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('import_message') }}</div>
@endif
@if (session()->has('not_permitted'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
@if (session()->has('message'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div>
@endif

<section>
    <div class="container-fluid">
        {{-- @if (in_array('products-add', $all_permission)) --}}
        <a href="{{ route('product-categories.producttype.create') }}" class="btn btn-info"><i
                class="dripicons-plus"></i>
            {{ __('file.Add Product Type') }}</a>
        {{-- @endif --}}
    </div>
    <div class="table-responsive">
        <table id="producttype-datatable" class="table" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{ __('file.Code') }}</th>
                    <th>{{ __('file.category') }}</th>
                    <th>{{ __('file.Description') }}</th>
                    <th class="not-exported">{{ trans('file.action') }}</th>
                    <th></th>
                </tr>
            </thead>

        </table>
    </div>
</section>

<script src="{{ asset('public/js/axios.min.js') }}"></script>
<script>
    const lang_records_per_page = '{{ trans('file.records per page') }}';
    const lang_Showing = '{{ trans('file.Showing') }}' ;
    const lang_search = '{{ trans('file.Search') }}' ;
    const lang_PDF = '{{ trans('file.PDF') }}';
    const lang_CSV = '{{ trans('file.CSV') }}';
    const lang_print = '{{ trans('file.Print') }}';
    const lang_delete = '{{ trans('file.delete') }}';
    const lang_visibility = '{{ trans('file.Column visibility') }}';
</script>
<script src="{{ asset('public/js/pages/producttype/producttype_index.js') }}"></script>
@endsection