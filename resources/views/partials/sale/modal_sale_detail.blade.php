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
        {{-- header --}}
        <div>
          <b>Tanggal</b> : <span id="sale-date"></span><br>
          <b>Refrensi</b> : <span id="sale-reference"></span><br>
          <b>Gudang/Toko</b> : <span id="sale-warehouse"></span><br>
          <b>Status Penjualan</b> : <span id="sale-status"></span><br>
        </div>

        {{-- header 2 --}}
        <div class="row mt-5">
          <div class="col-9">
            <b>Dari:</b><br>
            <span id="biller-name"></span><br>
            <span id="biller-company"></span><br>
            <span id="biller-email"></span>
          </div>
          <div class="col-3">
            <b>Untuk:</b> <br>
            <span id="customer-name"></span><br>
            <span id="customer-phone-number"></span><br>
            <span id="customer-address"></span>
          </div>
        </div>
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
        <tbody id="table-product-sale-body">
        </tbody>
      </table>
      <div id="sale-footer" class="modal-body mt-2">
        <b>Nota Penjualan:</b> <span id="sale-note"></span><br><br>
        <b>Nota Staf:</b> <span id="sale-staff-note"></span><br><br>
        <b>Dibuat Oleh:</b> <br>
        <span id="sale-user-name"></span><br>
        <span id="sale-user-email"></span>
      </div>
    </div>
  </div>
</div>