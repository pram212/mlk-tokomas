@extends('layout.main') @section('content')
@if ($errors->has('name'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('name') }}</div>
@endif
@if ($errors->has('image'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('image') }}</div>
@endif
@if (session()->has('message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div>
@endif
@if (session()->has('not_permitted'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif

<section>
    <div class="container-fluid">
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createModal"><i
                class="dripicons-plus"></i> {{ trans('file.Add Category') }}</button>&nbsp;
        <button class="btn btn-primary" data-toggle="modal" data-target="#importCategory"><i class="dripicons-copy"></i>
            {{ trans('file.Import Category') }}</button>
    </div>
    <div class="table-responsive">
        <table id="category-table" class="table" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{ trans('file.category') }}</th>
                    <th>{{ trans('file.Created At') }}</th>
                    <th class="not-exported">{{ trans('file.action') }}</th>
                    <th>{{ trans('file.Updated By') }}</th>
                </tr>
            </thead>
        </table>
    </div>
</section>

<!-- Create Modal -->
<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'category.store', 'method' => 'post', 'files' => true]) !!}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{ trans('file.Add Category') }}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic">
                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                </p>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>{{ trans('file.name') }} *</label>
                        {{ Form::text('name', null, ['required' => 'required', 'class' => 'form-control', 'placeholder'
                        => trans('file.Type category name').'...' ]) }}
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" value="{{ trans('file.submit') }}" class="btn btn-primary">
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<!-- Edit Modal -->
<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {{ Form::open(['route' => ['category.update', 1], 'method' => 'PUT', 'files' => true, 'id' => 'form-edit'])
            }}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{ trans('file.Update Category') }}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic">
                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                </p>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>{{ trans('file.name') }} *</label>
                        {{ Form::text('name', null, ['required' => 'required', 'class' => 'form-control']) }}
                    </div>


                </div>

                <div class="form-group">
                    <input type="submit" value="{{ trans('file.submit') }}" class="btn btn-primary">
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<!-- Import Modal -->
<div id="importCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'category.import', 'method' => 'post', 'files' => true]) !!}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{ trans('file.Import Category') }}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic">
                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                </p>
                <p>{{ trans('file.The correct column order is') }} (name*)
                    {{ trans('file.and you must follow this') }}.</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ trans('file.Upload CSV File') }} *</label>
                            {{ Form::file('file', ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> {{ trans('file.Sample File') }}</label>
                            <a href="public/sample_file/sample_category.csv" class="btn btn-info btn-block btn-md"><i
                                    class="dripicons-download"></i> {{ trans('file.Download') }}</a>
                        </div>
                    </div>
                </div>
                <input type="submit" value="{{ trans('file.submit') }}" class="btn btn-primary">
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<script>
    $("ul#product").siblings('a').attr('aria-expanded', 'true');
        $("ul#product").addClass("show");
        $("ul#product #category-menu").addClass("active");

        function confirmDelete() {
            if (confirm(
                    "If you delete category all products under this category will also be deleted. Are you sure want to delete?"
                )) {
                return true;
            }
            return false;
        }

        var category_id = [];
        var user_verified = "{{ env('USER_VERIFIED') }}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on("click", ".open-EditCategoryDialog", function() {
            var url = "category/";
            var id = $(this).data('id').toString();
            url = url.concat(id).concat("/edit");

            $.get(url, function(data) {
                $("#editModal input[name='name']").val(data.name);
                $("#editModal select[name='parent_id']").val(data.parent_id);
                $("#editModal input[name='category_id']").val(data.id);
                $("#edit-category").val(data.category).trigger("change");
                $("#edit-sub_category").val(data.sub_category);
                $('.selectpicker').selectpicker('refresh');
                $("#form-edit").attr("action", "{!! url('category') !!}" + "/" + data.id);
            });
        });

        var category_table = $('#category-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "category/category-datatable",
                dataType: "json",
                type: "post"
            },
            "createdRow": function(row, data, dataIndex) {
                $(row).attr('data-id', data['id']);
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "name",
                    name: 'name',
                    render: function(data, type, row) {
                        return `<div style="width:200px"><div>${data}</div></div>`;
                    }
                },
                {
                    "data": "created_at",
                    searchable: false,
                    render: function(data, type, row) {
                        let date = moment(data).format('YYYY-MM-DD');
                        return `<div style="width:200px"><div>${date}</div></div>`;
                    }
                },
                {
                    "data": "options",
                    'searchable': false,
                    'orderable': false,
                    render: function(data, type, row) {
                        return `<div style="display: flex;width="100px"">${data}</div>`;
                    }
                },
                
                {
                    "data": "updated_at",
                    visible: false,
                    searchable: false
                }
            ],
            'language': {
                'lengthMenu': '_MENU_ {{ trans('file.records per page') }}',
                "info": '<small>{{ trans('file.Showing') }} _START_ - _END_ (_TOTAL_)</small>',
                "search": '{{ trans('file.Search') }}',
                'paginate': {
                    'previous': '<i class="dripicons-chevron-left"></i>',
                    'next': '<i class="dripicons-chevron-right"></i>'
                }
            },
            order: [
                ['2', 'desc']
            ],
            'columnDefs': [
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
            'select': {
                style: 'multi',
                selector: 'td:first-child'
            },
            'lengthMenu': [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],

            dom: '<"row"lfB>rtip',
            buttons: [{
                    extend: 'pdf',
                    text: "{{ trans('file.PDF') }}",
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible'
                    },
                    footer: true
                },
                {
                    extend: 'csv',
                    text: "{{ trans('file.CSV') }}",
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible'
                    },
                    footer: true
                },
                {
                    extend: 'print',
                    text: "{{ trans('file.Print') }}",
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible'
                    },
                    footer: true
                },
                {
                    text: "{{ trans('file.delete') }}",
                    className: 'buttons-delete',
                    action: function(e, dt, node, config) {
                        if (user_verified == '1') {
                            category_id.length = 0;
                            $(':checkbox:checked').each(function(i) {
                                if (i) {
                                    category_id[i - 1] = $(this).closest('tr').data('id');
                                }
                            });
                            if (category_id.length && confirm(
                                    "If you delete category all products under this category will also be deleted. Are you sure want to delete?"
                                )) {
                                $.ajax({
                                    type: 'POST',
                                    url: 'category/deletebyselection',
                                    data: {
                                        categoryIdArray: category_id
                                    },
                                    success: function(data) {
                                        dt.rows({
                                            page: 'current',
                                            selected: true
                                        }).deselect();
                                        dt.rows({
                                            page: 'current',
                                            selected: true
                                        }).remove().draw(false);
                                    }
                                });
                            } else if (!category_id.length)
                                alert('No category is selected!');
                        } else
                            alert('This feature is disable for demo!');
                    }
                },
                {
                    extend: 'colvis',
                    text: '{{ trans('file.Column visibility') }}',
                    columns: ':gt(0)'
                },
            ],
        });

</script>

@endsection