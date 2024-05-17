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