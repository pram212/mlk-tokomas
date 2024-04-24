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
        <a href="{{ route('productbaseontag.create') }}" class="btn btn-info"><i class="dripicons-plus"></i>
            {{ __('file.Add Product') }}</a>
        {{-- @endif --}}
    </div>

    <div class="container mt-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @forelse ($productBaseOnTags as $item)
                    <a href="{{ route('productbaseontag.edit', $item->id) }}" class="col-md-4">
                        <div class="card" style="background-color: {{ $item->tagType->color }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between text-white">
                                    <span>{{ $item->gramasi->code }}</span>
                                    <span>{{ $item->productType->code }}</span>
                                </div>
                                <div class="d-flex justify-content-center text-white">
                                    <span>{{ $item->mg }}</span>
                                </div>
                                <div class="d-flex justify-content-between text-white">
                                    <span>{{ $item->gramasi->gramasi }}</span>
                                    <span>{{ $item->productProperty->code }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @empty
                    @endforelse
                </div>
            </div>
            <div class="card-footer">
                @if ($productBaseOnTags->hasPages())
                <div class="pagination-wrapper">
                    {{ $productBaseOnTags->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>


    {{-- <div class="table-responsive">
        <table id="producttype-datatable" class="table" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{ __('file.Code') }}</th>
                    <th>{{ __('file.Description') }}</th>
                    <th class="not-exported">{{ trans('file.action') }}</th>
                </tr>
            </thead>

        </table>
    </div> --}}
</section>

<script src="{{ asset('public/js/axios.min.js') }}"></script>
<script>

</script>
@endsection