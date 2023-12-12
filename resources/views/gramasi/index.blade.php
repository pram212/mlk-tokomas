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
            <a href="{{ route('gramasi.create') }}" class="btn btn-info"><i class="dripicons-plus"></i>
                {{ __('file.Add Gramasi') }}</a>
            {{-- @endif --}}
        </div>
        <div class="table-responsive">
            <table id="gramasi-datatable" class="table" style="width: 100%">
                <thead>
                    <tr>
                        <th class="not-exported"></th>
                        <th>{{ __('file.Product Type') }}</th>
                        <th>{{ __('file.Freetext') }}</th>
                        <th class="not-exported">{{ trans('file.action') }}</th>
                    </tr>
                </thead>

            </table>
        </div>
    </section>

    <script src="{{ asset('public/js/axios.min.js') }}"></script>
    <script>

        gramasiTable = $('#gramasi-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('gramasi-datatable') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'product_type'
                },
                {
                    data: 'freetext'
                },
                {
                    data: 'action'
                },
            ],
            order: [
                ['2', 'asc']
            ],
            columnDefs: [{
                    "orderable": false,
                    'targets': [0, 3]
                },
                {
                    'render': function(data, type, row, meta) {
                        if (type === 'display') {
                            data =
                                '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                        }

                        return data;
                    },
                    'checkboxes': {
                        'selectRow': true,
                        'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                    },
                    'targets': [0]
                }
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            dom: '<"row"lfB>rtip',
            language: {
                'lengthMenu': '_MENU_ {{ trans('file.records per page') }}',
                "info": '<small>{{ trans('file.Showing') }} _START_ - _END_ (_TOTAL_)</small>',
                "search": '{{ trans('file.Search') }}',
                'paginate': {
                    'previous': '<i class="dripicons-chevron-left"></i>',
                    'next': '<i class="dripicons-chevron-right"></i>'
                }
            },
            buttons: [{
                    text: '{{ trans('file.delete') }}',
                    className: 'buttons-delete',
                    action: function(e, dt, node, config) {

                        var user_verified = '{!! env('USER_VERIFIED') !!}'

                        if (!user_verified) {
                            return alert('This feature is disable for demo!')
                        }
                        ids = []
                        $.each($('.dt-checkboxes:checked'), function(indexInArray, valueOfElement) {
                            const tr = $(this).closest('tr'); // get the row target
                            const data = gramasiTable.row(tr).data(); // get detail data
                            if (data !== undefined) ids.push(data.id)
                        });

                        if (ids.length < 1) {
                            return alert('No data selected!')
                        }
                        const confirmDeleteMultiple = confirm(
                            "If you delete under this tags will also be deleted. Are you sure want to delete?"
                            )
                        if (confirmDeleteMultiple) {
                            const url = "{!! url('gramasi-multi-delete') !!}"
                            axios.post(url, {
                                    ids: ids
                                })
                                .then(function(response) {
                                    alert(response.data)
                                    gramasiTable.ajax.reload();
                                })
                                .catch(function(error) {
                                    const errorMessage = error.response.data
                                    alert(errorMessage)
                                })

                            return
                        }
                    }
                },
                {
                    extend: 'pdf',
                    text: '{{ trans('file.PDF') }}',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible'
                    },
                    footer: true
                },
                {
                    extend: 'csv',
                    text: '{{ trans('file.CSV') }}',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible'
                    },
                    footer: true
                },
                {
                    extend: 'print',
                    text: '{{ trans('file.Print') }}',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible'
                    },
                    footer: true
                },
                {
                    extend: 'colvis',
                    text: '{{ trans('file.Column visibility') }}',
                    columns: ':gt(0)'
                },
            ]
        });

        // function delete detail
        $('#gramasi-datatable tbody').on('click', 'button.btn-delete', function() {
            var tr = $(this).closest('tr');
            var data = gramasiTable.row(tr).data();
            const confirmation = confirm("Apakah Anda yakin ingin menghapusnya?");

            if (confirmation) {
                // run delete function via ajax
                const url = "{!! url('gramasi') !!}" + "/" + data.id
                axios.delete(url)
                    .then(function (response) {
                        alert(response.data)
                        gramasiTable.ajax.reload();
                    })
                    .catch(function (error) {
                        const errorMessage = error.response.data
                        alert(errorMessage)
                    });

            }

        });
    </script>
@endsection
