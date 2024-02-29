@component('components.modal')
    @slot('title', trans('file.Supplier Report')) 
    @slot('id', 'supplier-modal')

    <p class="italic">
        <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
    </p>
    @php
        $lims_supplier_list = DB::table('suppliers')->where('is_active', true)->get();
    @endphp
    {!! Form::open(['route' => 'report.supplier', 'method' => 'post']) !!}
    <div class="form-group">
        <label>{{ trans('file.Supplier') }} *</label>
        <select name="supplier_id" class="selectpicker form-control" required data-live-search="true"
            id="supplier-id" data-live-search-style="begins" title="Select Supplier...">
            @foreach ($lims_supplier_list as $supplier)
                <option value="{{ $supplier->id }}">
                    {{ $supplier->name . ' (' . $supplier->phone_number . ')' }}</option>
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