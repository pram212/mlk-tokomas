@php
    $lims_expense_category_list = DB::table('expense_categories')->where('is_active', true)->get();
    $lims_warehouse_list = \App\Warehouse::when( auth()->user()->role_id > 2, fn($query) => $query->where('id', auth()->user()->warehouse_id) )
                            ->where('is_active', true)
                            ->get();
    $lims_account_list = \App\Account::where('is_active', true)->get();
@endphp

@component('components.modal')
    @slot('title', trans('file.Add Account'))
    @slot('id', 'expense-modal')
    
    <p class="italic">
        <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
    </p>
    {!! Form::open(['route' => 'expenses.store', 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-6 form-group">
            <label>{{ trans('file.Expense Category') }} *</label>
            <select name="expense_category_id" class="selectpicker form-control" required
                data-live-search="true" data-live-search-style="begins" title="Select Expense Category...">
                @foreach ($lims_expense_category_list as $expense_category)
                    <option value="{{ $expense_category->id }}">
                        {{ $expense_category->name . ' (' . $expense_category->code . ')' }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 form-group">
            <label>{{ trans('file.Warehouse') }} *</label>
            <select name="warehouse_id" class="selectpicker form-control" required data-live-search="true"
                data-live-search-style="begins" title="Select Warehouse...">
                @foreach ($lims_warehouse_list as $warehouse)
                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 form-group">
            <label>{{ trans('file.Amount') }} *</label>
            <input type="text" id="amountid" name="amount" step="any" required class="form-control">
        </div>
        <div class="col-md-6 form-group">
            <label> {{ trans('file.Account') }}</label>
            <select class="form-control selectpicker" name="account_id">
                @foreach ($lims_account_list as $account)
                    <option @if ($account->is_default) selected @endif value="{{ $account->id }}">
                        {{ $account->name }} [{{ $account->account_no }}]
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label>{{ trans('file.Note') }}</label>
        <textarea name="note" rows="3" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ trans('file.submit') }}</button>
    </div>
    {{ Form::close() }}
   
@endcomponent
