<div id="register-details-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{ trans('file.Cash Register Details') }}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                    <span aria-hidden="true"><i class="dripicons-cross"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ trans('file.Please review the transaction and payments.') }}</p>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td>{{ trans('file.Cash in Hand') }}:</td>
                                    <td id="cash_in_hand" class="text-right">0</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('file.Total Sale Amount') }}:</td>
                                    <td id="total_sale_amount" class="text-right"></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('file.Total Payment') }}:</td>
                                    <td id="total_payment" class="text-right"></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('file.Cash Payment') }}:</td>
                                    <td id="cash_payment" class="text-right"></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('file.Credit Card Payment') }}:</td>
                                    <td id="credit_card_payment" class="text-right"></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('file.Cheque Payment') }}:</td>
                                    <td id="cheque_payment" class="text-right"></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('file.Gift Card Payment') }}:</td>
                                    <td id="gift_card_payment" class="text-right"></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('file.Paypal Payment') }}:</td>
                                    <td id="paypal_payment" class="text-right"></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('file.Total Sale Return') }}:</td>
                                    <td id="total_sale_return" class="text-right"></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('file.Total Expense') }}:</td>
                                    <td id="total_expense" class="text-right"></td>
                                </tr>
                                <tr>
                                    <td><strong>{{ trans('file.Total Cash') }}:</strong></td>
                                    <td id="total_cash" class="text-right"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6" id="closing-section">
                        <form action="{{ route('cash-register.close') }}" method="POST">
                            @csrf
                            <input type="hidden" name="cash_register_id">
                            <button type="submit" class="btn btn-primary">{{ trans('file.Close Register') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
