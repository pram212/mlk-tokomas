@component('components.modal')
    @slot('title', trans('file.Add Account'))
    @slot('id', 'account-modal')
    
    <p class="italic">
        <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
    </p>
    {!! Form::open(['route' => 'accounts.store', 'method' => 'post']) !!}
    <div class="form-group">
        <label>{{ trans('file.Account No') }} *</label>
        <input type="text" name="account_no" required class="form-control">
    </div>
    <div class="form-group">
        <label>{{ trans('file.name') }} *</label>
        <input type="text" name="name" required class="form-control">
    </div>
    <div class="form-group">
        <label>{{ trans('file.Initial Balance') }}</label>
        <input type="text" id="initial_balanceid" name="initial_balance" step="any"
            class="form-control">
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