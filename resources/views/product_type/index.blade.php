@extends('layout.main') @section('content')
    @if (session()->has('create_message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('create_message') }}</div>
    @endif
    @if (session()->has('edit_message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('edit_message') }}</div>
    @endif
    @if (session()->has('import_message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('import_message') }}</div>
    @endif
    @if (session()->has('not_permitted'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
    @endif
    @if (session()->has('message'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div>
    @endif

    <section>
        <div class="container-fluid">
            {{-- @if (in_array('products-add', $all_permission)) --}}
            <a href="{{ route('producttype.create') }}" class="btn btn-info"><i class="dripicons-plus"></i>
                Tambah Jenis Produk</a>
            {{-- @endif --}}
        </div>
        <div class="table-responsive">
            <table id="producttype-datatable" class="table" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Produk</th>
                        <th>Deskripsi</th>
                        <th class="not-exported">{{ trans('file.action') }}</th>
                    </tr>
                </thead>

            </table>
        </div>
    </section>

    <script>
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        tagTypeTable = $('#producttype-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('producttype-datatable') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'code'
                },
                {
                    data: 'description'
                },
                {
                    data: 'action'
                },
            ],
        });

        // function delete detail
        $('#producttype-datatable tbody').on('click', 'button.btn-delete', function() {
            var tr = $(this).closest('tr');
            var data = tagTypeTable.row(tr).data();
            const confirmation = confirm("Apakah Anda yakin ingin menghapusnya?");

            if (confirmation) {
                $.ajax({
                    type: "DELETE",
                    url: "/producttype/" + data.id,
                    dataType: "json",
                    success: function (response) {
                        $.ajax({
                            url: "tagtype/" + data.id,
                            type: 'delete',
                            dataType: "json",
                            success: function(response) {
                                alert(response)
                                tagTypeTable.ajax.reload();
                            }
                        }) 
                    }
                });

            }

        });
    </script>
@endsection
