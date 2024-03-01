@component('components.modal')
    @slot('title', trans('file.Customer Report'))
    @slot('id', 'customer-modal')
    <p class="italic">
        <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
    </p>
    {!! Form::open(['route' => 'report.customer', 'method' => 'post']) !!}
    @php
        $lims_customer_list = DB::table('customers')->where('is_active', true)->get();
    @endphp
    <div class="form-group">
        <label>{{ trans('file.customer') }} *</label>
        <select name="customer_id" class="selectpicker form-control" required data-live-search="true" id="customer-id" data-live-search-style="begins" title="Select customer...">
            @foreach ($lims_customer_list as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name . ' (' . $customer->phone_number . ')' }}</option>
            @endforeach
        </select>
    </div>

    <input type="hidden" name="start_date" value="{{ date('Y-m') . '-' . '01' }}" />
    <input type="hidden" name="end_date" value="{{ date('Y-m-d') }}" />

    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ trans('file.submit') }}</button>
    </div>
    {{ Form::close() }}
@endcomponent