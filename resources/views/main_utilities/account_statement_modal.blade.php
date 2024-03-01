
@php
    $lims_expense_category_list = DB::table('expense_categories')->where('is_active', true)->get();
    $lims_warehouse_list = \App\Warehouse::when( auth()->user()->role_id > 2, fn($query) => $query->where('id', auth()->user()->warehouse_id) )
                            ->where('is_active', true)
                            ->get();
    $lims_account_list = \App\Account::where('is_active', true)->get();
@endphp

@component('components.modal')
    @slot('title', trans('file.Account Statement') )
    @slot('id', 'account-statement-modal')
        
    <p class="italic">
        <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
    </p>
    {!! Form::open(['route' => 'accounts.statement', 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-6 form-group">
            <label> {{ trans('file.Account') }}</label>
            <select class="form-control selectpicker" name="account_id">
                @foreach ($lims_account_list as $account)
                    <option value="{{ $account->id }}">{{ $account->name }} [{{ $account->account_no }}]</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 form-group">
            <label> {{ trans('file.Type') }}</label>
            <select class="form-control selectpicker" name="type">
                <option value="0">{{ trans('file.All') }}</option>
                <option value="1">{{ trans('file.Debit') }}</option>
                <option value="2">{{ trans('file.Credit') }}</option>
            </select>
        </div>
        <div class="col-md-12 form-group">
            <label>{{ trans('file.Choose Your Date') }}</label>
            <div class="input-group">
                <input type="text" class="daterangepicker-field form-control" required />
                <input type="hidden" name="start_date" />
                <input type="hidden" name="end_date" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ trans('file.submit') }}</button>
    </div>
    {{ Form::close() }}
@endcomponent

