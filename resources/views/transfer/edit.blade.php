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
                        <h4>{{trans('file.Update Transfer')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => ['transfers.update', $lims_transfer_data->id], 'method' => 'put', 'files' => true, 'id' => 'transfer-form']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.reference')}}</label>
                                            <p><strong>{{ $lims_transfer_data->reference_no }}</strong></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans("file.Status")}}</label>
                                            <input type="hidden" name="status_hidden" value="{{ $lims_transfer_data->status }}">
                                            <select name="status" class="form-control selectpicker">
                                                <option value="1">{{trans('file.Completed')}}</option>
                                                <option value="2">{{trans('file.Pending')}}</option>
                                                <option value="3">{{trans('file.Sent')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">  
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.From Warehouse')}} *</label>
                                            <input type="hidden" name="from_warehouse_id_hidden" value="{{ $lims_transfer_data->from_warehouse_id }}" />
                                            <select required name="from_warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                                                @foreach($lims_warehouse_list as $warehouse)
                                                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.To Warehouse')}} *</label>
                                            <input type="hidden" name="to_warehouse_id_hidden" value="{{ $lims_transfer_data->to_warehouse_id }}" />
                                            <select required name="to_warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                                                @foreach($lims_warehouse_list as $warehouse)
                                                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
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
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        
                                        <h5>{{trans('file.Order Table')}} *</h5>
                                        <div class="table-responsive mt-3">
                                            <table id="myTable" class="table table-hover order-list">
                                                <thead>
                                                    <tr>
                                                        <th>{{trans('file.name')}}</th>
                                                        <th>{{trans('file.Code')}}</th>
                                                        <th>{{trans('file.Quantity')}}</th>
                                                        <th>{{trans('file.Net Unit Cost')}}</th>
                                                        <th>{{trans('file.Tax')}}</th>
                                                        <th>{{trans('file.Subtotal')}}</th>
                                                        <th><i class="dripicons-trash"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $temp_unit_name = [];
                                                    $temp_unit_operator = [];
                                                    $temp_unit_operation_value = [];
                                                    ?>
                                                    @foreach($lims_product_transfer_data as $product_transfer)
                                                    <tr>
                                                    <?php 
                                                        $product_data = DB::table('products')->find($product_transfer->product_id);

                                                        if($product_transfer->variant_id) {
                                                            $product_variant_data = \App\ProductVariant::select('id', 'item_code')->FindExactProduct($product_data->id, $product_transfer->variant_id)->first();
                                                            $product_variant_id = $product_variant_data->id;
                                                            $product_data->code = $product_variant_data->item_code;
                                                        }
                                                        else
                                                            $product_variant_id = null;

                                                        $tax = DB::table('taxes')->where('rate', $product_transfer->tax_rate)->first();

                                                        $units = DB::table('units')->where('base_unit', $product_data->unit_id)->orWhere('id', $product_data->unit_id)->get();

                                                        $unit_name = array();
                                                        $unit_operator = array();
                                                        $unit_operation_value = array();

                                                        foreach($units as $unit) {
                                                            if($product_transfer->purchase_unit_id == $unit->id) {
                                                                array_unshift($unit_name, $unit->unit_name);
                                                                array_unshift($unit_operator, $unit->operator);
                                                                array_unshift($unit_operation_value, $unit->operation_value);
                                                            }
                                                            else {
                                                                $unit_name[]  = $unit->unit_name;
                                                                $unit_operator[] = $unit->operator;
                                                                $unit_operation_value[] = $unit->operation_value;
                                                            }
                                                        }
                                                        if($product_data->tax_method == 1){

                                                            $product_cost = $product_transfer->net_unit_cost / $unit_operation_value[0];
                                                        }
                                                        else{
                                                           $product_cost = ($product_transfer->total / $product_transfer->qty) / $unit_operation_value[0]; 
                                                        }
                                                        

                                                        $temp_unit_name = $unit_name = implode(",",$unit_name) . ',';

                                                        $temp_unit_operator = $unit_operator = implode(",",$unit_operator) .',';

                                                        $temp_unit_operation_value = $unit_operation_value =  implode(",",$unit_operation_value) . ',';
                                                    ?>
                                                        <td>{{$product_data->name}} <button type="button" class="edit-product btn btn-link" data-toggle="modal" data-target="#editModal"> <i class="dripicons-document-edit"></i></button> </td>
                                                        <td>{{$product_data->code}}</td>
                                                        <td><input type="number" class="form-control qty" name="qty[]" value="{{$product_transfer->qty}}" required step="any" /></td>
                                                        <td class="net_unit_cost">{{ number_format((float)$product_transfer->net_unit_cost,0, ',' , '.') }} </td>
                                                        <td class="tax">{{ number_format((float)$product_transfer->tax,0, ',' , '.') }}</td>
                                                        <td class="sub-total">{{ number_format((float)$product_transfer->total,0, ',' , '.') }}</td>
                                                        <td><button type="button" class="ibtnDel btn btn-md btn-danger">{{trans("file.delete")}}</button></td>
                                                        <input type="hidden" class="product-id" name="product_id[]" value="{{$product_data->id}}"/>
                                                        <input type="hidden" name="product_variant_id[]" value="{{$product_variant_id}}"/>
                                                        <input type="hidden" class="product-code" name="product_code[]" value="{{$product_data->code}}"/>
                                                        <input type="hidden" class="product-cost" name="product_cost[]" value="{{ $product_cost}}"/>
                                                        <input type="hidden" class="purchase-unit" name="purchase_unit[]" value="{{$unit_name}}"/>
                                                        <input type="hidden" class="purchase-unit-operator" value="{{$unit_operator}}"/>
                                                        <input type="hidden" class="purchase-unit-operation-value" value="{{$unit_operation_value}}"/>
                                                        <input type="hidden" class="net_unit_cost" name="net_unit_cost[]" value="{{$product_transfer->net_unit_cost}}" />
                                                        <input type="hidden" class="tax-rate" name="tax_rate[]" value="{{$product_transfer->tax_rate}}"/>
                                                        @if($tax)
                                                        <input type="hidden" class="tax-name" value="{{$tax->name}}" />
                                                        @else
                                                        <input type="hidden" class="tax-name" value="No Tax" />
                                                        @endif
                                                        <input type="hidden" class="tax-method" value="{{$product_data->tax_method}}"/>
                                                        <input type="hidden" class="tax-value" name="tax[]" value="{{$product_transfer->tax}}" />
                                                        <input type="hidden" class="subtotal-value" name="subtotal[]" value="{{$product_transfer->total}}" />
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot class="tfoot active">
                                                    <th colspan="2">{{trans('file.Total')}}</th>
                                                    <th id="total-qty">{{$lims_transfer_data->total_qty}}</th>
                                                    <th></th>
                                                    <th id="total-tax">{{ number_format((float)$lims_transfer_data->total_tax,0, ',' , '.')}}</th>
                                                    <th id="total">{{ number_format((float)$lims_transfer_data->total_cost,0, ',' , '.')}}</th>
                                                    <th><i class="dripicons-trash"></i></th>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_qty" value="{{$lims_transfer_data->total_qty}}" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_tax" value="{{$lims_transfer_data->total_tax}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_cost" value="{{$lims_transfer_data->total_cost}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="item" value="{{$lims_transfer_data->item}}" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="grand_total" value="{{$lims_transfer_data->grand_total}}" />
                                            <input type="hidden" name="paid_amount" value="{{$lims_transfer_data->paid_amount}}" />
                                            <input type="hidden" name="payment_status" value="1" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <strong>{{trans('file.Shipping Cost')}}</strong>
                                            </label>
                                            <input type="text" id="shipping_costid" name="shipping_cost" class="form-control" value="{{ $lims_transfer_data->shipping_cost }}" step="any" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Attach Document')}}</label>
                                            <i class="dripicons-question" data-toggle="tooltip" title="Only jpg, jpeg, png, gif, pdf, csv, docx, xlsx and txt file is supported"></i> 
                                            <input type="file" name="document" class="form-control" />
                                            @if($errors->has('extension'))
                                                <span>
                                                   <strong>{{ $errors->first('extension') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{trans('file.Note')}}</label>
                                            <textarea rows="5" class="form-control" name="note">{{ $lims_transfer_data->note }}</textarea>
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
                            <label>{{trans('file.Unit Cost')}}</label>
                            <input type="text" id="edit_unit_costid" name="edit_unit_cost" class="form-control" step="any">
                        </div>
                        <div class="form-group">
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
    
</section>
<script type="text/javascript">
    $("ul#transfer").siblings('a').attr('aria-expanded','true');
    $("ul#transfer").addClass("show");
// array data depend on warehouse
var lims_product_array = [];
var product_code = [];
var product_name = [];
var product_qty = [];

// array data with selection
var product_cost = [];
var tax_rate = [];
var tax_name = [];
var tax_method = [];
var unit_name = [];
var unit_operator = [];
var unit_operation_value = [];

// temporary array
var temp_unit_name = [];
var temp_unit_operator = [];
var temp_unit_operation_value = [];

var exist_code = [];
var exist_qty = [];
var rowindex;
var row_product_cost;

var rownumber = $('table.order-list tbody tr:last').index();

for(rowindex  =0; rowindex <= rownumber; rowindex++){

    product_cost.push(parseInt($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-cost').val()));
    exist_code.push($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text());
    var quantity = parseInt($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val());
    exist_qty.push(quantity);
    tax_rate.push(parseInt($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-rate').val()));
    tax_name.push($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-name').val());
    tax_method.push($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-method').val());
    temp_unit_name = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.purchase-unit').val().split(',');
    unit_name.push($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.purchase-unit').val());
    unit_operator.push($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.purchase-unit-operator').val());
    unit_operation_value.push($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.purchase-unit-operation-value').val());
    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.purchase-unit').val(temp_unit_name[0]);
}

$('.selectpicker').selectpicker({
    style: 'btn-link',
});

$('[data-toggle="tooltip"]').tooltip();

//assigning previous value
$('select[name="status"]').val($('input[name="status_hidden"]').val());
$('select[name="from_warehouse_id"]').val($('input[name="from_warehouse_id_hidden"]').val());
$('select[name="to_warehouse_id"]').val($('input[name="to_warehouse_id_hidden"]').val());
$('.selectpicker').selectpicker('refresh');
$('#item').text($('input[name="item"]').val() + '(' + $('input[name="total_qty"]').val() + ')');
$('#subtotal').text(formatRupiah($('input[name="total_cost"]').val() == null ? 0 : $('input[name="total_cost"]').val()));
if(!$('input[name="shipping_cost"]').val())
    $('input[name="shipping_cost"]').val('0');
$('#shipping_cost').text(formatRupiah($('input[name="shipping_cost"]').val()));
$('#grand_total').text(formatRupiah($('input[name="grand_total"]').val()));
$('select[name="from_warehouse_id"]').prop('disabled', true);

var id = $('select[name="from_warehouse_id"]').val();
    $.get('../getproduct/' + id, function(data) {
        lims_product_array = [];
        product_code = data[0];
        product_name = data[1];
        product_qty = data[2];
        $.each(product_code, function(index) {
            if(exist_code.includes(product_code[index])) {
                pos = exist_code.indexOf(product_code[index]);
                product_qty[index] = product_qty[index] + exist_qty[pos];
            }
            lims_product_array.push(product_code[index] + ' (' + product_name[index] + ')');
        });
    });
//assigning value end

$('select[name="from_warehouse_id"]').on('change', function() {
    var id = $('select[name="from_warehouse_id"]').val();
    $.get('../getproduct/' + id, function(data) {
        lims_product_array = [];
        product_code = data[0];
        product_name = data[1];
        product_qty = data[2];
        $.each(product_code, function(index) {
            lims_product_array.push(product_code[index] + ' (' + product_name[index] + ')');
        });
    });
});

$('#lims_productcodeSearch').on('input', function(){
    var warehouse_id = $('select[name="from_warehouse_id"]').val();
    temp_data = $('#lims_productcodeSearch').val();

    if(!warehouse_id){
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
    checkQuantity($(this).val(), true);
});


//Delete product
$("table.order-list tbody").on("click", ".ibtnDel", function(event) {
    rowindex = $(this).closest('tr').index();
    product_cost.splice(rowindex, 1);
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
    var edit_qty = $('input[name="edit_qty"]').val();
    var edit_unit_cost = parseInt($('input[name="edit_unit_cost"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_unit_cost"]').val().replaceAll('.', '') );

    var row_unit_operator = unit_operator[rowindex].slice(0, unit_operator[rowindex].indexOf(","));
    var row_unit_operation_value = unit_operation_value[rowindex].slice(0, unit_operation_value[rowindex].indexOf(","));

    if (row_unit_operator == '*') {
        product_cost[rowindex] = parseInt($('input[name="edit_unit_cost"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_unit_cost"]').val().replaceAll('.', '') ) / row_unit_operation_value;
    } else {
        product_cost[rowindex] = parseInt($('input[name="edit_unit_cost"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="edit_unit_cost"]').val().replaceAll('.', '') ) * row_unit_operation_value;
    }

    var position = $('select[name="edit_unit"]').val();
    var temp_operator = temp_unit_operator[position];
    var temp_operation_value = temp_unit_operation_value[position];
    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.purchase-unit').val(temp_unit_name[position]);
    temp_unit_name.splice(position, 1);
    temp_unit_operator.splice(position, 1);
    temp_unit_operation_value.splice(position, 1);

    temp_unit_name.unshift($('select[name="edit_unit"] option:selected').text());
    temp_unit_operator.unshift(temp_operator);
    temp_unit_operation_value.unshift(temp_operation_value);

    unit_name[rowindex] = temp_unit_name.toString() + ',';
    unit_operator[rowindex] = temp_unit_operator.toString() + ',';
    unit_operation_value[rowindex] = temp_unit_operation_value.toString() + ',';
    checkQuantity(edit_qty, false);
});

function productSearch(data){
    $.ajax({
        type: 'GET',
        url: '../lims_product_search',
        data: {
            data: data
        },
        success: function(data) {
            var flag = 1;
            $(".product-code").each(function(i) {
                if ($(this).val() == data[1]) {
                    rowindex = i;
                    var qty = parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val()) + 1;
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
                cols += '<td><input type="number" class="form-control qty" name="qty[]" value="1" required step="any"/></td>';
                cols += '<td class="net_unit_cost"></td>';
                cols += '<td class="tax"></td>';
                cols += '<td class="sub-total"></td>';
                cols += '<td><button type="button" class="ibtnDel btn btn-md btn-danger">{{trans("file.delete")}}</button></td>';
                cols += '<input type="hidden" class="product-code" name="product_code[]" value="' + data[1] + '"/>';
                cols += '<input type="hidden" class="product-id" name="product_id[]" value="' + data[9] + '"/>';
                cols += '<input type="hidden" name="product_variant_id[]" value="' + data[10] + '"/>';
                cols += '<input type="hidden" class="purchase-unit" name="purchase_unit[]" value="' + temp_unit_name[0] + '"/>';
                cols += '<input type="hidden" class="net_unit_cost" name="net_unit_cost[]" />';
                cols += '<input type="hidden" class="tax-rate" name="tax_rate[]" value="' + data[3] + '"/>';
                cols += '<input type="hidden" class="tax-value" name="tax[]" />';
                cols += '<input type="hidden" class="subtotal-value" name="subtotal[]" />';

                newRow.append(cols);
                $("table.order-list tbody").prepend(newRow);
                rowindex = newRow.index();
                product_cost.splice(rowindex, 0, parseInt(data[2]));
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

function edit(){
    var row_product_name = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(1)').text();
    var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text();
    $('#modal_header').text(row_product_name + '(' + row_product_code + ')');

    var qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val();
    $('input[name="edit_qty"]').val(qty);

    unitConversion();
    $('input[name="edit_unit_cost"]').val(parseInt(row_product_cost));

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
    $('.selectpicker').selectpicker('refresh');
}

function checkQuantity(purchase_qty, flag) {
    var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text();
    var pos = product_code.indexOf(row_product_code);
    var operator = unit_operator[rowindex].split(',');
    var operation_value = unit_operation_value[rowindex].split(',');
    if(operator[0] == '*')
        total_qty = purchase_qty * operation_value[0];
    else if(operator[0] == '/')
        total_qty = purchase_qty / operation_value[0];
    if (total_qty > parseInt(product_qty[pos])) {
        alert('Quantity exceeds stock quantity!');
        if (flag) {
            purchase_qty = purchase_qty.substring(0, purchase_qty.length - 1);
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(purchase_qty);
        } else {
            edit();
            return;
        }
    }
    else {
        $('#editModal').modal('hide');
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(purchase_qty);
    }
    calculateRowProductData(purchase_qty);
}

function calculateRowProductData(quantity) {
    unitConversion();
    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-rate').val(tax_rate[rowindex]);

    if (tax_method[rowindex] == 1) {
        var net_unit_cost = row_product_cost;
        var tax = parseInt(net_unit_cost * quantity * (tax_rate[rowindex] / 100) );
        var sub_total = parseInt( (net_unit_cost * quantity) + tax );

        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(4)').text(formatRupiah(parseInt(net_unit_cost)));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_cost').val(parseInt(net_unit_cost));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(5)').text(formatRupiah(parseInt(tax)));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-value').val(parseInt(tax));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(6)').text(formatRupiah(parseInt(sub_total)));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.subtotal-value').val(parseInt(sub_total));
    } else {

        var sub_total_unit = row_product_cost;
        var net_unit_cost = parseInt( (100 / (100 + tax_rate[rowindex])) * sub_total_unit );
        var tax = parseInt( (sub_total_unit - net_unit_cost) * quantity );
        var sub_total = parseInt( sub_total_unit * quantity );

        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(4)').text(formatRupiah(parseInt(net_unit_cost)));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_cost').val(parseInt(net_unit_cost));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(5)').text(formatRupiah(parseInt(tax)));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-value').val(parseInt(tax));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(6)').text(formatRupiah(parseInt(sub_total)));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.subtotal-value').val(parseInt(sub_total));
    }

    calculateTotal();
}

function unitConversion() {
    var row_unit_operator = unit_operator[rowindex].slice(0, unit_operator[rowindex].indexOf(","));
    var row_unit_operation_value = unit_operation_value[rowindex].slice(0, unit_operation_value[rowindex].indexOf(","));

    if (row_unit_operator == '*') {
        row_product_cost = parseInt(product_cost[rowindex]) * row_unit_operation_value;
    } else {
        row_product_cost = parseInt(product_cost[rowindex]) / row_unit_operation_value;
    }
}

function calculateTotal() {
    //Sum of quantity
    var total_qty = 0;
    $(".qty").each(function() {

        if ($(this).val() == '') {
            total_qty += 0;
        } else {
            total_qty += parseFloat($(this).val());
        }
    });
    $("#total-qty").text(total_qty);
    $('input[name="total_qty"]').val(total_qty);

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
    $("#total").text(formatRupiah(total));
    $('input[name="total_price"]').val(parseInt(total));

    calculateGrandTotal();
}

function calculateGrandTotal() {

    var item = $('table.order-list tbody tr:last').index();

    var total_qty = parseInt($('#total-qty').text());
    var subtotal = parseInt($('#total').text().replaceAll('.', '') == '' ? 0 : $('#total').text().replaceAll('.', ''));
    var shipping_cost = parseInt($('input[name="shipping_cost"]').val().replaceAll('.', '') == '' ? 0 :$('input[name="shipping_cost"]').val().replaceAll('.', ''));

    if (!shipping_cost)
        shipping_cost = 0;

    item = ++item + '(' + total_qty + ')';

    var grand_total = (subtotal + shipping_cost);

    $('#item').text(item);
    $('input[name="item"]').val($('table.order-list tbody tr:last').index() + 1);
    $('#subtotal').text(formatRupiah(parseInt(subtotal)));
    $('#shipping_cost').text(formatRupiah(parseInt(shipping_cost)));
    $('#grand_total').text(formatRupiah(parseInt(grand_total)));
    $('input[name="grand_total"]').val(formatRupiah(parseInt(grand_total)));
}

$('input[name="shipping_cost"]').on("input", function() {
    calculateGrandTotal();
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

$('#transfer-form').on('submit',function(e){
    $('select[name="from_warehouse_id"]').prop('disabled', false);
    var rownumber = $('table.order-list tbody tr:last').index();
    if (rownumber < 0) {
        alert("Please insert product to order table!")
        e.preventDefault();
        $('select[name="from_warehouse_id"]').prop('disabled', true);
    }

    if($('select[name="from_warehouse_id"]').val() == $('select[name="to_warehouse_id"]').val()){
        alert('Both Warehouse can not be same!');
        e.preventDefault();
        $('select[name="from_warehouse_id"]').prop('disabled', true);
    }
});

    var shipping_costid = document.getElementById('shipping_costid');
    shipping_costid.addEventListener('keyup', function(e){
        shipping_costid.value = formatRupiah(this.value, 'input');
    });
    shipping_costid.addEventListener('mouseover', function(e){
        shipping_costid.value = formatRupiah(this.value, 'input');
    });  

    var edit_unit_costid = document.getElementById('edit_unit_costid');
    edit_unit_costid.addEventListener('keyup', function(e){
        edit_unit_costid.value = formatRupiah(this.value, 'input');
    });
    edit_unit_costid.addEventListener('mouseover', function(e){
        edit_unit_costid.value = formatRupiah(this.value, 'input');
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