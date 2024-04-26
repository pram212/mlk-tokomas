<div id="cash-register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'cash-register.store', 'method' => 'post']) !!}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{ trans('file.Add Cash Register') }}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic">
                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                </p>
                <div class="row">
                    <div class="col-md-6 form-group warehouse-section">
                        <label>{{ trans('file.Warehouse') }} *</strong> </label>
                        <select required name="warehouse_id" class="selectpicker form-control" data-live-search="true"
                            data-live-search-style="begins" title="Select warehouse...">
                            @foreach ($lims_warehouse_list as $warehouse)
                            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ trans('file.Cash in Hand') }} *</strong> </label>
                        <input type="text" id="cash_in_handid" name="cash_in_hand" required class="form-control">
                    </div>
                    <div class="col-md-12 form-group">
                        <button type="submit" class="btn btn-primary">{{ trans('file.submit') }}</button>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>