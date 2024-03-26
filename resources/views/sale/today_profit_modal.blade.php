<div id="today-profit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{ trans('file.Today Profit') }}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                        aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <select required name="warehouseId" class="form-control">
                            <option value="0">{{ trans('file.All Warehouse') }}</option>
                            @foreach ($lims_warehouse_list as $warehouse)
                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mt-2">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td>{{ trans('file.Product Revenue') }}:</td>
                                    <td class="product_revenue text-right"></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('file.Product Cost') }}:</td>
                                    <td class="product_cost text-right"></td>
                                </tr>
                                <tr>
                                    <td>{{ trans('file.Expense') }}:</td>
                                    <td class="expense_amount text-right"></td>
                                </tr>
                                <tr>
                                    <td><strong>{{ trans('file.Profit') }}:</strong></td>
                                    <td class="profit text-right"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
