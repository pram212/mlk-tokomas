@extends('layout.main') @section('content')
@if(session()->has('message'))
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div> 
@endif
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif

<section>
    <div class="container-fluid">
        <div class="card d-none">
            <div class="card-header mt-2">
                <h3 class="text-center">{{trans('file.Sale List')}}</h3>
            </div>
            {!! Form::open(['route' => 'sales.index', 'method' => 'get']) !!}
            <div class="row mb-3">
                <div class="col-md-4 offset-md-2 mt-3">
                    <div class="form-group row">
                        <label class="d-tc mt-2"><strong>{{trans('file.Choose Your Date')}}</strong> &nbsp;</label>
                        <div class="d-tc">
                            <div class="input-group">
                                <input type="text" class="daterangepicker-field form-control" value="{{$starting_date}} To {{$ending_date}}" required />
                                <input type="hidden" name="starting_date" value="{{$starting_date}}" />
                                <input type="hidden" name="ending_date" value="{{$ending_date}}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-3 @if(\Auth::user()->role_id > 2){{'d-none'}}@endif">
                    <div class="form-group row">
                        <label class="d-tc mt-2"><strong>{{trans('file.Choose Warehouse')}}</strong> &nbsp;</label>
                        <div class="d-tc">
                            <select id="warehouse_id" name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" >
                                <option value="0">{{trans('file.All Warehouse')}}</option>
                                @foreach($lims_warehouse_list as $warehouse)
                                    @if($warehouse->id == $warehouse_id)
                                        <option selected value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                    @else
                                        <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 mt-3">
                    <div class="form-group">
                        <button class="btn btn-primary" id="filter-btn" type="submit">{{trans('file.submit')}}</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        @if(in_array("sales-add", $all_permission))
            {{-- <a href="{{route('sales.create')}}" class="btn btn-info"><i class="dripicons-plus"></i> {{trans('file.Add Sale')}}</a>&nbsp; --}}
            {{-- <a href="{{url('sales/sale_by_csv')}}" class="btn btn-primary"><i class="dripicons-copy"></i> {{trans('file.Import Sale')}}</a> --}}
        @endif
    </div>
    <div class="table-responsive">
        <table id="sale-table" class="table sale-list" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.Date')}}</th>
                    <th>{{trans('file.reference')}}</th>
                    <th>{{trans('file.Cashier')}}</th>
                    <th>{{trans('file.Biller')}}</th>
                    <th>{{trans('file.customer')}}</th>
                    <th>{{trans('file.Sale Status')}}</th>
                    <th>{{trans('file.Payment Status')}}</th>
                    <th>{{trans('file.grand total')}}</th>
                    <th>{{trans('file.Paid')}}</th>
                    <th>{{trans('file.Due')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>
            
            <tfoot class="tfoot active">
                <th></th>
                <th>{{trans('file.Total')}}</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tfoot>
        </table>
    </div>
</section>

<div id="sale-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="container mt-3 pb-2 border-bottom">
                <div class="row">
                    <div class="col-md-3">
                        <button id="print-btn" type="button" class="btn btn-default btn-sm d-print-none"><i class="dripicons-print"></i> {{trans('file.Print')}}</button>
                        
                        {{ Form::open(['route' => 'sale.sendmail', 'method' => 'post', 'class' => 'sendmail-form'] ) }}
                            <input type="hidden" name="sale_id">
                            <button class="btn btn-default btn-sm d-print-none"><i class="dripicons-mail"></i> {{trans('file.Email')}}</button>
                        {{ Form::close() }}
                    </div>
                    <div class="col-md-6">
                        <h3 id="exampleModalLabel" class="modal-title text-center container-fluid">{{$general_setting->site_title}}</h3>
                    </div>
                    <div class="col-md-3">
                        <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close d-print-none"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                    </div>
                    <div class="col-md-12 text-center">
                        <i style="font-size: 15px;">{{trans('file.Sale Details')}}</i>
                    </div>
                </div>
            </div>
            <div id="sale-content" class="modal-body">
            </div>
            <br>
            <table class="table table-bordered product-sale-list">
                <thead>
                    <th>#</th>
                    <th>{{trans('file.product')}}</th>
                    <th>{{trans('file.Qty')}}</th>
                    <th>{{trans('file.Unit Price')}}</th>
                    <th>{{trans('file.Tax')}}</th>
                    <th>{{trans('file.Discount')}}</th>
                    <th>{{trans('file.Subtotal')}}</th>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div id="sale-footer" class="modal-body"></div>
        </div>
    </div>
</div>

<div id="view-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.All')}} {{trans('file.Payment')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover payment-list">
                    <thead>
                        <tr>
                            <th>{{trans('file.date')}}</th>
                            <th>{{trans('file.reference')}}</th>
                            <th>{{trans('file.Account')}}</th>
                            <th>{{trans('file.Amount')}}</th>
                            <th>{{trans('file.Paid By')}}</th>
                            <th>{{trans('file.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="add-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Payment')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'sale.add-payment', 'method' => 'post', 'files' => true, 'class' => 'payment-form' ]) !!}
                    <div class="row">
                        <input type="hidden" name="balance">
                        <div class="col-md-6">
                            <label>{{trans('file.Recieved Amount')}} *</label>
                            <input type="text" id="paying_amountid" name="paying_amount" class="form-control numkey" step="any" required>
                        </div>
                        <div class="col-md-6">
                            <label>{{trans('file.Paying Amount')}} *</label>
                            <input type="text" id="amount" name="amount" class="form-control"  step="any" required>
                        </div>
                        <div class="col-md-6 mt-1">
                            <label>{{trans('file.Change')}} : </label>
                            <p class="change ml-2">0</p>
                        </div>
                        <div class="col-md-6 mt-1">
                            <label>{{trans('file.Paid By')}}</label>
                            <select name="paid_by_id" class="form-control">
                                <option value="1">Cash</option>
                                {{-- <option value="2">Gift Card</option> --}}
                                {{-- <option value="3">Credit Card</option> --}}
                                {{-- <option value="4">Cheque</option> --}}
                                {{-- <option value="5">Paypal</option> --}}
                                {{-- <option value="6">Deposit</option> --}}
                            </select>
                        </div>
                    </div>
                    <div class="gift-card form-group">
                        <label> {{trans('file.Gift Card')}} *</label>
                        <select id="gift_card_id" name="gift_card_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Gift Card...">
                            @php 
                                $balance = [];
                                $expired_date = [];
                            @endphp
                            @foreach($lims_gift_card_list as $gift_card)
                            <?php 
                                $balance[$gift_card->id] = $gift_card->amount - $gift_card->expense;
                                $expired_date[$gift_card->id] = $gift_card->expired_date;
                            ?>
                                <option value="{{$gift_card->id}}">{{$gift_card->card_no}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <div class="card-element" class="form-control">
                        </div>
                        <div class="card-errors" role="alert"></div>
                    </div>
                    <div id="cheque">
                        <div class="form-group">
                            <label>{{trans('file.Cheque Number')}} *</label>
                            <input type="text" name="cheque_no" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label> {{trans('file.Account')}}</label>
                        <select class="form-control selectpicker" name="account_id">
                        @foreach($lims_account_list as $account)
                            @if($account->is_default)
                            <option selected value="{{$account->id}}">{{$account->name}} [{{$account->account_no}}]</option>
                            @else
                            <option value="{{$account->id}}">{{$account->name}} [{{$account->account_no}}]</option>
                            @endif
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{trans('file.Payment Note')}}</label>
                        <textarea rows="3" class="form-control" name="payment_note"></textarea>
                    </div>

                    <input type="hidden" name="sale_id">

                    <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<div id="edit-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Update Payment')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'sale.update-payment', 'method' => 'post', 'class' => 'payment-form' ]) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{trans('file.Recieved Amount')}} *</label>
                            <input type="text" id="edit_paying_amountid" name="edit_paying_amount" class="form-control numkey"  step="any" required>
                        </div>
                        <div class="col-md-6">
                            <label>{{trans('file.Paying Amount')}} *</label>
                            <input type="text" id="edit_amountid" name="edit_amount" class="form-control"  step="any" required>
                        </div>
                        <div class="col-md-6 mt-1">
                            <label>{{trans('file.Change')}} : </label>
                            <p class="change ml-2">0</p>
                        </div>
                        <div class="col-md-6 mt-1">
                            <label>{{trans('file.Paid By')}}</label>
                            <select name="edit_paid_by_id" class="form-control selectpicker">
                                <option value="1">Cash</option>
                                <option value="2">Gift Card</option>
                                <option value="3">Credit Card</option>
                                <option value="4">Cheque</option>
                                <option value="5">Paypal</option>
                                <option value="6">Deposit</option>
                            </select>
                        </div>
                    </div>
                    <div class="gift-card form-group">
                        <label> {{trans('file.Gift Card')}} *</label>
                        <select id="gift_card_id" name="gift_card_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Gift Card...">
                            @foreach($lims_gift_card_list as $gift_card)
                                <option value="{{$gift_card->id}}">{{$gift_card->card_no}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <div class="card-element" class="form-control">
                        </div>
                        <div class="card-errors" role="alert"></div>
                    </div>
                    <div id="edit-cheque">
                        <div class="form-group">
                            <label>{{trans('file.Cheque Number')}} *</label>
                            <input type="text" name="edit_cheque_no" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label> {{trans('file.Account')}}</label>
                        <select class="form-control selectpicker" name="account_id">
                        @foreach($lims_account_list as $account)
                            <option value="{{$account->id}}">{{$account->name}} [{{$account->account_no}}]</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{trans('file.Payment Note')}}</label>
                        <textarea rows="3" class="form-control" name="edit_payment_note"></textarea>
                    </div>

                    <input type="hidden" name="payment_id">

                    <button type="submit" class="btn btn-primary">{{trans('file.update')}}</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<div id="add-delivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Delivery')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'delivery.store', 'method' => 'post', 'files' => true]) !!}
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>{{trans('file.Delivery Reference')}}</label>
                        <p id="dr"></p>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{trans('file.Sale Reference')}}</label>
                        <p id="sr"></p>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>{{trans('file.Status')}} *</label>
                        <select name="status" required class="form-control selectpicker">
                            <option value="1">{{trans('file.Packing')}}</option>
                            <option value="2">{{trans('file.Delivering')}}</option>
                            <option value="3">{{trans('file.Delivered')}}</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-2 form-group">
                        <label>{{trans('file.Delivered By')}}</label>
                        <input type="text" name="delivered_by" class="form-control">
                    </div>
                    <div class="col-md-6 mt-2 form-group">
                        <label>{{trans('file.Recieved By')}} </label>
                        <input type="text" name="recieved_by" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{trans('file.customer')}} *</label>
                        <p id="customer"></p>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{trans('file.Attach File')}}</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{trans('file.Address')}} *</label>
                        <textarea rows="3" name="address" class="form-control" required></textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{trans('file.Note')}}</label>
                        <textarea rows="3" name="note" class="form-control"></textarea>
                    </div>
                </div>
                <input type="hidden" name="reference_no">
                <input type="hidden" name="sale_id">
                <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $("ul#sale").siblings('a').attr('aria-expanded','true');
    $("ul#sale").addClass("show");
    $("ul#sale #sale-list-menu").addClass("active");
    var public_key = <?php echo json_encode($lims_pos_setting_data->stripe_public_key) ?>;
    var all_permission = <?php echo json_encode($all_permission) ?>;
    var sale_id = [];
    // var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;
    var user_verified = 1;
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".daterangepicker-field").daterangepicker({
      callback: function(startDate, endDate, period){
        var starting_date = startDate.format('YYYY-MM-DD');
        var ending_date = endDate.format('YYYY-MM-DD');
        var title = starting_date + ' To ' + ending_date;
        $(this).val(title);
        $('input[name="starting_date"]').val(starting_date);
        $('input[name="ending_date"]').val(ending_date);
      }
    });

    $('.selectpicker').selectpicker('refresh');

    var balance = <?php echo json_encode($balance) ?>;
    var expired_date = <?php echo json_encode($expired_date) ?>;
    var current_date = <?php echo json_encode(date("Y-m-d")) ?>;
    var payment_date = [];
    var payment_reference = [];
    var paid_amount = [];
    var paying_method = [];
    var payment_id = [];
    var payment_note = [];
    var account = [];
    var deposit;

    $(".gift-card").hide();
    $(".card-element").hide();
    $("#cheque").hide();
    $('#view-payment').modal('hide');

    $(document).on("click", "tr.sale-link td:not(:first-child, :last-child)", function() {
        var sale = $(this).parent().data('sale');
        saleDetails(sale);
    });

    $(document).on("click", ".view", function(){
        var sale = $(this).parent().parent().parent().parent().parent().data('sale');
        saleDetails(sale);
    });

    $("#print-btn").on("click", function(){
          var divToPrint=document.getElementById('sale-details');
          var newWin=window.open('','Print-Window');
          newWin.document.open();
          newWin.document.write('<link rel="stylesheet" href="<?php echo asset('/vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css"><style type="text/css">@media print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
          newWin.document.close();
          setTimeout(function(){newWin.close();},10);
    });

    $(document).on("click", "table.sale-list tbody .add-payment", function() {
        $("#cheque").hide();
        $(".gift-card").hide();
        $(".card-element").hide();
        $('select[name="paid_by_id"]').val(1);
        $('.selectpicker').selectpicker('refresh');
        rowindex = $(this).closest('tr').index();
        deposit = $('table.sale-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.deposit').val();
        var sale_id = $(this).data('id').toString();
        var balance = $('table.sale-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(10)').text();
        balance = parseFloat(balance.replace(/,/g, ''));
        $('input[name="paying_amount"]').val(formatRupiah(balance));
        $('#add-payment input[name="balance"]').val(formatRupiah(balance));
        $('input[name="amount"]').val(formatRupiah(balance));
        $('input[name="sale_id"]').val(sale_id);
    });

    $(document).on("click", "table.sale-list tbody .get-payment", function(event) {
        rowindex = $(this).closest('tr').index();
        deposit = $('table.sale-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.deposit').val();
        var id = $(this).data('id').toString();
        $.get('/sales/getpayment/' + id, function(data) {
            $(".payment-list tbody").remove();
            var newBody = $("<tbody>");
            payment_date  = data[0];
            payment_reference = data[1];
            paid_amount = data[2];
            paying_method = data[3];
            payment_id = data[4];
            payment_note = data[5];
            cheque_no = data[6];
            gift_card_id = data[7];
            change = data[8];
            paying_amount = data[9];
            account_name = data[10];
            account_id = data[11];

            $.each(payment_date, function(index){
                var newRow = $("<tr>");
                var cols = '';

                cols += '<td>' + payment_date[index] + '</td>';
                cols += '<td>' + payment_reference[index] + '</td>';
                cols += '<td>' + account_name[index] + '</td>';
                cols += '<td>' + formatRupiah(paid_amount[index]) + '</td>';
                cols += '<td>' + paying_method[index] + '</td>';
                if(paying_method[index] != 'Paypal')
                    cols += `<td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{trans("file.action")}}<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">`
                                // + `
                                // <li>
                                //     <button type="button" class="btn btn-link edit-btn" data-id="` + payment_id[index] +`" data-clicked=false data-toggle="modal" data-target="#edit-payment">
                                //         <i class="dripicons-document-edit"></i> {{trans("file.edit")}}
                                //     </button>
                                // </li>
                                // `
                                + `
                                <li class="divider"></li>
                                {{ Form::open([`route` => `sale.delete-payment`, `method` => `post`] ) }}
                                <li>
                                    <input type="hidden" name="id" value="` + payment_id[index] + `" />
                                    <button type="submit" class="btn btn-link" onclick="return confirmPaymentDelete()">
                                        <i class="dripicons-trash"></i> {{trans("file.delete")}}
                                    </button>
                                </li>
                                {{ Form::close() }}
                            </ul>
                        </div>
                    </td>`;
                else
                    cols += `<td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{trans("file.action")}}<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                {{ Form::open([`route` => `sale.delete-payment`, `method` => `post`] ) }}
                                <li>
                                    <input type="hidden" name="id" value="` + payment_id[index] + `" />
                                    <button type="submit" class="btn btn-link" onclick="return confirmPaymentDelete()">
                                        <i class="dripicons-trash"></i> {{trans("file.delete")}}
                                    </button>
                                </li>
                                {{ Form::close() }}
                            </ul>
                        </div>
                    </td>`;

                newRow.append(cols);
                newBody.append(newRow);
                $("table.payment-list").append(newBody);
            });
            $('#view-payment').modal('show');
        });
    });
    
    $("table.payment-list").on("click", ".edit-btn", function(event) {
        $(".edit-btn").attr('data-clicked', true);        
        $(".card-element").hide();
        $("#edit-cheque").hide();
        $('.gift-card').hide();
        $('#edit-payment select[name="edit_paid_by_id"]').prop('disabled', false);
        var id = $(this).data('id').toString();
        $.each(payment_id, function(index){
            if(payment_id[index] == parseFloat(id)){
                $('input[name="payment_id"]').val(payment_id[index]);
                $('#edit-payment select[name="account_id"]').val(account_id[index]);
                if(paying_method[index] == 'Cash')
                    $('select[name="edit_paid_by_id"]').val(1);
                else if(paying_method[index] == 'Gift Card'){
                    $('select[name="edit_paid_by_id"]').val(2);
                    $('#edit-payment select[name="gift_card_id"]').val(gift_card_id[index]);
                    $('.gift-card').show();
                    $('#edit-payment select[name="edit_paid_by_id"]').prop('disabled', true);
                }
                else if(paying_method[index] == 'Credit Card'){
                    $('select[name="edit_paid_by_id"]').val(3);
                    $.getScript( "/vendor/stripe/checkout.js" );
                    $(".card-element").show();
                    $('#edit-payment select[name="edit_paid_by_id"]').prop('disabled', true);
                }
                else if(paying_method[index] == 'Cheque'){
                    $('select[name="edit_paid_by_id"]').val(4);
                    $("#edit-cheque").show();
                    $('input[name="edit_cheque_no"]').val(cheque_no[index]);
                    $('input[name="edit_cheque_no"]').attr('required', true);
                }
                else
                    $('select[name="edit_paid_by_id"]').val(6);

                $('.selectpicker').selectpicker('refresh');
                $("#payment_reference").html(payment_reference[index]);
                $('input[name="edit_paying_amount"]').val(formatRupiah(paying_amount[index]));
                $('#edit-payment .change').text(formatRupiah(change[index]));
                $('input[name="edit_amount"]').val(formatRupiah(paid_amount[index]));
                $('textarea[name="edit_payment_note"]').val(payment_note[index]);
                return false;
            }
        });
        $('#view-payment').modal('hide');
    });

    $('select[name="paid_by_id"]').on("change", function() {       
        var id = $(this).val();
        $('input[name="cheque_no"]').attr('required', false);
        $('#add-payment select[name="gift_card_id"]').attr('required', false);
        $(".payment-form").off("submit");
        if(id == 2){
            $(".gift-card").show();
            $(".card-element").hide();
            $("#cheque").hide();
            $('#add-payment select[name="gift_card_id"]').attr('required', true);
        }
        else if (id == 3) {
            $.getScript( "/vendor/stripe/checkout.js" );
            $(".card-element").show();
            $(".gift-card").hide();
            $("#cheque").hide();
        } else if (id == 4) {
            $("#cheque").show();
            $(".gift-card").hide();
            $(".card-element").hide();
            $('input[name="cheque_no"]').attr('required', true);
        } else if (id == 5) {
            $(".card-element").hide();
            $(".gift-card").hide();
            $("#cheque").hide();
        } else {
            $(".card-element").hide();
            $(".gift-card").hide();
            $("#cheque").hide();
            if(id == 6){
                if( parseInt($('#add-payment input[name="amount"]').val().replaceAll('.', '') == '' ? 0 :  $('#add-payment input[name="amount"]').val().replaceAll('.', '')  ) > parseInt(deposit))
                    alert('Amount exceeds customer deposit! Customer deposit : ' + deposit);
            }
        }
    });
    
    $('#add-payment select[name="gift_card_id"]').on("change", function() {
        var id = $(this).val();
        if(expired_date[id] < current_date)
            alert('This card is expired!');
        else if($('#add-payment input[name="amount"]').val() > balance[id]){
            alert('Amount exceeds card balance! Gift Card balance: '+ balance[id]);
        }
    });

    $('input[name="paying_amount"]').on("input", function() {
        $(".change").text(formatRupiah( ($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', '')) - ($('input[name="amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="amount"]').val().replaceAll('.', '') ) ));
    });

    $('input[name="amount"]').on("input", function() {
        if( parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', '') ) >  parseInt($('input[name="paying_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="paying_amount"]').val().replaceAll('.', '') ) ) {
            alert('Paying amount cannot be bigger than recieved amount');
            $(this).val('');
        }
        else if( parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', '')) > parseInt($('input[name="balance"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="balance"]').val().replaceAll('.', '') ) ) {
            alert('Paying amount cannot be bigger than due amount');
            $(this).val('');
        }
        $(".change").text(formatRupiah( ($('input[name="paying_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="paying_amount"]').val().replaceAll('.', '')) - ($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', '')) ));
        var id = $('#add-payment select[name="paid_by_id"]').val();
        var amount = parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', '') );
        if(id == 2){
            id = $('#add-payment select[name="gift_card_id"]').val();
            if(amount > balance[id])
                alert('Amount exceeds card balance! Gift Card balance: '+ balance[id]);
        }
        else if(id == 6){
            if(amount > parseInt(deposit))
                alert('Amount exceeds customer deposit! Customer deposit : ' + deposit);
        }
    });

    $('select[name="edit_paid_by_id"]').on("change", function() {        
        var id = $(this).val();
        $('input[name="edit_cheque_no"]').attr('required', false);
        $('#edit-payment select[name="gift_card_id"]').attr('required', false);
        $(".payment-form").off("submit");
        if(id == 2){
            $(".card-element").hide();
            $("#edit-cheque").hide();
            $('.gift-card').show();
            $('#edit-payment select[name="gift_card_id"]').attr('required', true);
        }
        else if (id == 3) {
            $(".edit-btn").attr('data-clicked', true);
            $.getScript( "/vendor/stripe/checkout.js" );
            $(".card-element").show();
            $("#edit-cheque").hide();
            $('.gift-card').hide();
        } else if (id == 4) {
            $("#edit-cheque").show();
            $(".card-element").hide();
            $('.gift-card').hide();
            $('input[name="edit_cheque_no"]').attr('required', true);
        } else {
            $(".card-element").hide();
            $("#edit-cheque").hide();
            $('.gift-card').hide();
            if(id == 6){
                if(parseInt($('input[name="edit_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_amount"]').val().replaceAll('.', '') ) > parseInt(deposit))
                    alert('Amount exceeds customer deposit! Customer deposit : ' + deposit);
            }
        }
    });

    $('#edit-payment select[name="gift_card_id"]').on("change", function() {
        var id = $(this).val();
        if(expired_date[id] < current_date)
            alert('This card is expired!');
        else if($('#edit-payment input[name="edit_amount"]').val() > balance[id])
            alert('Amount exceeds card balance! Gift Card balance: '+ balance[id]);
    });

    $('input[name="edit_paying_amount"]').on("input", function() {
        $(".change").text(formatRupiah( ($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', '')) - parseInt($('input[name="edit_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_amount"]').val().replaceAll('.', '')) ));
    });

    $('input[name="edit_amount"]').on("input", function() {
        if( parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', '') ) > parseInt($('input[name="edit_paying_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_paying_amount"]').val().replaceAll('.', '')) ) {
            alert('Paying amount cannot be bigger than recieved amount');
            $(this).val('');
        }
        $(".change").text(formatRupiah(($('input[name="edit_paying_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_paying_amount"]').val().replaceAll('.', '')) - ($(this).val().replaceAll('.', '')  == '' ? 0 : $(this).val().replaceAll('.', '') ) ));
        var amount = parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', ''));
        var id = $('#edit-payment select[name="gift_card_id"]').val();
        if(amount > balance[id]){
            alert('Amount exceeds card balance! Gift Card balance: '+ balance[id]);
        }
        var id = $('#edit-payment select[name="edit_paid_by_id"]').val();
        if(id == 6){
            if(amount > parseInt(deposit))
                alert('Amount exceeds customer deposit! Customer deposit : ' + deposit);
        }
    });

    $(document).on("click", "table.sale-list tbody .add-delivery", function(event) {
        var id = $(this).data('id').toString();
        $.get('/delivery/create/'+id, function(data) {
            $('#dr').text(data[0]);
            $('#sr').text(data[1]);
            if(data[2]){
                $('select[name="status"]').val(data[2]);
                $('.selectpicker').selectpicker('refresh');
            }
            $('input[name="delivered_by"]').val(data[3]);
            $('input[name="recieved_by"]').val(data[4]);
            $('#customer').text(data[5]);
            $('textarea[name="address"]').val(data[6]);
            $('textarea[name="note"]').val(data[7]);
            $('input[name="reference_no"]').val(data[0]);
            $('input[name="sale_id"]').val(id);
            $('#add-delivery').modal('show');
        });
    });

    var starting_date = $("input[name=starting_date]").val(); 
    var ending_date = $("input[name=ending_date]").val();
    var warehouse_id = $("#warehouse_id").val();
    
    $('#sale-table').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax":{
            url:"sales/sale-data",
            data:{
                all_permission: all_permission,
                starting_date: starting_date,
                ending_date: ending_date,
                warehouse_id: warehouse_id
            },
            dataType: "json",
            type:"post"
        },
        "createdRow": function( row, data, dataIndex ) {
            //alert(data);
            $(row).addClass('sale-link');
            $(row).attr('data-sale', data['sale']);
        },
        "columns": [
            {"data": "key"},
            {"data": "date"},
            {"data": "reference_no"},
            {"data": "cashier"},
            {"data": "biller"},
            {"data": "customer"},
            {"data": "sale_status"},
            {"data": "payment_status"},
            {"data": "grand_total"},
            {"data": "paid_amount"},
            {"data": "due"},
            {"data": "options"},
        ],
        'language': {
            
            'lengthMenu': '_MENU_ {{trans("file.records per page")}}',
             "info":      '<small>{{trans("file.Showing")}} _START_ - _END_ (_TOTAL_)</small>',
            "search":  '{{trans("file.Search")}}',
            'paginate': {
                    'previous': '<i class="dripicons-chevron-left"></i>',
                    'next': '<i class="dripicons-chevron-right"></i>'
            }
        },
        order:[['1', 'desc']],
        'columnDefs': [
            {
                "orderable": false,
                'targets': [0, 3, 4, 5, 6, 9, 10]
            },
            {
                'render': function(data, type, row, meta){
                    if(type === 'display'){
                        data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                    }

                   return data;
                },
                'checkboxes': {
                   'selectRow': true,
                   'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                },
                'targets': [0]
            }
        ],
        'select': { style: 'multi',  selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: 'pdf',
                text: '{{trans("file.PDF")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            // {
            //     extend: 'csv',
            //     text: '{{trans("file.CSV")}}',
            //     exportOptions: {
            //         columns: ':visible:Not(.not-exported)',
            //         rows: ':visible'
            //     },
            //     action: function(e, dt, button, config) {
            //         datatable_sum(dt, true);
            //         $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
            //         datatable_sum(dt, false);
            //     },
            //     footer:true
            // },
            {
                extend: 'print',
                text: '{{trans("file.Print")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            // {
            //     text: '{{trans("file.delete")}}',
            //     className: 'buttons-delete',
            //     action: function ( e, dt, node, config ) {
            //         if(user_verified == '1') {
            //             sale_id.length = 0;
            //             $(':checkbox:checked').each(function(i){
            //                 if(i){
            //                     var sale = $(this).closest('tr').data('sale');
            //                     sale_id[i-1] = sale[13];
            //                 }
            //             });
            //             if(sale_id.length && confirm("Are you sure want to delete?")) {
            //                 $.ajax({
            //                     type:'POST',
            //                     url:'/sales/deletebyselection',
            //                     data:{
            //                         saleIdArray: sale_id
            //                     },
            //                     success:function(data){
            //                         alert(data);
            //                         //dt.rows({ page: 'current', selected: true }).deselect();
            //                         dt.rows({ page: 'current', selected: true }).remove().draw(false);
            //                     }
            //                 });
            //             }
            //             else if(!sale_id.length)
            //                 alert('Nothing is selected!');
            //         }
            //         else
            //             alert('This feature is disable for demo!');
            //     }
            // },
            {
                extend: 'colvis',
                text: '{{trans("file.Column visibility")}}',
                columns: ':gt(0)'
            },
        ],
        drawCallback: function () {
            var api = this.api();
            datatable_sum(api, false);
        }
    } );

    function datatable_sum(dt_selector, is_calling_first) {
        if (dt_selector.rows( '.selected' ).any() && is_calling_first) {
            var rows = dt_selector.rows( '.selected' ).indexes();

            $( dt_selector.column( 7 ).footer() ).html(formatRupiah(dt_selector.cells( rows, 7, { page: 'current' } ).data().sum()));
            $( dt_selector.column( 8 ).footer() ).html(formatRupiah(dt_selector.cells( rows, 8, { page: 'current' } ).data().sum()));
            $( dt_selector.column( 9 ).footer() ).html(formatRupiah(dt_selector.cells( rows, 9, { page: 'current' } ).data().sum()));
        }
        else {
            $( dt_selector.column( 7 ).footer() ).html(formatRupiah(dt_selector.cells( rows, 7, { page: 'current' } ).data().sum()));
            $( dt_selector.column( 8 ).footer() ).html(formatRupiah(dt_selector.cells( rows, 8, { page: 'current' } ).data().sum()));
            $( dt_selector.column( 9 ).footer() ).html(formatRupiah(dt_selector.cells( rows, 9, { page: 'current' } ).data().sum()));
        }
    }

    function saleDetails(sale){
        $("#sale-details input[name='sale_id']").val(sale[13]);

        var htmltext = '<strong>{{trans("file.Date")}}: </strong>'+sale[0]+'<br><strong>{{trans("file.reference")}}: </strong>'+sale[1]+'<br><strong>{{trans("file.Warehouse")}}: </strong>'+sale[27]+'<br><strong>{{trans("file.Sale Status")}}: </strong>'+sale[2]+'<br><br><div class="row"><div class="col-md-6"><strong>{{trans("file.From")}}:</strong><br>'+sale[3]+'<br>'+sale[4]+'<br>'+sale[5]+'<br>'+sale[6]+'<br>'+sale[7]+'<br>'+sale[8]+'</div><div class="col-md-6"><div class="float-right"><strong>{{trans("file.To")}}:</strong><br>'+sale[9]+'<br>'+sale[10]+'<br>'+sale[11]+'<br>'+sale[12]+'</div></div></div>';
        $.get('/sales/product_sale/' + sale[13], function(data){
            $(".product-sale-list tbody").remove();
            var name_code = data[0];
            var qty = data[1];
            var unit_code = data[2];
            var tax = data[3];
            var tax_rate = data[4];
            var discount = data[5];
            var subtotal = data[6];
            var newBody = $("<tbody>");
            $.each(name_code, function(index){
                var newRow = $("<tr>");
                var cols = '';
                cols += '<td><strong>' + (index+1) + '</strong></td>';
                cols += '<td>' + name_code[index] + '</td>';
                cols += '<td>' + qty[index] + ' ' + unit_code[index] + '</td>';
                cols += '<td>' + formatRupiah(subtotal[index] / qty[index]) + '</td>';
                cols += '<td>' + formatRupiah(tax[index]) + '(' + tax_rate[index] + '%)' + '</td>';
                cols += '<td>' + formatRupiah(discount[index]) + '</td>';
                cols += '<td>' + formatRupiah(subtotal[index]) + '</td>';
                newRow.append(cols);
                newBody.append(newRow);
            });

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=4><strong>{{trans("file.Total")}}:</strong></td>';
            cols += '<td>' + formatRupiah(sale[14]) + '</td>';
            cols += '<td>' + formatRupiah(sale[15]) + '</td>';
            cols += '<td>' + formatRupiah(sale[16]) + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong>{{trans("file.Order Tax")}}:</strong></td>';
            cols += '<td>' + formatRupiah(sale[17]) + '(' + sale[18] + '%)' + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong>{{trans("file.Order Discount")}}:</strong></td>';
            cols += '<td>' + formatRupiah(sale[19]) + '</td>';
            newRow.append(cols);
            newBody.append(newRow);
            if(sale[28]) {
                var newRow = $("<tr>");
                cols = '';
                cols += '<td colspan=6><strong>{{trans("file.Coupon Discount")}} ['+sale[28]+']:</strong></td>';
                cols += '<td>' + formatRupiah(sale[29]) + '</td>';
                newRow.append(cols);
                newBody.append(newRow);
            }

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong>{{trans("file.Shipping Cost")}}:</strong></td>';
            cols += '<td>' + formatRupiah(sale[20]) + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong>{{trans("file.grand total")}}:</strong></td>';
            cols += '<td>' + formatRupiah(sale[21]) + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong>{{trans("file.Paid Amount")}}:</strong></td>';
            cols += '<td>' + formatRupiah(sale[22]) + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong>{{trans("file.Due")}}:</strong></td>';
            cols += '<td>' + formatRupiah((sale[21] - sale[22])) + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            $("table.product-sale-list").append(newBody);
        });
        var htmlfooter = '<p><strong>{{trans("file.Sale Note")}}:</strong> '+sale[23]+'</p><p><strong>{{trans("file.Staff Note")}}:</strong> '+sale[24]+'</p><strong>{{trans("file.Created By")}}:</strong><br>'+sale[25]+'<br>'+sale[26];
        $('#sale-content').html(htmltext);
        $('#sale-footer').html(htmlfooter);
        $('#sale-details').modal('show');
    }

    $(document).on('submit', '.payment-form', function(e) {
        if( parseInt($('input[name="paying_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="paying_amount"]').val().replaceAll('.', '')  ) < parseInt($('#amount').val().replaceAll('.', '') == '' ? 0 : $('#amount').val().replaceAll('.', '')  ) ) {
            alert('Paying amount cannot be bigger than recieved amount');
            $('input[name="amount"]').val('');
            $(".change").text(formatRupiah( ($('input[name="paying_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="paying_amount"]').val().replaceAll('.', '') ) - ($('#amount').val().replaceAll('.', '') == '' ? 0 : $('#amount').val().replaceAll('.', '')  ) ));
            e.preventDefault();
        }
        else if( parseInt($('input[name="edit_paying_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_paying_amount"]').val().replaceAll('.', '') ) < parseInt($('input[name="edit_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_amount"]').val().replaceAll('.', '')) ) {
            alert('Paying amount cannot be bigger than recieved amount');
            $('input[name="edit_amount"]').val('');
            $(".change").text(formatRupiah( ($('input[name="edit_paying_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_paying_amount"]').val().replaceAll('.', '') ) - ($('input[name="edit_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_amount"]').val().replaceAll('.', '')) ));
            e.preventDefault();
        }
        
        $('#edit-payment select[name="edit_paid_by_id"]').prop('disabled', false);
    });
    
    if(all_permission.indexOf("sales-delete") == -1)
        $('.buttons-delete').addClass('d-none');

        function confirmDelete() {
            if (confirm("Are you sure want to delete?")) {
                return true;
            }
            return false;
        }

    function confirmPaymentDelete() {
        if (confirm("Are you sure want to delete? If you delete this money will be refunded.")) {
            return true;
        }
        return false;
    }
     
    var edit_paying_amountid = document.getElementById('edit_paying_amountid');
    edit_paying_amountid.addEventListener('keyup', function(e){
        edit_paying_amountid.value = formatRupiah(this.value, 'input');
    });
    edit_paying_amountid.addEventListener('mouseover', function(e){
        edit_paying_amountid.value = formatRupiah(this.value, 'input');
    }); 

    var edit_amountid = document.getElementById('edit_amountid');
    edit_amountid.addEventListener('keyup', function(e){
        edit_amountid.value = formatRupiah(this.value, 'input');
    });
    edit_amountid.addEventListener('mouseover', function(e){
        edit_amountid.value = formatRupiah(this.value, 'input');
    }); 

    var paying_amountid = document.getElementById('paying_amountid');
    paying_amountid.addEventListener('keyup', function(e){
        paying_amountid.value = formatRupiah(this.value, 'input');
    });
    paying_amountid.addEventListener('mouseover', function(e){
        paying_amountid.value = formatRupiah(this.value, 'input');
    }); 

    var amount = document.getElementById('amount');
    amount.addEventListener('keyup', function(e){
        amount.value = formatRupiah(this.value, 'input');
    });
    amount.addEventListener('mouseover', function(e){
        amount.value = formatRupiah(this.value, 'input');
    }); 

     

    function formatRupiah(angka, type){
        var number_string= '';
        var split= '';
        var sisa= '';
        var rupiah= '';
        var ribuan= '';
        if(angka.toString().includes("-")){
            var reverse = angka.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return "-"+ribuan;
        }
        if(type == 'input'){
            number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(',');
			sisa     		= split[0].length % 3;
			rupiah     		= split[0].substr(0, sisa);
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
        }else{
             number_string = angka.toString();
			split   		= number_string.split(',');
			sisa     		= split[0].length % 3;
			rupiah     		= split[0].substr(0, sisa);
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
        }
		    
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			// return prefix == undefined || ? rupiah : (rupiah ? '' + rupiah : '');
            return (rupiah);
	}

</script>
@endsection

@section('scripts')
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>

@endsection