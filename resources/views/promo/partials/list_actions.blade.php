<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        {{ trans('file.action') }}
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
        <li>
            <a href="{{ route('promo.show', $promo->id) }}" class="btn btn-link"><i class="fa fa-eye"></i>
                {{
                trans('file.View') }}</a>
        </li>
        <li>
            <a href="{{ route('promo.edit', $promo->id) }}" class="btn btn-link"><i class="dripicons-document-edit"></i>
                {{
                trans('file.edit') }}</a>
        </li>
        <li>
            {!! Form::open(["route" => ["promo.destroy", $promo->id], "method" => "DELETE"]) !!}
            <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i>
                {{
                trans('file.delete') }}</button>
            {!! Form::close() !!}
        </li>
    </ul>
</div>