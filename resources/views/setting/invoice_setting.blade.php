@extends('layout.main') @section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.invoice_setting')}}</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input
                                fields')}}.</small></p>
                        {!! Form::open(['route' => 'setting.invoiceSettingStore', 'files' => true, 'method' => 'post'])
                        !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.invoice_setting_logo')}} *</label>
                                    <input type="file" name="invoice_logo_file" class="form-control" value="" />
                                </div>
                                @if($errors->has('invoice_logo_file'))
                                <span>
                                    <strong>{{ $errors->first('invoice_logo_file') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.preview')}}</label>
                                    <img src="{{asset(@$invoice_setting->invoice_logo)}}" alt="Invoice Logo"
                                        class="img-thumbnail form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.invoice_setting_watermark')}} *</label>
                                    <input type="file" name="invoice_watermark_file" class="form-control" value="" />
                                </div>
                                @if($errors->has('invoice_watermark_file'))
                                <span>
                                    <strong>{{ $errors->first('invoice_watermark_file') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.preview')}}</label>
                                    <img src="{{asset(@$invoice_setting->invoice_logo_watermark)}}"
                                        alt="Invoice Watermark" class="img-thumbnail form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection