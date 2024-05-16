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
        {!! Form::open(['route' => 'sales.update-payment', 'method' => 'post', 'class' => 'payment-form' ]) !!}
        <div class="row">
          <div class="col-md-6">
            <label>{{trans('file.Recieved Amount')}} *</label>
            <input type="text" id="edit_paying_amountid" name="edit_paying_amount" class="form-control numkey"
              step="any" required>
          </div>
          <div class="col-md-6">
            <label>{{trans('file.Paying Amount')}} *</label>
            <input type="text" id="edit_amountid" name="edit_amount" class="form-control" step="any" required>
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
          <select id="gift_card_id" name="gift_card_id" class="selectpicker form-control" data-live-search="true"
            data-live-search-style="begins" title="Select Gift Card...">
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