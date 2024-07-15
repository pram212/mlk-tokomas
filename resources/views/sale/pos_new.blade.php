@extends('layout.main', ['pos_view' => true]) @section('content-pos')
@if($errors->has('phone_number'))
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>{{ $errors->first('phone_number') }}
</div>
@endif
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div>
@endif
@if(session()->has('not_permitted'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif

<section id="pos-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                @include('sale.partials.pos_transaction')
            </div>
            <div class="col-md-6">
                @include('sale.partials.pos_information')
            </div>
        </div>
    </div>
</section>

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('public/css/pages/sales/sales_pos_new.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('public/js/pages/sales/sales_pos_new.js?timestamp=' . now()->timestamp) }}"></script>
<script src="{{ asset('public/js/pages/sales/sales_pos_cart.js?timestamp=' . now()->timestamp) }}"></script>
<script src="{{ asset('public/js/pages/sales/sales_pos_info.js?timestamp=' . now()->timestamp) }}"></script>
<script src="{{ asset('public/js/pages/sales/sales_pos_payment.js?timestamp=' . now()->timestamp) }}"></script>
@endsection