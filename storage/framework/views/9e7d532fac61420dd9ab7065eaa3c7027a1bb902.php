 <?php $__env->startSection('content'); ?>
    <?php if(session()->has('create_message')): ?>
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button><?php echo e(session()->get('create_message')); ?></div>
    <?php endif; ?>
    <?php if(session()->has('edit_message')): ?>
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button><?php echo e(session()->get('edit_message')); ?></div>
    <?php endif; ?>
    <?php if(session()->has('import_message')): ?>
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button><?php echo e(session()->get('import_message')); ?></div>
    <?php endif; ?>
    <?php if(session()->has('not_permitted')): ?>
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div>
    <?php endif; ?>
    <?php if(session()->has('message')): ?>
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button><?php echo e(session()->get('message')); ?></div>
    <?php endif; ?>

    <section>
        <div class="container-fluid">
            
            <a href="<?php echo e(route('productproperty.create')); ?>" class="btn btn-info"><i class="dripicons-plus"></i>
                <?php echo e(__('file.Add Product Property')); ?></a>
            
        </div>
        <div class="table-responsive">
            <table id="productproperty-datatable" class="table" style="width: 100%">
                <thead>
                    <tr>
                        <th class="not-exported"></th>
                        <th><?php echo e(__('file.Code')); ?></th>
                        <th><?php echo e(__('file.Description')); ?></th>
                        <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                    </tr>
                </thead>

            </table>
        </div>
    </section>

    <script src="<?php echo e(asset('public/js/axios.min.js')); ?>"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        console.log(axios);

        productPropertyTable = $('#productproperty-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "<?php echo e(url('productproperty-datatable')); ?>",
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
                'lengthMenu': '_MENU_ <?php echo e(trans('file.records per page')); ?>',
                "info": '<small><?php echo e(trans('file.Showing')); ?> _START_ - _END_ (_TOTAL_)</small>',
                "search": '<?php echo e(trans('file.Search')); ?>',
                'paginate': {
                    'previous': '<i class="dripicons-chevron-left"></i>',
                    'next': '<i class="dripicons-chevron-right"></i>'
                }
            },
            buttons: [{
                    text: '<?php echo e(trans('file.delete')); ?>',
                    className: 'buttons-delete',
                    action: function(e, dt, node, config) {
                        var user_verified = '<?php echo env('USER_VERIFIED'); ?>'
                        if (!user_verified) {
                            return alert('This feature is disable for demo!')
                        }
                        ids = []
                        $.each($('.dt-checkboxes:checked'), function(indexInArray, valueOfElement) {
                            const tr = $(this).closest('tr'); // get the row target
                            const data = productPropertyTable.row(tr).data(); // get detail data
                            if (data !== undefined) ids.push(data.id)
                        });

                        if (ids.length < 1) {
                            return alert('No data selected!')
                        }
                        const confirmDeleteMultiple = confirm(
                            "If you delete under this tags will also be deleted. Are you sure want to delete?"
                            )
                        if (confirmDeleteMultiple) {
                            const url = "<?php echo url('productproperty-multi-delete'); ?>"
                            axios.post(url, { 
                                    ids : ids 
                                })
                                .then(function (response) {
                                    alert(response.data)
                                    productPropertyTable.ajax.reload();
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
                    text: '<?php echo e(trans('file.PDF')); ?>',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible'
                    },
                    footer: true
                },
                {
                    extend: 'csv',
                    text: '<?php echo e(trans('file.CSV')); ?>',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible'
                    },
                    footer: true
                },
                {
                    extend: 'print',
                    text: '<?php echo e(trans('file.Print')); ?>',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible'
                    },
                    footer: true
                },
                {
                    extend: 'colvis',
                    text: '<?php echo e(trans('file.Column visibility')); ?>',
                    columns: ':gt(0)'
                },
            ]
        });

        // function delete detail
        $('#productproperty-datatable tbody').on('click', 'button.btn-delete', function() {
            var tr = $(this).closest('tr');
            var data = productPropertyTable.row(tr).data();
            const confirmation = confirm("Apakah Anda yakin ingin menghapusnya?");

            if (confirmation) {
                const url = "<?php echo url('productproperty'); ?>" + "/" + data.id
                axios.delete(url)
                    .then(function (response) {
                        alert(response.data)
                        productPropertyTable.ajax.reload();
                    })
                    .catch(function (error) {
                        const errorMessage = error.response.data
                        alert(errorMessage)
                    });
            }

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\mlk-tokomas\resources\views/product_property/index.blade.php ENDPATH**/ ?>