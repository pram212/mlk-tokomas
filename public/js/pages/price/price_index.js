$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

priceTable = $("#price-datatable").DataTable({
    processing: true,
    serverSide: true,
    ajax: baseUrl + "/master/price-datatable",
    columns: [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            orderable: false,
            searchable: false,
        },
        {
            data: "tag_type",
        },
        {
            data: "gramasi",
        },
        {
            data: "carat",
        },

        {
            data: "categories",
        },
        {
            data: "product_type",
        },
        {
            data: "created_by",
        },
        {
            data: "updated_by",
        },
        {
            data: "created_at",
        },
        {
            data: "updated_at",
        },
        {
            data: "action",
        },
    ],
    order: [["9", "desc"]],
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
            action: async function (e, dt, node, config) {
                if (!user_verified) {
                    return Swal.fire(
                        "Error",
                        "This feature is disabled for demo!",
                        "error"
                    );
                }
                const ids = [];
                $(".dt-checkboxes:checked").each(function (index, element) {
                    const tr = $(element).closest("tr"); // get the row target
                    const data = priceTable.row(tr).data(); // get detail data
                    if (data !== undefined) ids.push(data.id);
                });

                if (ids.length < 1) {
                    return Swal.fire("Error", "No data selected!", "error");
                }
                const confirmation = await Swal.fire({
                    title: "Are you sure?",
                    text: "If you delete under this tags will also be deleted.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!",
                });
                if (confirmation.value) {
                    const url = baseUrl + "/master/price-multi-delete";
                    try {
                        const response = await axios.post(url, { ids: ids });

                        if (!response.data.status) {
                            Swal.fire("Error", response.data.message, "error");
                            return;
                        }

                        Swal.fire("Success", response.data.message, "success");
                        priceTable.ajax.reload();
                    } catch (error) {
                        Swal.fire("Error", error.response.data, "error");
                    }
                }
            },
        },

        {
            extend: "pdf",
            text: lang_PDF,
            exportOptions: {
                columns: ":visible:Not(.not-exported)",
                rows: ":visible",
            },
            title: "Master " + lang_price,
            filename: "Master " + lang_price,
            footer: true,
        },
        {
            extend: "csv",
            text: lang_CSV,
            exportOptions: {
                columns: ":visible:Not(.not-exported)",
                rows: ":visible",
            },
            title: "Master " + lang_price,
            filename: "Master " + lang_price,
            footer: true,
        },
        {
            extend: "print",
            text: lang_print,
            exportOptions: {
                columns: ":visible:Not(.not-exported)",
                rows: ":visible",
            },
            title: "Master " + lang_price,
            filename: "Master " + lang_price,
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
$("#price-datatable tbody").on("click", "button.btn-delete", async function () {
    var tr = $(this).closest("tr");
    var data = priceTable.row(tr).data();
    const confirmation = await Swal.fire({
        title: "Apakah Anda yakin ingin menghapusnya?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
    });

    if (confirmation.value) {
        const url = `${baseUrl}/master/price/${data.id}`;
        try {
            const response = await axios.delete(url);
            const status = response.data.status;
            const msg = response.data.message;

            if (!status) {
                await Swal.fire("Error", msg, "error");
                return;
            }

            Swal.fire("Terhapus!", msg, "success");
            priceTable.ajax.reload();
        } catch (error) {
            Swal.fire("Error", error.response.data, "error");
        }
    }
});
