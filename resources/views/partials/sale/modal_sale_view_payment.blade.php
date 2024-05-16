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
              <th>{{trans('file.No')}}</th>
              <th>{{trans('file.date')}}</th>
              <th>{{trans('file.reference')}}</th>
              <th>{{trans('file.Account')}}</th>
              <th>{{trans('file.Amount')}}</th>
              <th>{{trans('file.Paid By')}}</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>