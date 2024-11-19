@extends('layout.main')
@section('title', trans('file.Product Category'))
@section('content')
@if ($errors->has('name'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('name') }}</div>
@endif
@if ($errors->has('image'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('image') }}</div>
@endif
@if (session()->has('message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div>
@endif
@if (session()->has('not_permitted'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif

<section>
    <div class="container-fluid">
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createModal"><i
                class="dripicons-plus"></i> {{ trans('file.Add Category') }}</button>
        <button class="btn btn-primary d-none" data-toggle="modal" data-target="#importCategory"><i
                class="dripicons-copy"></i>
            {{ trans('file.Import Category') }}</button>
        {{-- trash button --}}
        {{-- <button id="btn_trash" class="btn btn-danger"><i class='dripicons-trash'></i> <span></span></button>
        <input type="hidden" id="modeData" value="index"> --}}
    </div>
    <div class="table-responsive">
        <table id="category-table" class="table" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{ trans('file.category') }}</th>
                    <th>{{ trans('file.width') }} {{ trans('file.category')}}</th>
                    <th>{{ trans('file.height') }} {{ trans('file.category')}}</th>
                    <th>{{ trans('file.Type') }} {{ trans('file.category')}}</th>
                    <th>{{ trans('file.Created At') }}</th>
                    <th class="not-exported">{{ trans('file.action') }}</th>
                    <th>{{ trans('file.Updated By') }}</th>
                </tr>
            </thead>
        </table>
    </div>
</section>

<!-- Create Modal -->
<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'category.store', 'method' => 'post', 'files' => true]) !!}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{ trans('file.Add Category') }}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic">
                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                </p>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>{{ trans('file.name') }} *</label>
                        {{ Form::text('name', null, ['required' => 'required', 'class' => 'form-control', 'placeholder'
                        => trans('file.Type category name').'...' ]) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>{{ trans('file.width') }} *</label>
                        {{ Form::number('width', null, ['required' => 'required', 'class' => 'form-control', 'placeholder' => trans('file.Type width number').'...', 'step' => 'any']) }}

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>{{ trans('file.height') }} *</label>
                        {{ Form::number('height', null, ['required' => 'required', 'class' => 'form-control', 'placeholder'
                        => trans('file.Type height number').'...', 'step' => 'any' ]) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>{{ trans('file.Type') }} *</label>
                        @php
                            $tipeBarcode = [
                                'landscape' => 'Landscape',
                                'potrait' => 'Potrait'
                            ]
                        @endphp
                        {!! Form::select('tipe', $tipeBarcode, null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" value="{{ trans('file.submit') }}" class="btn btn-primary">
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<!-- Edit Modal -->
<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {{ Form::open(['route' => ['category.update', 1], 'method' => 'PUT', 'files' => true, 'id' => 'form-edit'])
            }}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{ trans('file.Update Category') }}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic">
                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                </p>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>{{ trans('file.name') }} *</label>
                        {{ Form::text('name', null, ['required' => 'required', 'class' => 'form-control']) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>{{ trans('file.width') }} *</label>
                        {{ Form::number('width', null, ['required' => 'required', 'class' => 'form-control',  'step' => 'any']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>{{ trans('file.height') }} *</label>
                        {{ Form::number('height', null, ['required' => 'required', 'class' => 'form-control',  'step' => 'any']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>{{ trans('file.Type') }} *</label>
                        @php
                            $tipeBarcode = [
                                'landscape' => 'Landscape',
                                'potrait' => 'Potrait'
                            ]
                        @endphp
                        {!! Form::select('tipe', $tipeBarcode, null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" value="{{ trans('file.submit') }}" class="btn btn-primary">
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<!-- Import Modal -->
<div id="importCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'category.import', 'method' => 'post', 'files' => true]) !!}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{ trans('file.Import Category') }}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic">
                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                </p>
                <p>{{ trans('file.The correct column order is') }} (name*)
                    {{ trans('file.and you must follow this') }}.</p>
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
                            <a href="public/sample_file/sample_category.csv" class="btn btn-info btn-block btn-md"><i
                                    class="dripicons-download"></i> {{ trans('file.Download') }}</a>
                        </div>
                    </div>
                </div>
                <input type="submit" value="{{ trans('file.submit') }}" class="btn btn-primary">
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<script>
    const lang_records_per_page = '{{ trans('file.records per page') }}';
    const lang_Showing = '{{ trans('file.Showing') }}' ;
    const lang_search = '{{ trans('file.Search') }}' ;
    const lang_PDF = '{{ trans('file.PDF') }}';
    const lang_CSV = '{{ trans('file.CSV') }}';
    const lang_print = '{{ trans('file.Print') }}';
    const lang_delete = '{{ trans('file.delete') }}';
    const lang_visibility = '{{ trans('file.Column visibility') }}';
    const lang_category = '{{ trans('file.Product Category') }}';
    // const lang_trash = '{{ trans('file.Trash') }}';

    // const btn_trash = $("#btn_trash");
    // var modeData = $("#modeData");
    // const btn_trash_span = $("#btn_trash span");
    // btn_trash_span.text(lang_trash);
</script>
<script src="{{ asset('public/js/pages/category/categories_index.js') }}"></script>

@endsection
