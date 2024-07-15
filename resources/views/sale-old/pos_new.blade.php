@extends('layout.top-head')

@section('content')
@include('layout.sidebar')
<section class="forms pos-section">
    <div class="container-fluid">
        <!-- main content -->
        <div class="row">
            <!-- left content -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select required id="warehouse_id" name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="search-box form-group">
                                    <!-- input live search -->
                                    <input type="text" class="form-control" id="search_field" placeholder="Search product">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- right content -->
            <div class="col-md-6">
                <!-- Topbar Right-->
                @include('sale.pos_header')
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="row">
            <div class="col">
                <div class="payment-options">
                    <div class="column-5">
                        <button style="background: #00cec9" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="cash-btn"><i class="fa fa-money"></i>
                            Cash</button>
                    </div>
                    <div class="column-5">
                        <button style="background-color: #d63031;" type="button" class="btn btn-custom" id="cancel-btn" onclick="return confirmCancel()"><i class="fa fa-close"></i>
                            Cancel</button>
                    </div>
                    <div class="column-5">
                        <button style="background-color: #ffc107;" type="button" class="btn btn-custom" data-toggle="modal" data-target="#recentTransaction"><i class="dripicons-clock"></i>
                            Recent transaction</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- sound effect -->
        <audio id="mysoundclip1" preload="auto">
            <source src="{{url('public/beep/beep-timber.mp3')}}">
            </source>
        </audio>
        <audio id="mysoundclip2" preload="auto">
            <source src="{{url('public/beep/beep-07.mp3')}}">
            </source>
        </audio>
    </div>
</section>
@endsection

@section('scripts')
<script>
    const baseUrl = "{{url('/')}}";
    const _token = "{{ csrf_token() }}";
</script>
<script src="{{asset('public/js/pages/sale/sale_pos.js')}}"></script>
@endsection