@extends('layout.main') @section('content')
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div>
@endif
@if(session()->has('not_permitted'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif

<section>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header mt-2">
                <h3 class="text-center">{{trans('file.Purchase List')}}</h3>
            </div>
            {!! Form::open(['route' => 'purchases.index', 'method' => 'get']) !!}
            <div class="row mb-3">
                <div class="col-md-4 offset-md-2 mt-3">
                    <div class="form-group row">
                        <label class="d-tc mt-2"><strong>{{trans('file.Choose Your Date')}}</strong> &nbsp;</label>
                        <div class="d-tc">
                            <div class="input-group">
                                <input type="text" class="daterangepicker-field form-control"
                                    value="{{$starting_date}} To {{$ending_date}}" required />
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
                            <select id="warehouse_id" name="warehouse_id" class="selectpicker form-control"
                                data-live-search="true" data-live-search-style="begins">
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
        @if(in_array("purchases-add", $all_permission))
        <a href="{{route('purchases.create')}}" class="btn btn-info"><i class="dripicons-plus"></i> {{trans('file.Add
            Purchase')}}</a>&nbsp;
        <a href="{{url('purchases/purchase_by_csv')}}" class="btn btn-primary"><i class="dripicons-copy"></i>
            {{trans('file.Import Purchase')}}</a>
        @endif
    </div>
    <div class="table-responsive">
        <table id="purchase-table" class="table purchase-list" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.Date')}}</th>
                    <th>{{trans('file.reference')}}</th>
                    <th>{{trans('file.Supplier')}}</th>
                    <th>{{trans('file.Purchase Status')}}</th>
                    <th>{{trans('file.grand total')}}</th>
                    <th>{{trans('file.Paid')}}</th>
                    <th>{{trans('file.Due')}}</th>
                    <th>{{trans('file.Payment Status')}}</th>
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
            </tfoot>
        </table>
    </div>
</section>

<div id="purchase-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="container mt-3 pb-2 border-bottom">
                <div class="row">
                    <div class="col-md-3">
                        <button id="print-btn" type="button" class="btn btn-default btn-sm d-print-none"><i
                                class="dripicons-print"></i> {{trans('file.Print')}}</button>
                    </div>
                    <div class="col-md-6">
                        <h3 id="exampleModalLabel" class="modal-title text-center container-fluid">
                            {{$general_setting->site_title}}</h3>
                    </div>
                    <div class="col-md-3">
                        <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close"
                            class="close d-print-none"><span aria-hidden="true"><i
                                    class="dripicons-cross"></i></span></button>
                    </div>
                    <div class="col-md-12 text-center">
                        <i style="font-size: 15px;">{{trans('file.Purchase Details')}}</i>
                    </div>
                </div>
            </div>
            <div id="purchase-content" class="modal-body"></div>
            <br>
            <table class="table table-bordered product-purchase-list">
                <thead>
                    <th>#</th>
                    <th>{{trans('file.product')}}</th>
                    <th>Qty</th>
                    <th>{{trans('file.Unit Cost')}}</th>
                    <th>{{trans('file.Tax')}}</th>
                    <th>{{trans('file.Discount')}}</th>
                    <th>{{trans('file.Subtotal')}}</th>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div id="purchase-footer" class="modal-body"></div>
        </div>
    </div>
</div>

<div id="view-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.All Payment')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover payment-list">
                    <thead>
                        <tr>
                            <th>{{trans('file.date')}}</th>
                            <th>{{trans('file.Reference No')}}</th>
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

<div id="add-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Payment')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'purchases.add-payment', 'method' => 'post', 'class' => 'payment-form' ]) !!}
                <div class="row">
                    <input type="hidden" name="balance">
                    <div class="col-md-6">
                        <label>{{trans('file.Recieved AmountPurchase')}} *</label>
                        <input type="text" id="idpaying_amount" readonly name="paying_amount"
                            class="form-control numkey" step="any" required>
                    </div>
                    <div class="col-md-6">
                        <label>{{trans('file.Paying AmountPurchase')}} *</label>
                        <input type="text" id="amount" name="amount" class="form-control" step="any" required>
                    </div>
                    <div class="col-md-6 mt-1">
                        <label>{{trans('file.Change')}} : </label>
                        <p class="change ml-2">0</p>
                    </div>
                    <div class="col-md-6 mt-1">
                        <label>{{trans('file.Paid By')}}</label>
                        <select name="paid_by_id" class="form-control">
                            <option value="1">Cash</option>
                            <option value="3">Credit Card</option>
                            <option value="4">Cheque</option>
                        </select>
                    </div>
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

                <input type="hidden" name="purchase_id">

                <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<div id="edit-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Update Payment')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'purchases.update-payment', 'method' => 'post', 'class' => 'payment-form' ])
                !!}
                <div class="row">
                    <div class="col-md-6">
                        <label>{{trans('file.Recieved AmountPurchase')}} *</label>
                        <input type="text" id="idedit_paying_amount" readonly name="edit_paying_amount"
                            class="form-control numkey" step="any" required>
                    </div>
                    <div class="col-md-6">
                        <label>{{trans('file.Paying AmountPurchase')}} *</label>
                        <input type="text" id="idedit_amount" name="edit_amount" class="form-control" step="any"
                            required>
                    </div>
                    <div class="col-md-6 mt-1">
                        <label>{{trans('file.Change')}} : </label>
                        <p class="change ml-2">0</p>
                    </div>
                    <div class="col-md-6 mt-1">
                        <label>{{trans('file.Paid By')}}</label>
                        <select name="edit_paid_by_id" class="form-control selectpicker">
                            <option value="1">Cash</option>
                            <option value="3">Credit Card</option>
                            <option value="4">Cheque</option>
                        </select>
                    </div>
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

<script type="text/javascript">
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

    $("ul#purchase").siblings('a').attr('aria-expanded','true');
    $("ul#purchase").addClass("show");
    $("ul#purchase #purchase-list-menu").addClass("active");

    var public_key = <?php echo json_encode($lims_pos_setting_data->stripe_public_key) ?>;
    var all_permission = <?php echo json_encode($all_permission) ?>;
    
    var purchase_id = [];
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function confirmDelete() {
        if (confirm("Are you sure want to delete?")) {
            return true;
        }
        return false;
    }

    function confirmDeletePayment() {
        if (confirm("Are you sure want to delete? If you delete this money will be refunded")) {
            return true;
        }
        return false;
    }

    $(document).on("click", "tr.purchase-link td:not(:first-child, :last-child)", function(){
        var purchase = $(this).parent().data('purchase');
        purchaseDetails(purchase);
    });

    $(document).on("click", ".view", function(){
        var purchase = $(this).parent().parent().parent().parent().parent().data('purchase');
        purchaseDetails(purchase);
    });

    $("#print-btn").on("click", function(){
          var divToPrint=document.getElementById('purchase-details');
          var newWin=window.open('','Print-Window');
          newWin.document.open();
          newWin.document.write('<link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css"><style type="text/css">@media print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
          newWin.document.close();
          setTimeout(function(){newWin.close();},10);
    });

    $(document).on("click", "table.purchase-list tbody .add-payment", function(event) {
        $("#cheque").hide();
        $(".card-element").hide();
        $('select[name="paid_by_id"]').val(1);
        rowindex = $(this).closest('tr').index();
        var purchase_id = $(this).data('id').toString();
        var balance = $('table.purchase-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(8)').text();
        balance = parseFloat(balance.replace(/,/g, ''));
        $('input[name="amount"]').val(formatRupiah(balance));
        $('input[name="balance"]').val(formatRupiah(balance));
        $('input[name="paying_amount"]').val(formatRupiah(balance));
        $('input[name="purchase_id"]').val(purchase_id);
    });

    $(document).on("click", "table.purchase-list tbody .get-payment", function(event) {
        var id = $(this).data('id').toString();
        $.get('purchases/getpayment/' + id, function(data) {
            $(".payment-list tbody").remove();
            var newBody = $("<tbody>");
            payment_date  = data[0];
            payment_reference = data[1];
            paid_amount = data[2];
            paying_method = data[3];
            payment_id = data[4];
            payment_note = data[5];
            cheque_no = data[6];
            change = data[7];
            paying_amount = data[8];
            account_name = data[9];
            account_id = data[10];

            $.each(payment_date, function(index){
                var newRow = $("<tr>");
                var cols = '';

                cols += '<td>' + payment_date[index] + '</td>';
                cols += '<td>' + payment_reference[index] + '</td>';
                cols += '<td>' + account_name[index] + '</td>';
                cols += '<td>' + formatRupiah(paid_amount[index]) + '</td>';
                cols += '<td>' + paying_method[index] + '</td>';
                cols += '<td><div class="btn-group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action<span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button><ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu"><li><button type="button" class="btn btn-link edit-btn" data-id="' + payment_id[index] +'" data-clicked=false data-toggle="modal" data-target="#edit-payment"><i class="dripicons-document-edit"></i> Edit</button></li><li class="divider"></li>{{ Form::open(['route' => 'purchases.delete-payment', 'method' => 'post'] ) }}<li><input type="hidden" name="id" value="' + payment_id[index] + '" /> <button type="submit" class="btn btn-link" onclick="return confirmDeletePayment()"><i class="dripicons-trash"></i> Delete</button></li>{{ Form::close() }}</ul></div></td>'
                newRow.append(cols);
                newBody.append(newRow);
                $("table.payment-list").append(newBody);
            });
            $('#view-payment').modal('show');
        });
    });

    $(document).on("click", "table.payment-list .edit-btn", function(event) {
        $(".edit-btn").attr('data-clicked', true);        
        $(".card-element").hide();
        $("#edit-cheque").hide();
        $('#edit-payment select[name="edit_paid_by_id"]').prop('disabled', false);
        var id = $(this).data('id').toString();
        $.each(payment_id, function(index){
            if(payment_id[index] == parseFloat(id)){
                $('input[name="payment_id"]').val(payment_id[index]);
                $('#edit-payment select[name="account_id"]').val(account_id[index]);
                if(paying_method[index] == 'Cash')
                    $('select[name="edit_paid_by_id"]').val(1);
                else if(paying_method[index] == 'Credit Card'){
                    $('select[name="edit_paid_by_id"]').val(3);
                    $.getScript( "public/vendor/stripe/checkout.js" );
                    $(".card-element").show();
                    $("#edit-cheque").hide();
                    $('#edit-payment select[name="edit_paid_by_id"]').prop('disabled', true);
                }
                else{
                    $('select[name="edit_paid_by_id"]').val(4);
                    $("#edit-cheque").show();
                    $('input[name="edit_cheque_no"]').val(cheque_no[index]);
                    $('input[name="edit_cheque_no"]').attr('required', true);
                }
                $('input[name="edit_date"]').val(payment_date[index]);
                $("#payment_reference").html(payment_reference[index]);
                $('input[name="edit_amount"]').val(formatRupiah(paid_amount[index]));
                $('input[name="edit_paying_amount"]').val(formatRupiah(paying_amount[index]));
                $('.change').text(formatRupiah(change[index]));
                $('textarea[name="edit_payment_note"]').val(payment_note[index]);
                return false;
            }
        });
        $('.selectpicker').selectpicker('refresh');
        $('#view-payment').modal('hide');
    });

    $('select[name="paid_by_id"]').on("change", function() {        
        var id = $('select[name="paid_by_id"]').val();
        $('input[name="cheque_no"]').attr('required', false);
        $(".payment-form").off("submit");
        if (id == 3) {
            $.getScript( "public/vendor/stripe/checkout.js" );
            $(".card-element").show();
            $("#cheque").hide();
        } else if (id == 4) {
            $("#cheque").show();
            $(".card-element").hide();
            $('input[name="cheque_no"]').attr('required', true);
        } else {
            $(".card-element").hide();
            $("#cheque").hide();
        }
    });

    $('input[name="paying_amount"]').on("input", function() {
        $(".change").text(formatRupiah( parseInt($(this).val().replaceAll('.', '') =='' ? 0 : $(this).val().replaceAll('.', '')) - parseInt($('input[name="amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="amount"]').val().replaceAll('.', '')) ));
    });

    $('input[name="amount"]').on("input", function() {
        
       
        if( parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', '')) > parseInt($('input[name="paying_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="paying_amount"]').val().replaceAll('.', '')) ) {
            alert('Paying amount cannot be bigger than recieved amount');
            $(this).val('');
        }
        else if( parseInt($(this).val().replaceAll('.', '')== '' ? 0 : $(this).val().replaceAll('.', '')) > parseInt($('input[name="balance"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="balance"]').val().replaceAll('.', '')) ) {
            alert('Paying amount cannot be bigger than due amount');
            $(this).val('');
        }
        $(".change").text(formatRupiah( parseInt($('input[name="paying_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="paying_amount"]').val().replaceAll('.', '')) - parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', ''))));
    });

    $('select[name="edit_paid_by_id"]').on("change", function() {        
        var id = $('select[name="edit_paid_by_id"]').val();
        $('input[name="edit_cheque_no"]').attr('required', false);
        $(".payment-form").off("submit");
        if (id == 3) {
            $(".edit-btn").attr('data-clicked', true);
            $.getScript( "public/vendor/stripe/checkout.js" );
            $(".card-element").show();
            $("#edit-cheque").hide();
        } else if (id == 4) {
            $("#edit-cheque").show();
            $(".card-element").hide();
            $('input[name="edit_cheque_no"]').attr('required', true);
        } else {
            $(".card-element").hide();
            $("#edit-cheque").hide();
        }
    });

    $('input[name="edit_amount"]').on("input", function() { 
        if( parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', '')) > parseInt($('input[name="edit_paying_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_paying_amount"]').val().replaceAll('.', '')) ) {
            alert('Paying amount cannot be bigger than recieved amount');
            $(this).val('');
        }
        $(".change").text(formatRupiah(parseInt($('input[name="edit_paying_amount"]').val().replaceAll('.', '') == '' ? 0 :  $('input[name="edit_paying_amount"]').val().replaceAll('.', '')) - parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', ''))));
    });

    $('input[name="edit_paying_amount"]').on("input", function() {
        $(".change").text(formatRupiah( parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', '')) - parseInt($('input[name="edit_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_amount"]').val().replaceAll('.', '')) ));
    });

    dataTable();

    function dataTable() {
        var starting_date = $("input[name=starting_date]").val(); 
        var ending_date = $("input[name=ending_date]").val();
        var warehouse_id = $("#warehouse_id").val();
        $('#purchase-table').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax":{
                url:"purchases/purchase-data",
                data:{
                    all_permission: all_permission,
                    starting_date: starting_date,
                    ending_date: ending_date,
                    warehouse_id: warehouse_id
                },
                dataType: "json",
                type:"post",
                /*success:function(data){
                    console.log(data);
                }*/
            },
            "createdRow": function( row, data, dataIndex ) {
                $(row).addClass('purchase-link');
                $(row).attr('data-purchase', data['purchase']);
            },
            "columns": [
                {"data": "key"},
                {"data": "date"},
                {"data": "reference_no"},
                {"data": "supplier"},
                {"data": "purchase_status"},
                {"data": "grand_total"},
                {"data": "paid_amount"},
                {"data": "due"},
                {"data": "payment_status"},
                {"data": "options"},
            ],
            'language': {
                /*'searchPlaceholder': "{{trans('file.Type date or purchase reference...')}}",*/
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
                    'targets': [0, 3, 4, 7, 8,9]
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
                },
                // {
                //     'targets': [5,6,7],
                //     render: $.fn.dataTable.render.number( '.', ',', 3, 'Rp' )
                // },
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
                {
                    extend: 'csv',
                    text: '{{trans("file.CSV")}}',
                    exportOptions: {
                        columns: ':visible:not(.not-exported)',
                        rows: ':visible'
                    },
                    action: function(e, dt, button, config) {
                        datatable_sum(dt, true);
                        $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
                        datatable_sum(dt, false);
                    },
                    footer:true
                },
                {
                    extend: 'print',
                    text: '{{trans("file.Print")}}',
                    exportOptions: {
                        columns: ':visible:not(.not-exported)',
                        rows: ':visible'
                    },
                    action: function(e, dt, button, config) {
                        datatable_sum(dt, true);
                        $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                        datatable_sum(dt, false);
                    },
                    footer:true
                },
                {
                    text: '{{trans("file.delete")}}',
                    className: 'buttons-delete',
                    action: function ( e, dt, node, config ) {
                        if(user_verified == '1') {
                            purchase_id.length = 0;
                            $(':checkbox:checked').each(function(i){
                                if(i){
                                    var purchase = $(this).closest('tr').data('purchase');
                                    purchase_id[i-1] = purchase[3];
                                }
                            });
                            if(purchase_id.length && confirm("Are you sure want to delete?")) {
                                $.ajax({
                                    type:'POST',
                                    url:'purchases/deletebyselection',
                                    data:{
                                        purchaseIdArray: purchase_id
                                    },
                                    success:function(data) {
                                        alert(data);
                                        //dt.rows({ page: 'current', selected: true }).deselect();
                                        dt.rows({ page: 'current', selected: true }).remove().draw(false);
                                    }
                                });
                            }
                            else if(!purchase_id.length)
                                alert('Nothing is selected!');
                        }
                        else
                            alert('This feature is disable for demo!');
                    }
                },
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
        
    }

    function datatable_sum(dt_selector, is_calling_first) {
        if (dt_selector.rows( '.selected' ).any() && is_calling_first) {
            var rows = dt_selector.rows( '.selected' ).indexes();

            $( dt_selector.column( 5 ).footer() ).html(this.formatRupiah(dt_selector.cells( rows, 5, { page: 'current' } ).data().sum(),''));
            $( dt_selector.column( 6 ).footer() ).html(this.formatRupiah(dt_selector.cells( rows, 6, { page: 'current' } ).data().sum(),''));
            $( dt_selector.column( 7 ).footer() ).html(this.formatRupiah(dt_selector.cells( rows, 7, { page: 'current' } ).data().sum(),''));
        }
        else {
            $( dt_selector.column( 5 ).footer() ).html(this.formatRupiah(dt_selector.column( 5, {page:'current'} ).data().sum(),''));
            $( dt_selector.column( 6 ).footer() ).html(this.formatRupiah(dt_selector.column( 6, {page:'current'} ).data().sum(),''));
            $( dt_selector.column( 7 ).footer() ).html(this.formatRupiah(dt_selector.column( 7, {page:'current'} ).data().sum(),''));
        }
    }

    function purchaseDetails(purchase){
        var htmltext = '<strong>{{trans("file.Date")}}: </strong>'+purchase[0]+'<br><strong>{{trans("file.reference")}}: </strong>'+purchase[1]+'<br><strong>{{trans("file.Purchase Status")}}: </strong>'+purchase[2]+'<br><br><div class="row"><div class="col-md-6"><strong>{{trans("file.From")}}:</strong><br>'+purchase[4]+'<br>'+purchase[5]+'<br>'+purchase[6]+'</div><div class="col-md-6"><div class="float-right"><strong>{{trans("file.To")}}:</strong><br>'+purchase[7]+'<br>'+purchase[8]+'<br>'+purchase[9]+'<br>'+purchase[10]+'<br>'+purchase[11]+'<br>'+purchase[12]+'</div></div></div>';

        $.get('purchases/product_purchase/' + purchase[3], function(data){
            $(".product-purchase-list tbody").remove();
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
                cols += '<td>' + formatRupiah((subtotal[index] / qty[index]), '') + '</td>';
                cols += '<td>' + formatRupiah(tax[index], '') + '(' + tax_rate[index] + '%)' + '</td>';
                cols += '<td>' + formatRupiah(discount[index], '') + '</td>';
                cols += '<td>' + formatRupiah(subtotal[index], '') + '</td>';
                newRow.append(cols);
                newBody.append(newRow);
            });

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=4><strong>{{trans("file.Total")}}:</strong></td>';
            cols += '<td>' + formatRupiah(purchase[13]) + '</td>';
            cols += '<td>' + formatRupiah(purchase[14]) + '</td>';
            cols += '<td>' + formatRupiah(purchase[15]) + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong>{{trans("file.Order Tax")}}:</strong></td>';
            cols += '<td>' + formatRupiah(purchase[16]) + '(' + purchase[17] + '%)' + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong>{{trans("file.Order Discount")}}:</strong></td>';
            cols += '<td>' + formatRupiah(purchase[18]) + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong>{{trans("file.Shipping Cost")}}:</strong></td>';
            cols += '<td>' + formatRupiah(purchase[19]) + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong>{{trans("file.grand total")}}:</strong></td>';
            cols += '<td>' + formatRupiah(purchase[20]) + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong>{{trans("file.Paid Amount")}}:</strong></td>';
            cols += '<td>' + formatRupiah(purchase[21]) + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong>{{trans("file.Due")}}:</strong></td>';
            cols += '<td>' + formatRupiah((purchase[20] - purchase[21])) + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

             $("table.product-purchase-list").append(newBody);
        });

        var htmlfooter = '<p><strong>{{trans("file.Note")}}:</strong> '+purchase[22]+'</p><strong>{{trans("file.Created By")}}:</strong><br>'+purchase[23]+'<br>'+purchase[24];

        $('#purchase-content').html(htmltext);
        $('#purchase-footer').html(htmlfooter);
        $('#purchase-details').modal('show');
    }

    $(document).on('submit', '.payment-form', function(e) {
        
        if( parseInt($('input[name="paying_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="paying_amount"]').val().replaceAll('.', '')) < parseInt($('#amount').val().replaceAll('.', '') = '' ? 0 : $('#amount').val().replaceAll('.', ''))  ) {
            alert('Paying amount cannot be bigger than recieved amount');
            $('input[name="amount"]').val('');
            $(".change").text(formatRupiah( parseInt($('input[name="paying_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="paying_amount"]').val().replaceAll('.', '') ) - parseInt($('#amount').val().replaceAll('.', '') == '' ? 0 : $('#amount').val().replaceAll('.', '')) ));
            e.preventDefault();
        }
        else if( parseInt($('input[name="edit_paying_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_paying_amount"]').val().replaceAll('.', '')) < parseInt($('input[name="edit_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_amount"]').val().replaceAll('.', '')) ) {
            alert('Paying amount cannot be bigger than recieved amount');
            $('input[name="edit_amount"]').val('');
            $(".change").text(formatRupiah( parseInt($('input[name="edit_paying_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_paying_amount"]').val().replaceAll('.', '')) - parseInt($('input[name="edit_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_amount"]').val().replaceAll('.', '')) ));
            e.preventDefault();
        }
            
        $('#edit-payment select[name="edit_paid_by_id"]').prop('disabled', false);
    });

    if(all_permission.indexOf("purchases-delete") == -1)
        $('.buttons-delete').addClass('d-none');

        
    
    var idpaying_amount = document.getElementById('idpaying_amount');
    idpaying_amount.addEventListener('keyup', function(e){
        idpaying_amount.value = formatRupiah(this.value, 'input');
    });
    idpaying_amount.addEventListener('mouseover', function(e){
        idpaying_amount.value = formatRupiah(this.value, 'input');
    });

    var amount = document.getElementById('amount');
    amount.addEventListener('keyup', function(e){
        amount.value = formatRupiah(this.value, 'input');
    });
    amount.addEventListener('mouseover', function(e){
        amount.value = formatRupiah(this.value, 'input');
    });

    var idedit_paying_amount = document.getElementById('idedit_paying_amount');
    idedit_paying_amount.addEventListener('keyup', function(e){
        idedit_paying_amount.value = formatRupiah(this.value, 'input');
    });
    idedit_paying_amount.addEventListener('mouseover', function(e){
        idedit_paying_amount.value = formatRupiah(this.value, 'input');
    });

    var idedit_amount = document.getElementById('idedit_amount');
    idedit_amount.addEventListener('keyup', function(e){
        idedit_amount.value = formatRupiah(this.value, 'input');
    });
    idedit_amount.addEventListener('mouseover', function(e){
        idedit_amount.value = formatRupiah(this.value, 'input');
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
            return ('' + rupiah);
	}

    
</script>
@endsection @section('scripts')
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>

@endsection