<div id="add-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{ trans('file.Finalize Sale') }}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                        aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-6 mt-1">
                                <label>{{ trans('file.Recieved Amount') }} *</label>
                                <input type="text" id="paying_amountid" name="paying_amount"
                                    class="form-control numkey" required step="any">
                            </div>
                            <div class="col-md-6 mt-1">
                                <label>{{ trans('file.Paying Amount') }} *</label>
                                <input type="text" id="paid_amountid" name="paid_amount" class="form-control numkey"
                                    step="any" readonly>
                            </div>
                            <div class="col-md-6 mt-1">
                                <label>{{ trans('file.Change') }} : </label>
                                <p id="change" class="ml-2">0</p>
                            </div>
                            <div class="col-md-6 mt-1">
                                <input type="hidden" name="paid_by_id">
                                <label>{{ trans('file.Paid By') }}</label>
                                <select name="paid_by_id_select" class="form-control selectpicker">
                                    <option value="1">Cash</option>
                                    <option value="2">Gift Card</option>
                                    <option value="3">Credit Card</option>
                                    <option value="4">Cheque</option>
                                    <option value="5">Paypal</option>
                                    <option value="6">Deposit</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 mt-3">
                                <div class="card-element form-control">
                                </div>
                                <div class="card-errors" role="alert"></div>
                            </div>
                            <div class="form-group col-md-12 gift-card">
                                <label> {{ trans('file.Gift Card') }} *</label>
                                <input type="hidden" name="gift_card_id">
                                <select id="gift_card_id_select" name="gift_card_id_select"
                                    class="selectpicker form-control" data-live-search="true"
                                    data-live-search-style="begins" title="Select Gift Card..."></select>
                            </div>
                            <div class="form-group col-md-12 cheque">
                                <label>{{ trans('file.Cheque Number') }} *</label>
                                <input type="text" name="cheque_no" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label>{{ trans('file.Payment Note') }}</label>
                                <textarea id="payment_note" rows="2" class="form-control" name="payment_note"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>{{ trans('file.Sale Note') }}</label>
                                <textarea rows="3" class="form-control" name="sale_note"></textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{ trans('file.Staff Note') }}</label>
                                <textarea rows="3" class="form-control" name="staff_note"></textarea>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button id="submit-btn" type="button"
                                class="btn btn-primary">{{ trans('file.submit') }}</button>
                        </div>
                    </div>
                    <div class="col-md-2 qc" data-initial="1">
                        <h4><strong>{{ trans('file.Quick Cash') }}</strong></h4>
                        <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="1000"
                            type="button">1.000</button>
                        <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="2000"
                            type="button">2.000</button>
                        <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="5000"
                            type="button">5.000</button>
                        <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="10000"
                            type="button">10.000</button>
                        <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="20000"
                            type="button">20.000</button>
                        <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="50000"
                            type="button">50.000</button>
                        <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="100000"
                            type="button">100.000</button>
                        <button class="btn btn-block btn-danger qc-btn sound-btn" data-amount="0"
                            type="button">{{ trans('file.Clear') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
