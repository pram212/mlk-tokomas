@can('viewAny', App\WarehouseTransfer::class)
    <div class="dropdown">
        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Action
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

            <form action="{{ url('transfer-to-etalase') }}" method="POST">
                @csrf
                <input type="hidden" name="warehouse_transfer_id" value="{{ $query->id }}">
                <input type="hidden" name="product_id" value="{{ $query->product_id }}">
                <button type="submit" class="dropdown-item btn-delete"><i class="fa fa-arrow-right"></i> Transfer to
                    Etalase</button>
            </form>

            <button type="button" data-id="{{ $query->id }}" class="open-EditWarehouseDialog btn btn-link dropdown-item"
                data-toggle="modal" data-target="#editModal"><i class="dripicons-document-edit"></i>
                {{ trans('file.edit_barcode') }}
            </button>
        </div>
    </div>


    <div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
        class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route' => ['warehouse_transfer.update', 1], 'method' => 'put']) !!}
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title"> {{ trans('file.edit') }}
                        {{ trans('file.warehouse_transfer') }}</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                            aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    <p class="italic">
                        <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                    </p>
                    <input type="hidden" name="product_id">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ trans('file.Product Code') }} *</strong> </label>
                            <div class="input-group">
                                <input type="text" name="code" class="form-control" id="code"
                                    aria-describedby="code" readonly>
                                <div class="input-group-append">
                                    <button id="genbutton" type="button" class="btn btn-sm btn-default"
                                        title="{{ trans('file.Generate') }}"><i class="fa fa-refresh"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- QR Code --}}
                    <div class="col-md-6 border border-top-0 border-top-0 border-bottom-0 border-right-0">
                        <div class="d-flex align-items-center justify-content-center" style="min-height: 200px">
                            <div class="text-center" id="prev-qrcode">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                    </div>

                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

    <script src="{{ asset('public/js/qrcode.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.open-EditWarehouseDialog', function() {
                var url = "warehouse_transfer/"
                var id = $(this).data('id').toString();
                url = url.concat(id).concat("/edit");

                $.get(url, function(data) {
                    $("#editModal input[name='product_id']").val(data['product_id']);
                    $("#editModal input[name='code']").val(data['code']);
                    generateQRCode(data['code'], "prev-qrcode");
                    // $("#editModal input[name='email']").val(data['email']);
                    // $("#editModal textarea[name='address']").val(data['address']);
                    // $("#editModal input[name='warehouse_id']").val(data['id']);
                });

            });

            $("#genbutton").on("click", function() {
                console.log('tes');
                $.get(baseUrl + "/products-gencode", function(data) {
                    $("input[name='code']").val(data);
                    generateQRCode(data, "prev-qrcode");
                });

                $('button[data-id="input-split-type"]').attr("disabled", false);
                input_split_type.val("");
                input_split_type.trigger("change");
            });
        });

        function generateQRCode(data, elementId) {
            document.getElementById(elementId).innerHTML = "";
            var qrcode = new QRCode(document.getElementById(elementId), {
                text: data,
                width: 200,
                height: 200,
            });
        }
    </script>
@endcan
