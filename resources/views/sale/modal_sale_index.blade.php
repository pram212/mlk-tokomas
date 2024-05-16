<div id="sale-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
  class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="container mt-3 pb-2 border-bottom">
        <div class="row">
          <div class="col-md-3">
            <button id="print-btn" type="button" class="btn btn-default btn-sm d-print-none"><i
                class="dripicons-print"></i> {{trans('file.Print')}}</button>

            {{ Form::open(['route' => 'sales.sendmail', 'method' => 'post', 'class' => 'sendmail-form'] ) }}
            <input type="hidden" name="sale_id">
            <button class="btn btn-default btn-sm d-print-none"><i class="dripicons-mail"></i>
              {{trans('file.Email')}}</button>
            {{ Form::close() }}
          </div>
          <div class="col-md-6">
            <h3 id="exampleModalLabel" class="modal-title text-center container-fluid">
              {{$general_setting->site_title}}</h3>
          </div>
          <div class="col-md-3">
            <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close"
              class="close d-print-none"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
          </div>
          <div class="col-md-12 text-center">
            <i style="font-size: 15px;">{{trans('file.Sale Details')}}</i>
          </div>
        </div>
      </div>
      <div id="sale-content" class="modal-body">
      </div>
      <br>
      <table class="table table-bordered product-sale-list">
        <thead>
          <th>#</th>
          <th>{{trans('file.product')}}</th>
          <th>{{trans('file.Qty')}}</th>
          <th>{{trans('file.Unit Price')}}</th>
          <th>{{trans('file.Tax')}}</th>
          <th>{{trans('file.Discount')}}</th>
          <th>{{trans('file.Subtotal')}}</th>
        </thead>
        <tbody>
        </tbody>
      </table>
      <div id="sale-footer" class="modal-body"></div>
    </div>
  </div>
</div>

<div id="view-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
  class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">{{trans('file.All')}} {{trans('file.Payment')}}</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
              class="dripicons-cross"></i></span></button>
      </div>
      <div class="modal-body">
        <table class="table table-hover payment-list">
          <thead>
            <tr>
              <th>{{trans('file.date')}}</th>
              <th>{{trans('file.reference')}}</th>
              <th>{{trans('file.Account')}}</th>
              <th>{{trans('file.Amount')}}</th>
              <th>{{trans('file.Paid By')}}</th>
              <th>{{trans('file.action')}}</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

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

<div id="add-delivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
  class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Delivery')}}</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
              class="dripicons-cross"></i></span></button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => 'delivery.store', 'method' => 'post', 'files' => true]) !!}
        <div class="row">
          <div class="col-md-6 form-group">
            <label>{{trans('file.Delivery Reference')}}</label>
            <p id="dr"></p>
          </div>
          <div class="col-md-6 form-group">
            <label>{{trans('file.Sale Reference')}}</label>
            <p id="sr"></p>
          </div>
          <div class="col-md-12 form-group">
            <label>{{trans('file.Status')}} *</label>
            <select name="status" required class="form-control selectpicker">
              <option value="1">{{trans('file.Packing')}}</option>
              <option value="2">{{trans('file.Delivering')}}</option>
              <option value="3">{{trans('file.Delivered')}}</option>
            </select>
          </div>
          <div class="col-md-6 mt-2 form-group">
            <label>{{trans('file.Delivered By')}}</label>
            <input type="text" name="delivered_by" class="form-control">
          </div>
          <div class="col-md-6 mt-2 form-group">
            <label>{{trans('file.Recieved By')}} </label>
            <input type="text" name="recieved_by" class="form-control">
          </div>
          <div class="col-md-6 form-group">
            <label>{{trans('file.customer')}} *</label>
            <p id="customer"></p>
          </div>
          <div class="col-md-6 form-group">
            <label>{{trans('file.Attach File')}}</label>
            <input type="file" name="file" class="form-control">
          </div>
          <div class="col-md-6 form-group">
            <label>{{trans('file.Address')}} *</label>
            <textarea rows="3" name="address" class="form-control" required></textarea>
          </div>
          <div class="col-md-6 form-group">
            <label>{{trans('file.Note')}}</label>
            <textarea rows="3" name="note" class="form-control"></textarea>
          </div>
        </div>
        <input type="hidden" name="reference_no">
        <input type="hidden" name="sale_id">
        <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>