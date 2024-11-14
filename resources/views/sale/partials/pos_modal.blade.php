<!-- Coupon -->
<div class="modal fade" id="modalCoupon" tabindex="-1" role="dialog" aria-labelledby="modalCouponLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCouponLabel">{{ __('file.Coupon Code') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" name="coupon_code" id="coupon_code"
                    placeholder="enter coupon code..">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_redeem_coupon">{{ __('file.coupon_redeem')
                    }}</button>
            </div>
        </div>
    </div>
</div>

<!-- Discount -->
<div class="modal fade" id="modalDiscount" tabindex="-1" role="dialog" aria-labelledby="modalDiscountLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDiscountLabel">{{ __('file.Discount') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="number" min="0" max="100" class="form-control" name="discount_percent"
                    id="discount_percent" placeholder="enter discount in percent..">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_discount_percent">{{ __('file.submit')
                    }}</button>
            </div>
        </div>
    </div>
</div>

<!-- Tax -->
<div class="modal fade" id="modalTax" tabindex="-1" role="dialog" aria-labelledby="modalTaxLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTaxLabel">{{ __('file.Tax') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <select class="form-control" name="select_tax" id="select_tax"></select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_submit_tax">{{ __('file.submit')
                    }}</button>
            </div>
        </div>
    </div>
</div>

<!-- add customer modal -->
<div id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'customer.store', 'method' => 'post', 'files' => true]) !!}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Customer')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small>{{trans('file.The field labels marked with * are required input
                        fields')}}.</small></p>
                {{-- <div class="form-group">
                    <label>{{trans('file.Customer Group')}} *</strong> </label>
                    <select required class="form-control selectpicker" name="customer_group_id">
                        @foreach($customer_group_all as $customer_group)
                        <option value="{{$customer_group->id}}">{{$customer_group->name}}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="form-group">
                    <label>{{trans('file.name')}} *</strong> </label>
                    <input type="text" name="customer_name" required class="form-control">
                </div>
                {{-- <div class="form-group">
                    <label>{{trans('file.Email')}}</label>
                    <input type="text" name="email" placeholder="example@example.com" class="form-control">
                </div>
                <div class="form-group">
                    <label>{{trans('file.Phone Number')}} *</label>
                    <input type="text" name="phone_number" required class="form-control">
                </div> --}}
                <div class="form-group">
                    <label>{{trans('file.Address')}} *</label>
                    <input type="text" name="address" required class="form-control">
                </div>
                {{-- <div class="form-group">
                    <label>{{trans('file.City')}} *</label>
                    <input type="text" name="city" required class="form-control">
                </div> --}}
                <div class="form-group">
                    <input type="hidden" name="pos" value="1">
                    <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<!-- payment modal -->
<div id="add-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Finalize Sale')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-6 mt-1">
                                <label>{{trans('file.Recieved Amount')}} *</label>
                                <input type="text" id="paying_amount" name="paying_amount"
                                    class="form-control format-money" required step="any">
                            </div>
                            <div class="col-md-6 mt-1">
                                <label>{{trans('file.Paying Amount')}} *</label>
                                <input type="text" id="paid_amount" name="paid_amount" class="form-control" step="any"
                                    readonly>
                            </div>
                            <div class="col-md-6 mt-1">
                                <label>{{trans('file.Change')}} : </label>
                                <p id="payment_change" class="ml-2">0</p>
                            </div>
                            {{-- TAKEOUT DISCOUNT FROM SALE --}}
                            {{-- <div class="col-md-6 mt-1">
                                <input type="hidden" name="paid_by_id">
                                <label>Total Discount</label>
                                <input class="form-control" type="text" name="payment_discount" id="payment_discount"
                                    readonly>
                            </div> --}}

                        </div>

                        {{-- payment method section --}}
                        <div class="row mt-3">
                            <div class="col-md-6"></div>
                            <div class="col-md-6" id="payment_select_section">
                                <label>Payment</label>
                            </div>
                        </div>
                        @can('hidden temporary')
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <table class="table" id="payment_table">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Payment</td>
                                            <td>Amount</td>
                                            <td>Note</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5">
                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-sm btn-primary"
                                                        id="btn_payment_add_row"><span
                                                            class="dripicons-plus"></span></button>
                                                    <button class="btn btn-sm btn-danger"
                                                        id="btn_payment_remove_row"><span
                                                            class="dripicons-minus"></span></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                        @endcan
                        {{-- end payment method section --}}

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>{{trans('file.Payment Note')}}</label>
                                <textarea id="payment_note" rows="2" class="form-control"
                                    name="payment_note"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>{{trans('file.Sale Note')}}</label>
                                <textarea rows="3" class="form-control" name="sale_note"></textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{trans('file.Staff Note')}}</label>
                                <textarea rows="3" class="form-control" name="staff_note"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 qc" data-initial="1">
                        <h4><strong>{{ trans('file.Quick Cash') }}</strong></h4>
                        <div id="quick_cash"></div>
                    </div>
                </div>

                <div class="mt-3">
                    <button id="btn-submit-payment" type="button"
                        class="btn btn-primary">{{trans('file.submit')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
