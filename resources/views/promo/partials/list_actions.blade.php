<div class="btn-group">
  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
    aria-expanded="false">
    {{ trans('file.action') }}
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
    <li><a href="{{ route('sales.invoice', $sale->id) }}" class="btn btn-link"><i class="fa fa-copy"></i> {{
        trans('file.Generate Invoice') }}</a></li>
    <li>
      <button type="button" class="btn btn-link view"><i class="fa fa-eye"></i> {{ trans('file.View') }}</button>
    </li>
    @if(in_array("sales-edit", $request['all_permission']))
    @if($sale->sale_status != 3)
    <li>
      <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-link"><i class="dripicons-document-edit"></i> {{
        trans('file.edit') }}</a>
    </li>
    @else
    <li>
      <a href="{{ url('sales/' . $sale->id . '/create') }}" class="btn btn-link"><i class="dripicons-document-edit"></i>
        {{ trans('file.edit') }}</a>
    </li>
    @endif
    @endif
    <li>
      <button type="button" class="add-payment btn btn-link" data-id="{{ $sale->id }}" data-toggle="modal"
        data-target="#add-payment"><i class="fa fa-plus"></i> {{ trans('file.Add Payment') }}</button>
    </li>
    <li>
      <button type="button" class="get-payment btn btn-link" data-id="{{ $sale->id }}"><i class="fa fa-money"></i> {{
        trans('file.View Payment') }}</button>
    </li>
    <li>
      <button type="button" class="add-delivery btn btn-link" data-id="{{ $sale->id }}"><i class="fa fa-truck"></i> {{
        trans('file.Add Delivery') }}</button>
    </li>
    @if(in_array("sales-delete", $request['all_permission']))
    <li>
      {!! Form::open(["route" => ["sales.destroy", $sale->id], "method" => "DELETE"]) !!}
      <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> {{
        trans('file.delete') }}</button>
      {!! Form::close() !!}
    </li>
    @endif
  </ul>
</div>