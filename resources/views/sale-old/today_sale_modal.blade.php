<div id="today-sale-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{ trans('file.Today Sale') }}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                        aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p>{{ trans('file.Please review the transaction and payments.') }}</p>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td>{{ trans('file.Total Sale Amount') }}:</td>
                                    <td class="total_sale_amount text-right"></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('file.Cash Payment') }}:</td>
                                    <td class="cash_payment text-right"></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('file.Credit Card Payment') }}:</td>
                                    <td class="credit_card_payment text-right"></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('file.Cheque Payment') }}:</td>
                                    <td class="cheque_payment text-right"></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('file.Gift Card Payment') }}:</td>
                                    <td class="gift_card_payment text-right"></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('file.Paypal Payment') }}:</td>
                                    <td class="paypal_payment text-right"></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('file.Total Payment') }}:</td>
                                    <td class="total_payment text-right"></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('file.Total Sale Return') }}:</td>
                                    <td class="total_sale_return text-right"></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('file.Total Expense') }}:</td>
                                    <td class="total_expense text-right"></td>
                                </tr>
                                <tr>
                                    <td><strong>{{ trans('file.Total Cash') }}:</strong></td>
                                    <td class="total_cash text-right"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
