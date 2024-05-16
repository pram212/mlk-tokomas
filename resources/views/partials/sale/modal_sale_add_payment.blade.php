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
        {!! Form::open(['route' => 'sales.add-payment', 'method' => 'post', 'files' => true, 'class' =>
        'payment-form' ]) !!}
        <div class="row">
          <input type="hidden" name="balance">
          <div class="col-md-6">
            <label>{{trans('file.Recieved Amount')}} *</label>
            <input type="text" id="paying_amountid" name="paying_amount" class="form-control numkey" step="any"
              required>
          </div>
          <div class="col-md-6">
            <label>{{trans('file.Paying Amount')}} *</label>
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
            @php
            $balance = [];
            $expired_date = [];
            @endphp
            @foreach($lims_gift_card_list as $gift_card)
            <?php 
                                $balance[$gift_card->id] = $gift_card->amount - $gift_card->expense;
                                $expired_date[$gift_card->id] = $gift_card->expired_date;
                            ?>
            <option value="{{$gift_card->id}}">{{$gift_card->card_no}}</option>
            @endforeach
          </select>
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

        <input type="hidden" name="sale_id">

        <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>