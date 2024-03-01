@component('components.modal')
    @slot('title', trans('file.Warehouse Report')) 
    @slot('id', 'warehouse-modal')
    <p class="italic">
        <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
    </p>
    @php
        $lims_warehouse_list = DB::table('warehouses')->where('is_active', true)->get();
    @endphp
    {!! Form::open(['route' => 'report.warehouse', 'method' => 'post']) !!}
    <div class="form-group">
        <label>{{ trans('file.Warehouse') }} *</label>
        <select name="warehouse_id" class="selectpicker form-control" required data-live-search="true" id="warehouse-id" data-live-search-style="begins" title="Select warehouse...">
            @foreach ($lims_warehouse_list as $warehouse)
                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
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