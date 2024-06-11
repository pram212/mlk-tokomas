@extends('layout.top-head') @section('content')
@if($errors->has('phone_number'))
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('phone_number') }}
</div>
@endif
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div>
@endif
@if(session()->has('not_permitted'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
<!-- Side Navbar -->
@include('layout.sidebar')

<section class="forms pos-section">
    <div class="container-fluid">
        <div class="row">
            <audio id="mysoundclip1" preload="auto">
                <source src="{{url('public/beep/beep-timber.mp3')}}">
                </source>
            </audio>
            <audio id="mysoundclip2" preload="auto">
                <source src="{{url('public/beep/beep-07.mp3')}}">
                </source>
            </audio>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body" style="padding-bottom: 0">
                        {!! Form::open(['route' => 'sales.store', 'method' => 'post', 'files' => true, 'class' =>
                        'payment-form']) !!}
                        @php
                        if($lims_pos_setting_data)
                        $keybord_active = $lims_pos_setting_data->keybord_active;
                        else
                        $keybord_active = 0;

                        $customer_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([
                        ['permissions.name', 'customers-add'],
                        ['role_id', \Auth::user()->role_id] ])->first();
                        @endphp
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 d-none">
                                        <div class="form-group">
                                            <input type="text" id="reference-no" name="reference_no" class="form-control" placeholder="Type reference number" onkeyup='saveValue(this);' />
                                        </div>
                                        @if($errors->has('reference_no'))
                                        <span>
                                            <strong>{{ $errors->first('reference_no') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            @if($lims_pos_setting_data)
                                            <input type="hidden" name="warehouse_id_hidden" value="{{$lims_pos_setting_data->warehouse_id}}">
                                            @endif
                                            <select required id="warehouse_id" name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                                                @foreach($lims_warehouse_list as $warehouse)
                                                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            @if($lims_pos_setting_data)
                                            <input type="hidden" name="biller_id_hidden" value="{{$lims_pos_setting_data->biller_id}}">
                                            @endif
                                            <select required id="biller_id" name="biller_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Cashier...">
                                                @foreach($lims_cashier_list as $cashier)
                                                <option value="{{$cashier->id}}">{{$cashier->name . ' (' .
                                                    $cashier->company_name . ')'}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            @if($lims_pos_setting_data)
                                            <input type="hidden" name="customer_id_hidden" value="{{$lims_pos_setting_data->customer_id}}">
                                            @endif
                                            <div class="input-group pos">
                                                @if($customer_active)
                                                <select required name="customer_id" id="customer_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select customer..." style="width: 100px">
                                                    <?php $deposit = [] ?>
                                                    @foreach($lims_customer_list as $customer)
                                                    @php $deposit[$customer->id] = $customer->deposit -
                                                    $customer->expense; @endphp
                                                    <option value="{{$customer->id}}">{{$customer->name . ' (' .
                                                        $customer->phone_number . ')'}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#addCustomer"><i class="dripicons-plus"></i></button>
                                                @else
                                                <?php $deposit = [] ?>
                                                <select required name="customer_id" id="customer_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select customer...">
                                                    @foreach($lims_customer_list as $customer)
                                                    @php $deposit[$customer->id] = $customer->deposit -
                                                    $customer->expense; @endphp
                                                    <option value="{{$customer->id}}">{{$customer->name . ' (' .
                                                        $customer->phone_number . ')'}}</option>
                                                    @endforeach
                                                </select>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="search-box form-group">
                                            <input type="text" name="product_code_name" id="lims_productcodeSearch" placeholder="Search product by name/code" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="table-responsive transaction-list">
                                        <table id="myTable" class="table table-hover table-striped order-list table-fixed">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-4">{{trans('file.product')}}</th>
                                                    <th class="col-sm-2">{{trans('file.Price')}}</th>
                                                    <th class="col-sm-3">{{trans('file.Quantity')}}</th>
                                                    <th class="col-sm-3">{{trans('file.Subtotal')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody-id">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row" style="display: none;">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_qty" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_discount" value="0" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_tax" value="0" />
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
                                            <input type="hidden" name="coupon_discount" />
                                            <input type="hidden" name="sale_status" value="1" />
                                            <input type="hidden" name="coupon_active">
                                            <input type="hidden" name="coupon_id">
                                            <input type="hidden" name="coupon_discount" />

                                            <input type="hidden" name="pos" value="1" />
                                            <input type="hidden" name="draft" value="0" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 totals" style="border-top: 2px solid #e4e6fc; padding-top: 10px;">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <span class="totals-title">{{trans('file.Items')}}</span><span id="item">0</span>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="totals-title">{{trans('file.Total')}}</span><span id="subtotal">0</span>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="totals-title">{{trans('file.Discount')}} <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#order-discount-modal"> <i class="dripicons-document-edit"></i></button></span><span id="discount">0</span>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="totals-title">{{trans('file.Coupon')}} <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#coupon-modal"><i class="dripicons-document-edit"></i></button></span><span id="coupon-text">0</span>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="totals-title">{{trans('file.Tax')}} <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#order-tax"><i class="dripicons-document-edit"></i></button></span><span id="tax">0</span>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="totals-title">{{trans('file.Shipping')}} <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#shipping-cost-modal"><i class="dripicons-document-edit"></i></button></span><span id="shipping-cost">0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="payment-amount">
                        <h2>{{trans('file.grand total')}} <span id="grand-total">0</span></h2>
                    </div>
                    <div class="payment-options">
                        {{-- <div class="column-5">
                            <button style="background: #0984e3" type="button" class="btn btn-custom payment-btn"
                                data-toggle="modal" data-target="#add-payment" id="credit-card-btn"><i
                                    class="fa fa-credit-card"></i> Card</button>
                        </div> --}}
                        <div class="column-5">
                            <button style="background: #00cec9" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="cash-btn"><i class="fa fa-money"></i>
                                Cash</button>
                        </div>
                        {{-- <div class="column-5">
                            <button style="background-color: #213170" type="button" class="btn btn-custom payment-btn"
                                data-toggle="modal" data-target="#add-payment" id="paypal-btn"><i
                                    class="fa fa-paypal"></i> Paypal</button>
                        </div> --}}
                        {{-- <div class="column-5">
                            <button style="background-color: #e28d02" type="button" class="btn btn-custom"
                                id="draft-btn"><i class="dripicons-flag"></i> Draft</button>
                        </div> --}}
                        {{-- <div class="column-5">
                            <button style="background-color: #fd7272" type="button" class="btn btn-custom payment-btn"
                                data-toggle="modal" data-target="#add-payment" id="cheque-btn"><i
                                    class="fa fa-money"></i> Cheque</button>
                        </div> --}}
                        {{-- <div class="column-5">
                            <button style="background-color: #5f27cd" type="button" class="btn btn-custom payment-btn"
                                data-toggle="modal" data-target="#add-payment" id="gift-card-btn"><i
                                    class="fa fa-credit-card-alt"></i> GiftCard</button>
                        </div> --}}
                        {{-- <div class="column-5">
                            <button style="background-color: #b33771" type="button" class="btn btn-custom payment-btn"
                                data-toggle="modal" data-target="#add-payment" id="deposit-btn"><i
                                    class="fa fa-university"></i> Deposit</button>
                        </div> --}}
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
            <!-- payment modal -->
            @component('sale.add_payment') @endcomponent
            <!-- order_discount modal -->
            @component('sale.order_discount_modal') @endcomponent
            <!-- coupon modal -->
            @component('sale.coupon_modal') @endcomponent
            <!-- order_tax modal -->
            @component('sale.order_tax', ['lims_tax_list' => $lims_tax_list]) @endcomponent
            <!-- shipping_cost modal -->
            @component('sale.shipping_cost_modal') @endcomponent

            {!! Form::close() !!}
            <!-- product list -->
            <div class="col-md-6">
                <!-- navbar-->
                @include('sale.pos_header')

                <div class="filter-window">
                    <div class="category mt-3">
                        <div class="row ml-2 mr-2 px-2">
                            <div class="col-7">Choose category</div>
                            <div class="col-5 text-right">
                                <span class="btn btn-default btn-sm">
                                    <i class="dripicons-cross"></i>
                                </span>
                            </div>
                        </div>
                        <div class="row ml-2 mt-3">
                            @foreach($lims_category_list as $category)
                            <div class="col-md-3 category-img text-center" data-category="{{$category->id}}">
                                <p class="text-center">{{$category->name}}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="brand mt-3">
                        <div class="row ml-2 mr-2 px-2">
                            <div class="col-7">Choose brand</div>
                            <div class="col-5 text-right">
                                <span class="btn btn-default btn-sm">
                                    <i class="dripicons-cross"></i>
                                </span>
                            </div>
                        </div>
                        <div class="row ml-2 mt-3">
                            @foreach($lims_brand_list as $brand)
                            @if($brand->image)
                            <div class="col-md-3 brand-img text-center" data-brand="{{$brand->id}}">
                                <img src="{{url('public/images/brand',$brand->image)}}" />
                                <p class="text-center">{{$brand->title}}</p>
                            </div>
                            @else
                            <div class="col-md-3 brand-img" data-brand="{{$brand->id}}">
                                <img src="{{url('public/images/product/zummXD2dvAtI.png')}}" />
                                <p class="text-center">{{$brand->title}}</p>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <button class="btn btn-block btn-primary" id="category-filter">{{trans('file.category')}}</button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-block btn-info d-none" id="brand-filter">{{trans('file.Brand')}}</button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-block btn-danger d-none" id="featured-filter">{{trans('file.Featured')}}</button>
                    </div>
                    <div class="col-md-12 mt-1 table-container">
                        <table id="product-table" class="table no-shadow product-list">
                            <thead class="d-none">
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i=0; $i < ceil($product_number/5); $i++) <tr>
                                    <td class="product-img sound-btn" title="{{$lims_product_list[0+$i*5]->name}}" data-product="{{$lims_product_list[0+$i*5]->code . ' (' . $lims_product_list[0+$i*5]->name . ')'}}">
                                        <img src="{{url('public/images/product',$lims_product_list[0+$i*5]->base_image)}}" width="100%" />
                                        <p>{{$lims_product_list[0+$i*5]->name}}</p>
                                        <span>{{$lims_product_list[0+$i*5]->code}}</span>
                                    </td>
                                    @if(!empty($lims_product_list[1+$i*5]))
                                    <td class="product-img sound-btn" title="{{$lims_product_list[1+$i*5]->name}}" data-product="{{$lims_product_list[1+$i*5]->code . ' (' . $lims_product_list[1+$i*5]->name . ')'}}">
                                        <img src="{{url('public/images/product',$lims_product_list[1+$i*5]->base_image)}}" width="100%" />
                                        <p>{{$lims_product_list[1+$i*5]->name}}</p>
                                        <span>{{$lims_product_list[1+$i*5]->code}}</span>
                                    </td>
                                    @else
                                    <td style="border:none;"></td>
                                    @endif
                                    @if(!empty($lims_product_list[2+$i*5]))
                                    <td class="product-img sound-btn" title="{{$lims_product_list[2+$i*5]->name}}" data-product="{{$lims_product_list[2+$i*5]->code . ' (' . $lims_product_list[2+$i*5]->name . ')'}}">
                                        <img src="{{url('public/images/product',$lims_product_list[2+$i*5]->base_image)}}" width="100%" />
                                        <p>{{$lims_product_list[2+$i*5]->name}}</p>
                                        <span>{{$lims_product_list[2+$i*5]->code}}</span>
                                    </td>
                                    @else
                                    <td style="border:none;"></td>
                                    @endif
                                    @if(!empty($lims_product_list[3+$i*5]))
                                    <td class="product-img sound-btn" title="{{$lims_product_list[3+$i*5]->name}}" data-product="{{$lims_product_list[3+$i*5]->code . ' (' . $lims_product_list[3+$i*5]->name . ')'}}">
                                        <img src="{{url('public/images/product',$lims_product_list[3+$i*5]->base_image)}}" width="100%" />
                                        <p>{{$lims_product_list[3+$i*5]->name}}</p>
                                        <span>{{$lims_product_list[3+$i*5]->code}}</span>
                                    </td>
                                    @else
                                    <td style="border:none;"></td>
                                    @endif
                                    @if(!empty($lims_product_list[4+$i*5]))
                                    <td class="product-img sound-btn" title="{{$lims_product_list[4+$i*5]->name}}" data-product="{{$lims_product_list[4+$i*5]->code . ' (' . $lims_product_list[4+$i*5]->name . ')'}}">
                                        <img src="{{url('public/images/product',$lims_product_list[4+$i*5]->base_image)}}" width="100%" />
                                        <p>{{$lims_product_list[4+$i*5]->name}}</p>
                                        <span>{{$lims_product_list[4+$i*5]->code}}</span>
                                    </td>
                                    @else
                                    <td style="border:none;"></td>
                                    @endif
                                    </tr>
                                    @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @php
            $tax_name_all[] = 'No Tax';
            $tax_rate_all[] = 0;
            foreach ($lims_tax_list as $tax) {
            $tax_name_all[] = $tax->name;
            $tax_rate_all[] = $tax->rate;
            }
            @endphp
            <!-- product edit modal -->
            @include('sale.edit_modal')

            <!-- add customer modal -->
            @component('sale.add_customer_modal', compact('lims_customer_group_all') ) @endcomponent

            <!-- recent transaction modal -->
            @component('sale.recent_transaction', compact('recent_draft', 'recent_sale') ) @endcomponent

            <!-- add cash register modal -->
            @component('sale.cash_register_modal', compact('lims_warehouse_list') ) @endcomponent

            <!-- cash register details modal -->
            @component('sale.register_details_modal') @endcomponent

            <!-- today sale modal -->
            @component('sale.today_sale_modal') @endcomponent

            <!-- today profit modal -->
            @component('sale.today_profit_modal', compact('lims_warehouse_list') ) @endcomponent
        </div>
    </div>
</section>

@endsection

@section('scripts')

{{-- @include('sale.pos_js') --}}
@include('sale.pos_js_new')

@endsection