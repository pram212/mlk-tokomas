@php
    $lims_user_list = DB::table('users')->where([['is_active', true], ['id', '!=', \Auth::user()->id]])->get();
@endphp

@component('components.modal')
    @slot('title', trans('file.Send Notification')) 
    @slot('id', 'notification-modal')
    <p class="italic">
        <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
    </p>

    {!! Form::open(['route' => 'notifications.store', 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-6 form-group">
            <label>{{ trans('file.User') }} *</label>
            <select name="user_id" class="selectpicker form-control" required data-live-search="true"
                data-live-search-style="begins" title="Select user...">
                @foreach ($lims_user_list as $user)
                    <option value="{{ $user->id }}">{{ $user->name . ' (' . $user->email . ')' }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12 form-group">
            <label>{{ trans('file.Message') }} *</label>
            <textarea rows="5" name="message" class="form-control" required></textarea>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ trans('file.submit') }}</button>
    </div>
    {{ Form::close() }}
@endcomponent
