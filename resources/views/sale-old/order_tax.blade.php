<div id="order-tax" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('file.Order Tax') }}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                        aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="order_tax_rate">
                    <select class="form-control" name="order_tax_rate_select" id="order-tax-rate-select">
                        <option value="0">No Tax</option>
                        @foreach ($lims_tax_list as $tax)
                            <option value="{{ $tax->rate }}">{{ $tax->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="button" name="order_tax_btn" class="btn btn-primary"
                    data-dismiss="modal">{{ trans('file.submit') }}</button>
            </div>
        </div>
    </div>
</div>
