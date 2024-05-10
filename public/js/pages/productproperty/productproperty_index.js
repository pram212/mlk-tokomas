$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

productPropertyTable = $("#productproperty-datatable").DataTable({
    processing: true,
    serverSide: true,
    ajax: baseUrl + "/product-categories/productproperty-datatable",
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
            data: "description",
        },
        {
            data: "action",
        },
    ],
    order: [["2", "asc"]],
    columnDefs: [
        {
            orderable: false,
            targets: [0, 3],
        },
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
                    return Swal.fire(
                        "Error",
                        "This feature is disabled for demo!",
                        "error"
                    );
                }
                ids = [];
                $.each(
                    $(".dt-checkboxes:checked"),
                    function (indexInArray, valueOfElement) {
                        const tr = $(this).closest("tr"); // get the row target
                        const data = productPropertyTable.row(tr).data(); // get detail data
                        if (data !== undefined) ids.push(data.id);
                    }
                );

                if (ids.length < 1) {
                    return Swal.fire("Error", "No data selected!", "error");
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
                        const url = `${baseUrl}/product-categories/productproperty-multi-delete`;
                        axios
                            .post(url, { ids: ids })
                            .then(function (response) {
                                Swal.fire("Success", response.data, "success");
                                productPropertyTable.ajax.reload();
                            })
                            .catch(function (error) {
                                const errorMessage = error.response.data;
                                Swal.fire("Error", errorMessage, "error");
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
            footer: true,
        },
        {
            extend: "csv",
            text: lang_CSV,
            exportOptions: {
                columns: ":visible:Not(.not-exported)",
                rows: ":visible",
            },
            footer: true,
        },
        {
            extend: "print",
            text: lang_print,
            exportOptions: {
                columns: ":visible:Not(.not-exported)",
                rows: ":visible",
            },
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
$("#productproperty-datatable tbody").on(
    "click",
    "button.btn-delete",
    async function () {
        var tr = $(this).closest("tr");
        var data = productPropertyTable.row(tr).data();
        const confirmation = await Swal.fire({
            title: "Apakah Anda yakin ingin menghapusnya?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
        });

        if (confirmation.value) {
            const url = `${baseUrl}/product-categories/productproperty/${data.id}`;
            try {
                const response = await axios.delete(url);
                Swal.fire("Terhapus!", response.data.message, "success");
                productPropertyTable.ajax.reload();
            } catch (error) {
                const errorMessage = error.response.data;
                Swal.fire("Gagal!", errorMessage, "error");
            }
        }
    }
);
