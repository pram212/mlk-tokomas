@extends('layout.main') @section('content')
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Add Sale')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => 'sales.store', 'method' => 'post', 'files' => true, 'class' => 'payment-form']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                {{trans('file.Reference No')}}
                                            </label>
                                            <input type="text" name="reference_no" class="form-control" />
                                        </div>
                                        @if($errors->has('reference_no'))
                                       <span>
                                           <strong>{{ $errors->first('reference_no') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.customer')}} *</label>
                                            <select required name="customer_id" id="customer_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select customer...">
                                                <?php $deposit = []; ?>
                                                @foreach($lims_customer_list as $customer)
                                                <?php $deposit[$customer->id] = $customer->deposit - $customer->expense; ?>
                                                <option value="{{$customer->id}}">{{$customer->name . ' (' . $customer->phone_number . ')'}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Warehouse')}} *</label>
                                            <select required name="warehouse_id" id="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                                                @foreach($lims_warehouse_list as $warehouse)
                                                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Biller')}} *</label>
                                            <select required name="biller_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Biller...">
                                                @foreach($lims_biller_list as $biller)
                                                <option value="{{$biller->id}}">{{$biller->name . ' (' . $biller->company_name . ')'}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label>{{trans('file.Select Product')}}</label>
                                        <div class="search-box input-group">
                                            <button type="button" class="btn btn-secondary btn-lg"><i class="fa fa-barcode"></i></button>
                                            <input type="text" name="product_code_name" id="lims_productcodeSearch" placeholder="Please type product code and select..." class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-12">
                                        <h5>{{trans('file.Order Table')}} *</h5>
                                        <div class="table-responsive mt-3">
                                            <table id="myTable" class="table table-hover order-list">
                                                <thead>
                                                    <tr>
                                                        <th>{{trans('file.name')}}</th>
                                                        <th>{{trans('file.Code')}}</th>
                                                        <th>{{trans('file.Quantity')}}</th>
                                                        <th>{{trans('file.Net Unit Price')}}</th>
                                                        <th>{{trans('file.Discount')}}</th>
                                                        <th>{{trans('file.Tax')}}</th>
                                                        <th>{{trans('file.Subtotal')}}</th>
                                                        <th><i class="dripicons-trash"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot class="tfoot active">
                                                    <th colspan="2">{{trans('file.Total')}}</th>
                                                    <th id="total-qty">0</th>
                                                    <th></th>
                                                    <th id="total-discount">0</th>
                                                    <th id="total-tax">0</th>
                                                    <th id="total">0</th>
                                                    <th><i class="dripicons-trash"></i></th>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_qty" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_discount" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_tax" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_price" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="item" />
                                            <input type="hidden" name="order_tax" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="grand_total" />
                                            <input type="hidden" name="pos" value="0" />
                                            <input type="hidden" name="coupon_active" value="0" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Order Tax')}}</label>
                                            <select class="form-control" name="order_tax_rate">
                                                <option value="0">No Tax</option>
                                                @foreach($lims_tax_list as $tax)
                                                <option value="{{$tax->rate}}">{{$tax->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <strong>{{trans('file.Order Discount')}}</strong>
                                            </label>
                                            <input type="text" id="order_discountid" name="order_discount" class="form-control" step="any"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <strong>{{trans('file.Shipping Cost')}}</strong>
                                            </label>
                                            <input type="text" id="shipping_costid" name="shipping_cost" class="form-control" step="any"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Attach Document')}}</label> <i class="dripicons-question" data-toggle="tooltip" title="Only jpg, jpeg, png, gif, pdf, csv, docx, xlsx and txt file is supported"></i>
                                            <input type="file" name="document" class="form-control" />
                                            @if($errors->has('extension'))
                                                <span>
                                                   <strong>{{ $errors->first('extension') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Sale Status')}} *</label>
                                            <select name="sale_status" class="form-control">
                                                <option value="1">{{trans('file.Completed')}}</option>
                                                <option value="2">{{trans('file.Pending')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Payment Status')}} *</label>
                                            <select name="payment_status" class="form-control">
                                                <option value="1">{{trans('file.Pending')}}</option>
                                                <option value="2">{{trans('file.Due')}}</option>
                                                <option value="3">{{trans('file.Partial')}}</option>
                                                <option value="4">{{trans('file.Paid')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="payment">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{trans('file.Paid By')}}</label>
                                                <select name="paid_by_id" class="form-control">
                                                    <option value="1">Cash</option>
                                                    <option value="2">Gift Card</option>
                                                    <option value="3">Credit Card</option>
                                                    <option value="4">Cheque</option>
                                                    <option value="5">Paypal</option>
                                                    <option value="6">Deposit</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{trans('file.Recieved Amount')}} *</label>
                                                <input type="number"  name="paying_amount" class="form-control" id="paying-amount" step="any" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{trans('file.Paying Amount')}} *</label>
                                                <input type="number"   name="paid_amount" class="form-control" id="paid-amount" step="any" readonly/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{trans('file.Change')}}</label>
                                                <p id="change" class="ml-2">0</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="card-element" class="form-control">
                                                </div>
                                                <div class="card-errors" role="alert"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="gift-card">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> {{trans('file.Gift Card')}} *</label>
                                                <select id="gift_card_id" name="gift_card_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Gift Card..."></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="cheque">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{trans('file.Cheque Number')}} *</label>
                                                <input type="text" name="cheque_no" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>{{trans('file.Payment Note')}}</label>
                                            <textarea rows="3" class="form-control" name="payment_note"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Sale Note')}}</label>
                                            <textarea rows="5" class="form-control" name="sale_note"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Staff Note')}}</label>
                                            <textarea rows="5" class="form-control" name="staff_note"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary" id="submit-button">
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <table class="table table-bordered table-condensed totals">
            <td><strong>{{trans('file.Items')}}</strong>
                <span class="pull-right" id="item">0</span>
            </td>
            <td><strong>{{trans('file.Total')}}</strong>
                <span class="pull-right" id="subtotal">0</span>
            </td>
            <td><strong>{{trans('file.Order Tax')}}</strong>
                <span class="pull-right" id="order_tax">0</span>
            </td>
            <td><strong>{{trans('file.Order Discount')}}</strong>
                <span class="pull-right" id="order_discount">0</span>
            </td>
            <td><strong>{{trans('file.Shipping Cost')}}</strong>
                <span class="pull-right" id="shipping_cost">0</span>
            </td>
            <td><strong>{{trans('file.grand total')}}</strong>
                <span class="pull-right" id="grand_total">0</span>
            </td>
        </table>
    </div>
    <div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modal_header" class="modal-title"></h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>{{trans('file.Quantity')}}</label>
                            <input type="number" name="edit_qty" class="form-control" step="any">
                        </div>
                        <div class="form-group">
                            <label>{{trans('file.Unit Discount')}}</label>
                            <input type="text" id="edit_discountid" name="edit_discount" class="form-control" step="any">
                        </div>
                        <div class="form-group">
                            <label>{{trans('file.Unit Price')}}</label>
                            <input type="text" id="edit_unit_priceid" name="edit_unit_price" class="form-control" step="any">
                        </div>
                        <?php
                $tax_name_all[] = 'No Tax';
                $tax_rate_all[] = 0;
                foreach($lims_tax_list as $tax) {
                    $tax_name_all[] = $tax->name;
                    $tax_rate_all[] = $tax->rate;
                }
            ?>
                            <div class="form-group">
                                <label>{{trans('file.Tax Rate')}}</label>
                                <select name="edit_tax_rate" class="form-control selectpicker">
                                    @foreach($tax_name_all as $key => $name)
                                    <option value="{{$key}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="edit_unit" class="form-group">
                                <label>{{trans('file.Product Unit')}}</label>
                                <select name="edit_unit" class="form-control selectpicker">
                                </select>
                            </div>
                            <button type="button" name="update_btn" class="btn btn-primary">{{trans('file.update')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- add cash register modal -->
    <div id="cash-register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            {!! Form::open(['route' => 'cashRegister.store', 'method' => 'post']) !!}
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Cash Register')}}</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                <div class="row">
                  <div class="col-md-6 form-group warehouse-section">
                      <label>{{trans('file.Warehouse')}} *</strong> </label>
                      <select required name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                          @foreach($lims_warehouse_list as $warehouse)
                          <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-6 form-group">
                      <label>{{trans('file.Cash in Hand')}} *</strong> </label>
                      <input type="text" id="cash_in_handid" name="cash_in_hand" required class="form-control">
                  </div>
                  <div class="col-md-12 form-group">
                      <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                  </div>
                </div>
            </div>
            {{ Form::close() }}
          </div>
        </div>
    </div>
</section>
<script type="text/javascript">

    $("ul#sale").siblings('a').attr('aria-expanded','true');
    $("ul#sale").addClass("show");
    $("ul#sale #sale-create-menu").addClass("active");

    var public_key = <?php echo json_encode($lims_pos_setting_data->stripe_public_key) ?>;
    var currency = <?php echo json_encode($currency) ?>;

$("#payment").hide();
$(".card-element").hide();
$("#gift-card").hide();
$("#cheque").hide();

// array data depend on warehouse
var lims_product_array = [];
var product_code = [];
var product_name = [];
var product_qty = [];
var product_type = [];
var product_id = [];
var product_list = [];
var qty_list = [];

// array data with selection
var product_price = [];
var product_discount = [];
var tax_rate = [];
var tax_name = [];
var tax_method = [];
var unit_name = [];
var unit_operator = [];
var unit_operation_value = [];
var gift_card_amount = [];
var gift_card_expense = [];
// temporary array
var temp_unit_name = [];
var temp_unit_operator = [];
var temp_unit_operation_value = [];

var deposit = <?php echo json_encode($deposit) ?>;
var rowindex;
var customer_group_rate;
var row_product_price;
var pos;
var role_id = <?php echo json_encode(Auth::user()->role_id)?>;

$('.selectpicker').selectpicker({
    style: 'btn-link',
});

$('[data-toggle="tooltip"]').tooltip();

$('select[name="customer_id"]').on('change', function() {
    var id = $(this).val();
    $.get('/getcustomergroup/' + id, function(data) {
        customer_group_rate = (data / 100);
    });
});

$('select[name="warehouse_id"]').on('change', function() {
    var id = $(this).val();
    $.get('/getproduct/' + id, function(data) {
        lims_product_array = [];
        product_code = data[0];
        product_name = data[1];
        product_qty = data[2];
        product_type = data[3];
        product_id = data[4];
        product_list = data[5];
        qty_list = data[6];
        product_warehouse_price = data[7];
        $.each(product_code, function(index) {
            lims_product_array.push(product_code[index] + ' (' + product_name[index] + ')');
        });
    });
    isCashRegisterAvailable(id);
});

$('#lims_productcodeSearch').on('input', function(){
    var customer_id = $('#customer_id').val();
    var warehouse_id = $('#warehouse_id').val();
    temp_data = $('#lims_productcodeSearch').val();
    if(!customer_id){
        $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
        alert('Please select Customer!');
    }
    else if(!warehouse_id){
        $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
        alert('Please select Warehouse!');
    }

});

var lims_productcodeSearch = $('#lims_productcodeSearch');

lims_productcodeSearch.autocomplete({
    source: function(request, response) {
        var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
        response($.grep(lims_product_array, function(item) {
            return matcher.test(item);
        }));
    },
    response: function(event, ui) {
        if (ui.content.length == 1) {
            var data = ui.content[0].value;
            $(this).autocomplete( "close" );
            productSearch(data);
        };
    },
    select: function(event, ui) {
        var data = ui.item.value;
        productSearch(data);
    }
});

//Change quantity
$("#myTable").on('input', '.qty', function() {
    rowindex = $(this).closest('tr').index();
    if($(this).val() < 0 && $(this).val() != '') {
      $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(1);
      alert("Quantity can't be less than 0");
    }
    checkQuantity($(this).val(), true);
});


//Delete product
$("table.order-list tbody").on("click", ".ibtnDel", function(event) {
    rowindex = $(this).closest('tr').index();
    product_price.splice(rowindex, 1);
    product_discount.splice(rowindex, 1);
    tax_rate.splice(rowindex, 1);
    tax_name.splice(rowindex, 1);
    tax_method.splice(rowindex, 1);
    unit_name.splice(rowindex, 1);
    unit_operator.splice(rowindex, 1);
    unit_operation_value.splice(rowindex, 1);
    $(this).closest("tr").remove();
    calculateTotal();
});

//Edit product
$("table.order-list").on("click", ".edit-product", function() {
    rowindex = $(this).closest('tr').index();
    edit();
});

//Update product
$('button[name="update_btn"]').on("click", function() {
    var edit_discount = parseInt($('input[name="edit_discount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_discount"]').val().replaceAll('.', '') );
    var edit_qty = $('input[name="edit_qty"]').val();
    var edit_unit_price = parseInt($('input[name="edit_unit_price"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_unit_price"]').val().replaceAll('.', '') ); 

    if (parseInt(edit_discount) > parseInt(edit_unit_price)) {
        alert('Invalid Discount Input!');
        return;
    }

    if(edit_qty < 1) {
        $('input[name="edit_qty"]').val(1);
        edit_qty = 1;
        alert("Quantity can't be less than 1");
    }

    var tax_rate_all = <?php echo json_encode($tax_rate_all) ?>;
    tax_rate[rowindex] = parseInt(tax_rate_all[$('select[name="edit_tax_rate"]').val()]);
    tax_name[rowindex] = $('select[name="edit_tax_rate"] option:selected').text();
    if(product_type[pos] == 'standard'){
        var row_unit_operator = unit_operator[rowindex].slice(0, unit_operator[rowindex].indexOf(","));
        var row_unit_operation_value = unit_operation_value[rowindex].slice(0, unit_operation_value[rowindex].indexOf(","));
        if (row_unit_operator == '*') {
            product_price[rowindex] = parseInt($('input[name="edit_unit_price"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_unit_price"]').val().replaceAll('.', '') ) / row_unit_operation_value;
        } else {
            product_price[rowindex] = parseInt($('input[name="edit_unit_price"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_unit_price"]').val().replaceAll('.', '') ) * row_unit_operation_value;
        }
        var position = $('select[name="edit_unit"]').val();
        var temp_operator = temp_unit_operator[position];
        var temp_operation_value = temp_unit_operation_value[position];
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.sale-unit').val(temp_unit_name[position]);
        temp_unit_name.splice(position, 1);
        temp_unit_operator.splice(position, 1);
        temp_unit_operation_value.splice(position, 1);

        temp_unit_name.unshift($('select[name="edit_unit"] option:selected').text());
        temp_unit_operator.unshift(temp_operator);
        temp_unit_operation_value.unshift(temp_operation_value);

        unit_name[rowindex] = temp_unit_name.toString() + ',';
        unit_operator[rowindex] = temp_unit_operator.toString() + ',';
        unit_operation_value[rowindex] = temp_unit_operation_value.toString() + ',';
    }
    else {
        product_price[rowindex] = parseInt($('input[name="edit_unit_price"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_unit_price"]').val().replaceAll('.', ''));
    }
    product_discount[rowindex] = parseInt($('input[name="edit_discount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_discount"]').val().replaceAll('.', '') );
    checkQuantity(edit_qty, false);
});

function isCashRegisterAvailable(warehouse_id) {
    $.ajax({
        url: '../cash-register/check-availability/'+warehouse_id,
        type: "GET",
        success:function(data) {
            if(data == 'false') {
                $('#cash-register-modal select[name=warehouse_id]').val(warehouse_id);
                $('.selectpicker').selectpicker('refresh');
                if(role_id <= 2){
                    $("#cash-register-modal .warehouse-section").removeClass('d-none');
                }
                else {
                    $("#cash-register-modal .warehouse-section").addClass('d-none');
                }
                $("#cash-register-modal").modal('show');
            }
        }
    });
}

function productSearch(data) {
    $.ajax({
        type: 'GET',
        url: 'lims_product_search',
        data: {
            data: data
        },
        success: function(data) {
            var flag = 1;
            $(".product-code").each(function(i) {
                if ($(this).val() == data[1]) {
                    rowindex = i;
                    var qty = parseInt($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val()) + 1;
                    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);
                    checkQuantity(String(qty), true);
                    flag = 0;
                }
            });
            $("input[name='product_code_name']").val('');
            if(flag){
                var newRow = $("<tr>");
                var cols = '';
                temp_unit_name = (data[6]).split(',');
                cols += '<td>' + data[0] + '<button type="button" class="edit-product btn btn-link" data-toggle="modal" data-target="#editModal"> <i class="dripicons-document-edit"></i></button></td>';
                cols += '<td>' + data[1] + '</td>';
                cols += '<td><input type="number" class="form-control qty" name="qty[]" value="1" step="any" required/></td>';
                cols += '<td class="net_unit_price"></td>';
                cols += '<td class="discount">0</td>';
                cols += '<td class="tax"></td>';
                cols += '<td class="sub-total"></td>';
                cols += '<td><button type="button" class="ibtnDel btn btn-md btn-danger">{{trans("file.delete")}}</button></td>';
                cols += '<input type="hidden" class="product-code" name="product_code[]" value="' + data[1] + '"/>';
                cols += '<input type="hidden" class="product-id" name="product_id[]" value="' + data[9] + '"/>';
                cols += '<input type="hidden" class="sale-unit" name="sale_unit[]" value="' + temp_unit_name[0] + '"/>';
                cols += '<input type="hidden" class="net_unit_price" name="net_unit_price[]" />';
                cols += '<input type="hidden" class="discount-value" name="discount[]" />';
                cols += '<input type="hidden" class="tax-rate" name="tax_rate[]" value="' + data[3] + '"/>';
                cols += '<input type="hidden" class="tax-value" name="tax[]" />';
                cols += '<input type="hidden" class="subtotal-value" name="subtotal[]" />';

                newRow.append(cols);
                $("table.order-list tbody").prepend(newRow);
                rowindex = newRow.index();

                pos = product_code.indexOf(data[1]);
                if(!data[11] && product_warehouse_price[pos]) {
                    product_price.splice(rowindex, 0, parseInt(product_warehouse_price[pos] * currency['exchange_rate']) + parseInt(product_warehouse_price[pos] * currency['exchange_rate'] * customer_group_rate));
                }
                else {
                    product_price.splice(rowindex, 0, parseInt(data[2] * currency['exchange_rate']) + parseInt(data[2] * currency['exchange_rate'] * customer_group_rate));
                }
                product_discount.splice(rowindex, 0, '0');
                tax_rate.splice(rowindex, 0, parseInt(data[3]));
                tax_name.splice(rowindex, 0, data[4]);
                tax_method.splice(rowindex, 0, data[5]);
                unit_name.splice(rowindex, 0, data[6]);
                unit_operator.splice(rowindex, 0, data[7]);
                unit_operation_value.splice(rowindex, 0, data[8]);
                checkQuantity(1, true);
            }
        }
    });
}

function edit()
{
    var row_product_name = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(1)').text();
    var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text();
    $('#modal_header').text(row_product_name + '(' + row_product_code + ')');

    var qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val();
    $('input[name="edit_qty"]').val(qty);

    $('input[name="edit_discount"]').val(parseInt(product_discount[rowindex]));

    var tax_name_all = <?php echo json_encode($tax_name_all) ?>;
    pos = tax_name_all.indexOf(tax_name[rowindex]);
    $('select[name="edit_tax_rate"]').val(pos);

    pos = product_code.indexOf(row_product_code);
    if(product_type[pos] == 'standard'){
        unitConversion();
        temp_unit_name = (unit_name[rowindex]).split(',');
        temp_unit_name.pop();
        temp_unit_operator = (unit_operator[rowindex]).split(',');
        temp_unit_operator.pop();
        temp_unit_operation_value = (unit_operation_value[rowindex]).split(',');
        temp_unit_operation_value.pop();
        $('select[name="edit_unit"]').empty();
        $.each(temp_unit_name, function(key, value) {
            $('select[name="edit_unit"]').append('<option value="' + key + '">' + value + '</option>');
        });
        $("#edit_unit").show();
    }
    else{
        row_product_price = product_price[rowindex];
        $("#edit_unit").hide();
    }
    $('input[name="edit_unit_price"]').val(parseInt(row_product_price));
    $('.selectpicker').selectpicker('refresh');
}

function checkQuantity(sale_qty, flag) {
    var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text();
    pos = product_code.indexOf(row_product_code);
    if(product_type[pos] == 'standard'){
        var operator = unit_operator[rowindex].split(',');
        var operation_value = unit_operation_value[rowindex].split(',');
        if(operator[0] == '*')
            total_qty = sale_qty * operation_value[0];
        else if(operator[0] == '/')
            total_qty = sale_qty / operation_value[0];
        if (total_qty > parseInt(product_qty[pos])) {
            alert('Quantity exceeds stock quantity!');
            if (flag) {
                sale_qty = sale_qty.substring(0, sale_qty.length - 1);
                $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
            }
            else {
                edit();
                return;
            }
        }
    }
    else if(product_type[pos] == 'combo'){
        child_id = product_list[pos].split(',');
        child_qty = qty_list[pos].split(',');
        $(child_id).each(function(index) {
            var position = product_id.indexOf(parseInt(child_id[index]));
            if( parseInt(sale_qty * child_qty[index]) > product_qty[position] ) {
                alert('Quantity exceeds stock quantity!');
                if (flag) {
                    sale_qty = sale_qty.substring(0, sale_qty.length - 1);
                    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
                }
                else {
                    edit();
                    flag = true;
                    return false;
                }
            }
        });
    }

    if(!flag){
        $('#editModal').modal('hide');
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
    }
    calculateRowProductData(sale_qty);
}

function calculateRowProductData(quantity) {
    if(product_type[pos] == 'standard')
        unitConversion();
    else
        row_product_price = product_price[rowindex];

    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(5)').text((product_discount[rowindex] * quantity));
    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.discount-value').val((product_discount[rowindex] * quantity));
    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-rate').val(tax_rate[rowindex]);

    if (tax_method[rowindex] == 1) {
        var net_unit_price = parseInt(row_product_price) - parseInt(product_discount[rowindex]);
        var tax = net_unit_price * quantity * (tax_rate[rowindex] / 100);
        var sub_total = (net_unit_price * quantity) + tax;

        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(4)').text(formatRupiah(parseInt(net_unit_price)));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_price').val(parseInt(net_unit_price));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(6)').text(formatRupiah(parseInt(tax)));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-value').val(parseInt(tax));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(7)').text(formatRupiah(parseInt(sub_total)));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.subtotal-value').val(parseInt(sub_total));
    } else {
        var sub_total_unit = parseInt(row_product_price) - parseInt(product_discount[rowindex]);
        var net_unit_price = (100 / (100 + tax_rate[rowindex])) * sub_total_unit;
        var tax = (sub_total_unit - net_unit_price) * quantity;
        var sub_total = sub_total_unit * quantity;

        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(4)').text(formatRupiah(parseInt(net_unit_price)));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_price').val(parseInt(net_unit_price));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(6)').text(formatRupiah(parseInt(tax)));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-value').val(parseInt(tax));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(7)').text(formatRupiah(parseInt(sub_total)));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.subtotal-value').val(parseInt(sub_total));
    }

    calculateTotal();
}

function unitConversion() {
    var row_unit_operator = unit_operator[rowindex].slice(0, unit_operator[rowindex].indexOf(","));
    var row_unit_operation_value = unit_operation_value[rowindex].slice(0, unit_operation_value[rowindex].indexOf(","));

    if (row_unit_operator == '*') {
        row_product_price = parseInt(product_price[rowindex]) * row_unit_operation_value;
    } else {
        row_product_price = parseInt(product_price[rowindex]) / row_unit_operation_value;
    }
}

function calculateTotal() {
    //Sum of quantity
    var total_qty = 0;
    $(".qty").each(function() {

        if ($(this).val() == '') {
            total_qty += 0;
        } else {
            total_qty += parseInt($(this).val());
        }
    });
    $("#total-qty").text(total_qty);
    $('input[name="total_qty"]').val(total_qty);

    //Sum of discount
    var total_discount = 0;
    $(".discount").each(function() {
        total_discount += parseInt( $(this).text().replaceAll('.', '') == '' ? 0 : $(this).text().replaceAll('.', '') );
    });
    $("#total-discount").text(formatRupiah(total_discount));
    $('input[name="total_discount"]').val(parseInt(total_discount));

    //Sum of tax
    var total_tax = 0;
    $(".tax").each(function() {
        total_tax += parseInt($(this).text().replaceAll('.', '') == '' ? 0 : $(this).text().replaceAll('.', '') );
    });
    $("#total-tax").text(formatRupiah(total_tax));
    $('input[name="total_tax"]').val(parseInt(total_tax));

    //Sum of subtotal
    var total = 0;
    $(".sub-total").each(function() {
        total += parseInt($(this).text().replaceAll('.', '') == '' ? 0 : $(this).text().replaceAll('.', '') );
    });
    $("#total").text(formatRupiah(parseInt(total)));
    $('input[name="total_price"]').val(parseInt(total));

    calculateGrandTotal();
}

function calculateGrandTotal() {

    var item = $('table.order-list tbody tr:last').index();

    var total_qty = parseInt($('#total-qty').text());
    var subtotal = parseInt($('#total').text().replaceAll('.', '') == '' ? 0 : $('#total').text().replaceAll('.', ''));
    var order_tax = parseInt($('select[name="order_tax_rate"]').val().replaceAll('.', '') == '' ? 0 :$('select[name="order_tax_rate"]').val().replaceAll('.', ''));
    var order_discount = parseInt($('input[name="order_discount"]').val().replaceAll('.', '') == '' ? 0 :$('input[name="order_discount"]').val().replaceAll('.', ''));
    var shipping_cost = parseInt($('input[name="shipping_cost"]').val().replaceAll('.', '') == '' ? 0 :$('input[name="shipping_cost"]').val().replaceAll('.', ''));

    if (!order_discount)
        order_discount = 0;
    if (!shipping_cost)
        shipping_cost = 0;

    item = ++item + '(' + total_qty + ')';
    order_tax = (subtotal - order_discount) * (order_tax / 100);
    var grand_total = (subtotal + order_tax + shipping_cost) - order_discount;

    $('#item').text(item);
    $('input[name="item"]').val($('table.order-list tbody tr:last').index() + 1);

    $('#subtotal').text(formatRupiah(parseInt(subtotal)));
    $('#order_tax').text(formatRupiah(parseInt(order_tax)));
    $('input[name="order_tax"]').val(formatRupiah(parseInt(order_tax)));
    $('#order_discount').text(formatRupiah(parseInt(order_discount)));
    $('#shipping_cost').text(formatRupiah(parseInt(shipping_cost)));
    $('#grand_total').text(formatRupiah(parseInt(grand_total)));

    if( $('select[name="payment_status"]').val() == 4 ){
        $('#paying-amount').val('');
        $('#paid-amount').val(formatRupiah(parseInt(grand_total)));
    }
    $('input[name="grand_total"]').val(formatRupiah(parseInt(grand_total)));
}

$('input[name="order_discount"]').on("input", function() {
    calculateGrandTotal();
});

$('input[name="shipping_cost"]').on("input", function() {
    calculateGrandTotal();
});

$('select[name="order_tax_rate"]').on("change", function() {
    calculateGrandTotal();
});

$('select[name="payment_status"]').on("change", function() {
    var payment_status = $(this).val();
    if (payment_status == 3 || payment_status == 4) {
        $("#paid-amount").prop('disabled',false);
        $("#payment").show();
        $("#paying-amount").prop('required',true);
        $("#paid-amount").prop('required',true);
        if(payment_status == 4){
            $("#paid-amount").prop('disabled',true);
            $('input[name="paying_amount"]').val(parseInt($('input[name="grand_total"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="grand_total"]').val().replaceAll('.', '') ));
            $('input[name="paid_amount"]').val(parseInt($('input[name="grand_total"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="grand_total"]').val().replaceAll('.', '') ));
        }
    }
    else{
        $("#paying-amount").prop('required',false);
        $("#paid-amount").prop('required',false);
        $('input[name="paying_amount"]').val('');
        $('input[name="paid_amount"]').val('');
        $("#payment").hide();
    }
});

$('select[name="paid_by_id"]').on("change", function() {
    var id = $(this).val();
    $(".payment-form").off("submit");
    $('input[name="cheque_no"]').attr('required', false);
    $('select[name="gift_card_id"]').attr('required', false);
    if(id == 2) {
        $("#gift-card").show();
        $.ajax({
            url: 'get_gift_card',
            type: "GET",
            dataType: "json",
            success:function(data) {
                $('select[name="gift_card_id"]').empty();
                $.each(data, function(index) {
                    gift_card_amount[data[index]['id']] = data[index]['amount'];
                    gift_card_expense[data[index]['id']] = data[index]['expense'];
                    $('select[name="gift_card_id"]').append('<option value="'+ data[index]['id'] +'">'+ data[index]['card_no'] +'</option>');
                });
                $('.selectpicker').selectpicker('refresh');
            }
        });
        $(".card-element").hide();
        $("#cheque").hide();
        $('select[name="gift_card_id"]').attr('required', true);
    }
    else if (id == 3) {
        $.getScript( "..//vendor/stripe/checkout.js" );
        $(".card-element").show();
        $("#gift-card").hide();
        $("#cheque").hide();
    } 
    else if (id == 4) {
        $("#cheque").show();
        $("#gift-card").hide();
        $(".card-element").hide();
        $('input[name="cheque_no"]').attr('required', true);
    } 
    else {
        $("#gift-card").hide();
        $(".card-element").hide();
        $("#cheque").hide();
        if (id == 6){
            if(parseInt($('input[name="paid_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="paid_amount"]').val().replaceAll('.', '')) > deposit[$('#customer_id').val()]){
                alert('Amount exceeds customer deposit! Customer deposit : '+ deposit[$('#customer_id').val()]);
            }
        }
    }
});

$('select[name="gift_card_id"]').on("change", function() {
    var balance = gift_card_amount[$(this).val()] - gift_card_expense[$(this).val()];
    // perlu kah ?
    if(parseInt($('input[name="paid_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="paid_amount"]').val().replaceAll('.', '')) > balance){
        alert('Amount exceeds card balance! Gift Card balance: '+ balance);
    }
});

$('input[name="paid_amount"]').on("input", function() {
    if( parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', '') ) > parseInt($('input[name="paying_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="paying_amount"]').val().replaceAll('.', '')) ) {
        alert('Paying amount cannot be bigger than recieved amount');
        $(this).val('');
    }
    else if( parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', '')) > parseInt($('#grand_total').text().replaceAll('.', '') == '' ? 0 : $('#grand_total').text().replaceAll('.', '') ) ){
        alert('Paying amount cannot be bigger than grand total');
        $(this).val('');
    }

    $("#change").text( formatRupiah( parseInt(($("#paying-amount").val().replaceAll('.', '') == '' ? 0 : $("#paying-amount").val().replaceAll('.', '')) - ($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', '') )) ));
    var id = $('select[name="paid_by_id"]').val();
    
    if(id == 2){
      
        var balance = gift_card_amount[$("#gift_card_id").val()] - gift_card_expense[$("#gift_card_id").val()];
        if(parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', '')) > balance)
            alert('Amount exceeds card balance! Gift Card balance: '+ balance);
    }
    else if(id == 6){
        if( parseInt($('input[name="paid_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="paid_amount"]').val().replaceAll('.', '')  ) > deposit[$('#customer_id').val()] )
            alert('Amount exceeds customer deposit! Customer deposit : '+ deposit[$('#customer_id').val()]);
    }
});

$('input[name="paying_amount"]').on("input", function() {
    $("#change").text( formatRupiah(parseInt( ($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', '')) - ($("#paid-amount").val().replaceAll('.', '') == '' ? 0 : $("#paid-amount").val().replaceAll('.', '')) )));
});

$(window).keydown(function(e){
    if (e.which == 13) {
        var $targ = $(e.target);
        if (!$targ.is("textarea") && !$targ.is(":button,:submit")) {
            var focusNext = false;
            $(this).find(":input:visible:not([disabled],[readonly]), a").each(function(){
                if (this === e.target) {
                    focusNext = true;
                }
                else if (focusNext){
                    $(this).focus();
                    return false;
                }
            });
            return false;
        }
    }
});

$(document).on('submit', '.payment-form', function(e) {
    var rownumber = $('table.order-list tbody tr:last').index();
    if ( rownumber < 0 ) {
        alert("Please insert product to order table!")
        e.preventDefault();
    }
    else if( parseInt( $("#paying-amount").val().replaceAll('.', '') == '' ? 0 : $("#paying-amount").val().replaceAll('.', '') ) < parseInt($("#paid-amount").val().replaceAll('.', '') == '' ? 0 : $("#paid-amount").val().replaceAll('.', '') ) ){
        alert('Paying amount cannot be bigger than recieved amount');
        e.preventDefault();
    }
    else if( $('select[name="payment_status"]').val() == 3 && parseInt($("#paid-amount").val().replaceAll('.', '') == '' ? 0 : $("#paid-amount").val().replaceAll('.', '')) == parseInt($('input[name="grand_total"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="grand_total"]').val().replaceAll('.', '')) ) {
        alert('Paying amount equals to grand total! Please change payment status.');
        e.preventDefault();
    }
    else
        $("#paid-amount").prop('disabled',false);
});

$("ul#sale").siblings('a').attr('aria-expanded','true');
$("ul#sale").addClass("show");
$("ul#sale li").eq(2).addClass("active");

    var edit_discountid = document.getElementById('edit_discountid');
    edit_discountid.addEventListener('keyup', function(e){
        edit_discountid.value = formatRupiah(this.value, 'input');
    });
    edit_discountid.addEventListener('mouseover', function(e){
        edit_discountid.value = formatRupiah(this.value, 'input');
    }); 
    var edit_unit_priceid = document.getElementById('edit_unit_priceid');
    edit_unit_priceid.addEventListener('keyup', function(e){
        edit_unit_priceid.value = formatRupiah(this.value, 'input');
    });
    edit_unit_priceid.addEventListener('mouseover', function(e){
        edit_unit_priceid.value = formatRupiah(this.value, 'input');
    }); 

    var order_discountid = document.getElementById('order_discountid');
    order_discountid.addEventListener('keyup', function(e){
        order_discountid.value = formatRupiah(this.value, 'input');
    });
    order_discountid.addEventListener('mouseover', function(e){
        order_discountid.value = formatRupiah(this.value, 'input');
    }); 

    var shipping_costid = document.getElementById('shipping_costid');
    shipping_costid.addEventListener('keyup', function(e){
        shipping_costid.value = formatRupiah(this.value, 'input');
    });
    shipping_costid.addEventListener('mouseover', function(e){
        shipping_costid.value = formatRupiah(this.value, 'input');
    }); 

    var cash_in_handid = document.getElementById('cash_in_handid');
    cash_in_handid.addEventListener('keyup', function(e){
        cash_in_handid.value = formatRupiah(this.value, 'input');
    });
    cash_in_handid.addEventListener('mouseover', function(e){
        cash_in_handid.value = formatRupiah(this.value, 'input');
    }); 

    // var paying_amountid = document.getElementById('paying_amountid');
    // paying_amountid.addEventListener('keyup', function(e){
    //     paying_amountid.value = formatRupiah(this.value, 'input');
    // });
    // paying_amountid.addEventListener('mouseover', function(e){
    //     paying_amountid.value = formatRupiah(this.value, 'input');
    // }); 

    // var paid_amountid = document.getElementById('paid_amountid');
    // paid_amountid.addEventListener('keyup', function(e){
    //     paid_amountid.value = formatRupiah(this.value, 'input');
    // });
    // paid_amountid.addEventListener('mouseover', function(e){
    //     paid_amountid.value = formatRupiah(this.value, 'input');
    // }); 
     

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
@endsection @section('scripts')
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>

@endsection