<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_header" class="modal-title"></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                        aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>{{ trans('file.Quantity') }}</label>
                        <input type="text" name="edit_qty" class="form-control numkey">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('file.Unit Discount') }}</label>
                        <input type="text" id="edit_discountid" name="edit_discount" class="form-control numkey">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('file.Unit Price') }}</label>
                        <input type="text" id="edit_unit_priceid" name="edit_unit_price" class="form-control numkey"
                            step="any">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('file.Tax Rate') }}</label>
                        <select name="edit_tax_rate" class="form-control selectpicker">
                            @foreach ($tax_name_all as $key => $name)
                                <option value="{{ $key }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="edit_unit" class="form-group">
                        <label>{{ trans('file.Product Unit') }}</label>
                        <select name="edit_unit" class="form-control selectpicker">
                        </select>
                    </div>
                    <button type="button" name="update_btn" class="btn btn-primary">{{ trans('file.update') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
