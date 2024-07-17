<div id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'customer.store', 'method' => 'post', 'files' => true]) !!}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{ trans('file.Add Customer') }}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                        aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic">
                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small></p>
                <div class="form-group">
                    <label>{{ trans('file.Customer Group') }} *</strong> </label>
                    <select required class="form-control selectpicker" name="customer_group_id">
                        @foreach ($lims_customer_group_all as $customer_group)
                            <option value="{{ $customer_group->id }}">{{ $customer_group->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>{{ trans('file.name') }} *</strong> </label>
                    <input type="text" name="customer_name" required class="form-control">
                </div>
                <div class="form-group">
                    <label>{{ trans('file.Email') }}</label>
                    <input type="text" name="email" placeholder="example@example.com" class="form-control">
                </div>
                <div class="form-group">
                    <label>{{ trans('file.Phone Number') }} *</label>
                    <input type="text" name="phone_number" required class="form-control">
                </div>
                <div class="form-group">
                    <label>{{ trans('file.Address') }} *</label>
                    <input type="text" name="address" required class="form-control">
                </div>
                <div class="form-group">
                    <label>{{ trans('file.City') }} *</label>
                    <input type="text" name="city" required class="form-control">
                </div>
                <div class="form-group">
                    <input type="hidden" name="pos" value="1">
                    <input type="submit" value="{{ trans('file.submit') }}" class="btn btn-primary">
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
