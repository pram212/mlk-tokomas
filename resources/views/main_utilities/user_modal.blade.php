@component('components.modal')
    @slot('title', trans('file.User Report')) 
    @slot('id', 'user-modal')

    <p class="italic">
        <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
    </p>
    @php
        $lims_user_list = DB::table('users')->where('is_active', true)->get();
    @endphp
    {!! Form::open(['route' => 'report.user', 'method' => 'post']) !!}
    <div class="form-group">
        <label>{{ trans('file.User') }} *</label>
        <select name="user_id" class="selectpicker form-control" required data-live-search="true"
            id="user-id" data-live-search-style="begins" title="Select user...">
            @foreach ($lims_user_list as $user)
                <option value="{{ $user->id }}">{{ $user->name . ' (' . $user->phone . ')' }}</option>
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