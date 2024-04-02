@extends('layout.main') @section('content')
<section>
    <div class="container-fluid">
        <h3>{{ trans('file.Gold Price') }} - {{ date('d M Y') }}</h3>
        <hr>
        {{-- @if (in_array('products-add', $all_permission)) --}}
        <a href="{{ route('master.price.create') }}" class="btn btn-info"><i class="dripicons-plus"></i>
            {{ __('file.Add Price') }}</a>
        {{-- @endif --}}
    </div>
    <div class="table-responsive">
        <table id="price-datatable" class="table" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{ __('file.Price') }}</th>
                    <th>{{ __('file.Gramasi') }}</th>
                    <th>{{ __('file.Carat') }}</th>
                    <th>{{ __('file.Product Property') }}</th>
                    <th>{{ __('file.Created By') }}</th>
                    <th>{{ __('file.Updated By') }}</th>
                    <th>{{ __('file.Created At') }}</th>
                    <th>{{ __('file.Updated At') }}</th>
                    <th class="not-exported">{{ trans('file.action') }}</th>
                </tr>
            </thead>

        </table>
    </div>
</section>

<script src="{{ asset('public/js/axios.min.js') }}"></script>
<script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        priceTable = $('#price-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('master/price-datatable') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'price'
                },
                {
                    data: 'gramasi'
                },
                {
                    data: 'carat'
                },
                {
                    data: 'property'
                },
                {
                    data: 'created_by'
                },
                {
                    data: 'updated_by'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'updated_at'
                },
                {
                    data: 'action'
                },
            ],
            order: [
                ['7', 'desc']
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
                            const data = priceTable.row(tr).data(); // get detail data
                            if (data !== undefined) ids.push(data.id)
                        });

                        if (ids.length < 1) {
                            return alert('No data selected!')
                        }
                        const confirmDeleteMultiple = confirm(
                            "If you delete under this tags will also be deleted. Are you sure want to delete?"
                            )
                        if (confirmDeleteMultiple) {
                            const url = "{!! url('master/price-multi-delete') !!}"
                            axios.post(url, { 
                                    ids : ids 
                                })
                                .then(function (response) {
                                    alert(response.data)
                                    priceTable.ajax.reload();
                                })
                                .catch(function (error) {
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
        $('#price-datatable tbody').on('click', 'button.btn-delete', function() {
            var tr = $(this).closest('tr');
            var data = priceTable.row(tr).data();
            const confirmation = confirm("Apakah Anda yakin ingin menghapusnya?");

            if (confirmation) {
                const url = "{!! url('master/price') !!}" + "/" + data.id
                axios.delete(url)
                    .then(function (response) {
                        alert(response.data)
                        priceTable.ajax.reload();
                    })
                    .catch(function (error) {
                        const errorMessage = error.response.data
                        alert(errorMessage)
                    });
            }

        });
</script>
@endsection