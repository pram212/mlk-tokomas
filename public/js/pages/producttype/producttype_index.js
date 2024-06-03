$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

productTypeTable = $("#producttype-datatable").DataTable({
    processing: true,
    serverSide: true,
    // ajax: "{{ url('product-categories/producttype-datatable') }}",
    ajax: baseUrl + "/product-categories/producttype-datatable",
    columns: [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            orderable: false,
            searchable: false,
        },
        {
            data: "code",
        },
        {
            data: "categories",
        },
        {
            data: "description",
        },
        {
            data: "action",
            orderable: false,
            searchable: false,
        },
        {
            data: "created_at",
            visible: false,
        },
    ],
    order: [["5", "desc"]],
    columnDefs: [
        {
            render: function (data, type, row, meta) {
                if (type === "display") {
                    data =
                        '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                }

                return data;
            },
            checkboxes: {
                selectRow: true,
                selectAllRender:
                    '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>',
            },
            targets: [0],
        },
    ],
    select: {
        style: "multi",
        selector: "td:first-child",
    },
    dom: '<"row"lfB>rtip',
    language: {
        lengthMenu: `_MENU_ ${lang_records_per_page}`,
        info: `<small>${lang_Showing} _START_ - _END_ (_TOTAL_)</small>`,
        search: `${lang_search}`,
        paginate: {
            previous: '<i class="dripicons-chevron-left"></i>',
            next: '<i class="dripicons-chevron-right"></i>',
        },
    },
    buttons: [
        {
            text: lang_delete,
            className: "buttons-delete",
            action: function (e, dt, node, config) {
                if (!user_verified) {
                    // return alert("This feature is disable for demo!");
                    Swal.fire(
                        "Error",
                        "This feature is disabled for demo!",
                        "error"
                    );
                    return;
                }
                ids = [];
                $.each(
                    $(".dt-checkboxes:checked"),
                    function (indexInArray, valueOfElement) {
                        const tr = $(this).closest("tr"); // get the row target
                        const data = productTypeTable.row(tr).data(); // get detail data
                        if (data !== undefined) ids.push(data.id);
                    }
                );

                if (ids.length < 1) {
                    // return alert("No data selected!");
                    Swal.fire("Error", "No data selected!", "error");
                    return;
                }
                Swal.fire({
                    title: "Are you sure?",
                    text: "If you delete under this tags will also be deleted.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        const url = `${baseUrl}/product-categories/producttype-multi-delete`;
                        axios
                            .post(url, { ids: ids })
                            .then(function (response) {
                                const status = response.data.status;
                                const msg = response.data.message;
                                if (!status) throw new Error(msg);

                                Swal.fire("Success", msg, "success");
                                productTypeTable.ajax.reload();
                            })
                            .catch(function (error) {
                                Swal.fire("Error", error.message, "error");
                            });
                    }
                });
            },
        },
        {
            extend: "pdf",
            text: lang_PDF,
            exportOptions: {
                columns: ":visible:Not(.not-exported)",
                rows: ":visible",
            },
            title: lang_product_type,
            filename: lang_product_type,
            footer: true,
        },
        {
            extend: "csv",
            text: lang_CSV,
            exportOptions: {
                columns: ":visible:Not(.not-exported)",
                rows: ":visible",
            },
            title: lang_product_type,
            filename: lang_product_type,
            footer: true,
        },
        {
            extend: "print",
            text: lang_print,
            exportOptions: {
                columns: ":visible:Not(.not-exported)",
                rows: ":visible",
            },
            title: lang_product_type,
            filename: lang_product_type,
            footer: true,
        },
        {
            extend: "colvis",
            text: lang_visibility,
            columns: ":gt(0)",
        },
    ],
});

// function delete detail
$("#producttype-datatable tbody").on(
    "click",
    "button.btn-delete",
    async function () {
        var tr = $(this).closest("tr");
        var data = productTypeTable.row(tr).data();
        const confirmation = await Swal.fire({
            title: "Apakah Anda yakin ingin menghapusnya?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
        });

        if (confirmation.value) {
            const url = `${baseUrl}/product-categories/producttype/${data.id}`;
            try {
                const response = await axios.delete(url);
                const status = response.data.status;
                const msg = response.data.message;

                if (!status) throw new Error(msg);

                Swal.fire("Terhapus!", msg, "success");
                productTypeTable.ajax.reload();
            } catch (error) {
                Swal.fire("Error", error.message, "error");
            }
        }
    }
);
