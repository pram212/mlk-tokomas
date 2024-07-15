<div id="recentTransaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Recent Transaction')}} <div class="badge badge-primary">{{trans('file.latest')}} 10</div></h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" href="#sale-latest" role="tab" data-toggle="tab">{{trans('file.Sale')}}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#draft-latest" role="tab" data-toggle="tab">{{trans('file.Draft')}}</a>
              </li>
            </ul>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane show active" id="sale-latest">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>{{trans('file.date')}}</th>
                          <th>{{trans('file.reference')}}</th>
                          <th>{{trans('file.customer')}}</th>
                          <th>{{trans('file.grand total')}}</th>
                          <th>{{trans('file.action')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($recent_sale as $sale)
                        <tr>
                          <td>{{date('d-m-Y', strtotime($sale->created_at))}}</td>
                          <td>{{$sale->reference_no}}</td>
                          <td>{{$sale->customer->name}}</td>
                          <td>{{$sale->grand_total}}</td>
                          <td>
                            <div class="btn-group">
                                @can('update', $sale->id)
                                <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-success btn-sm" title="Edit">
                                    <i class="dripicons-document-edit"></i>
                                </a>&nbsp;    
                                @endcan
                                @can('destroy', $sale->id)
                                {{ Form::open(['route' => ['sales.destroy', $sale->id], 'method' => 'DELETE'] ) }}
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete">
                                    <i class="dripicons-trash"></i>
                                </button>
                                {{ Form::close() }}
                                @endcan
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="draft-latest">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>{{trans('file.date')}}</th>
                          <th>{{trans('file.reference')}}</th>
                          <th>{{trans('file.customer')}}</th>
                          <th>{{trans('file.grand total')}}</th>
                          <th>{{trans('file.action')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($recent_draft as $draft)
                        <tr>
                          <td>{{date('d-m-Y', strtotime($draft->created_at))}}</td>
                          <td>{{$draft->reference_no}}</td>
                          <td>{{$sale->customer->name}}</td>
                          <td>{{$draft->grand_total}}</td>
                          <td>
                            <div class="btn-group">
                                @can('update', $sale)
                                <a href="{{url('sales/'.$draft->id.'/create') }}" class="btn btn-success btn-sm" title="Edit">
                                    <i class="dripicons-document-edit"></i>
                                </a>&nbsp;
                                @endcan

                                @can('delete', $sale)
                                {{ Form::open(['route' => ['sales.destroy', $draft->id], 'method' => 'DELETE'] ) }}
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete">
                                        <i class="dripicons-trash"></i>
                                    </button>
                                {{ Form::close() }}
                                @endcan

                            </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
        </div>
      </div>
    </div>
</div>