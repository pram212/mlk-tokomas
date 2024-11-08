<div class="card">
    <div class="card-body">
        {{-- Product: Filter --}}
        <div class="row">
            <div class="col-md-4">
                {{-- warehouse select --}}
                <div class="form-group">
                    <select class="form-control selectpicker" id="warehouse_id" name="warehouse_id"
                        data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                        <option value="">All Warehouse</option>
                        @foreach ($warehouse_list as $warehouse)
                        <option value="{{ $warehouse->id }}" {{ ($warehouse->id===1)?'selected':'' }}>{{
                            $warehouse->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                {{-- cashier select --}}
                <div class="form-group">
                    <select class="form-control selectpicker" id="cashier_id" name="cashier_id" data-live-search="true"
                        data-live-search-style="begins" title="Select cashier...">
                        @foreach ($cashier_list as $cashier)
                        <option value="{{ $cashier->id }}" selected>{{ $cashier->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                {{-- customer select --}}
                <div class="input-group pos">
                    <select class="form-control selectpicker" id="customer_id" name="customer_id"
                        data-live-search="true" data-live-search-style="begins" title="Select customer...">
                        @foreach ($customer_list as $customer)
                        <option value="{{ $customer->id }}" {{ ($customer->id===9)?'selected':'' }}>{{
                            $customer->name." (".$customer->phone_number.")" }}
                        </option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-default btn-sm ml-1" data-toggle="modal"
                        data-target="#addCustomer">
                        <i class="dripicons-plus"></i>
                    </button>
                </div>
            </div>

        </div>

        {{-- Product: Search Box jQuery ui-autocomplete --}}
        <div class="row">
            <div class="col-md-12">
                <div class="form-group ui-widget">
                    <div class="input-group">
                        <input type="text" class="form-control" id="product_search" name="product_search"
                            placeholder="{{ __('file.search_product_pos') }}">
                        {{-- <button class="btn btn-success" id="btn_scan_barcode"><span class="fa fa-barcode"
                                title="scan barcode product"></span></button> --}}
                    </div>
                    <input type="text" name="barcode_data" class="hidden-input">
                </div>
            </div>
        </div>

        {{-- Product: Cart Datatable --}}
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="cart-table" class="table table-hover order-list"
                        style="width: 100%; margin-top: 0px !important;">
                        <thead>
                            <tr>
                                <th>{{ __('file.product') }}</th>
                                <th>{{ __('file.Price') }}</th>
                                <th>{{ __('file.Quantity') }}</th>
                                <th>{{ __('file.Subtotal') }}</th>
                                <th>{{ __('file.action') }}</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Product: Info and Grand Total --}}
        <hr>
        <div class="row">
            <div class="col">
                <table style="width:100%">
                    <tr>
                        <td>Items</td>
                        <td><Span id="info-total-items">0(0)</Span></td>
                        <td>Total</td>
                        <td><Span id="info-subtotal">0</Span></td>
                        <td>
                            <div class="d-none">
                                Discount <button type="button" class="btn btn-link btn-sm" data-toggle="modal"
                                    data-target="#modalDiscount"><i class="dripicons-document-edit"></i></button>
                            </div>
                        </td>
                        <td><span id="info-discount" class="d-none">0</span></td>
                    </tr>
                    <tr>
                        <td>Coupon <button type="button" class="btn btn-link btn-sm" data-toggle="modal"
                                data-target="#modalCoupon"><i class="dripicons-document-edit"></i></button></td>
                        <td><Span id="info-coupon">0</Span></td>
                        <td>Tax <button type="button" id="btn_modal_tax" class="btn btn-link btn-sm" data-toggle="modal"
                                data-target="#modalTax"><i class="dripicons-document-edit"></i></button></td>
                        <td><Span id="info-tax">0</Span></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <input type="hidden" name="coupon_code_val">
            <input type="hidden" name="discount_val">

        </div>
        <div class="payment-options">
            <div class="column-5">
                <button style="background: #00cec9" type="button" class="btn btn-custom payment-btn" id="btn-payment"><i
                        class="fa fa-money"></i>
                    Payment</button>
            </div>
        </div>
    </div>
    <div class="card-footer bg-success payment-amount">
        <h2>Grand Total <span id="grand-total">Rp.0</span></h2>
    </div>
</div>

@include('sale.partials.pos_modal')
