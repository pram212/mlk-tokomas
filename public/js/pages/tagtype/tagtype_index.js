tagTypeTable = $("#tagtype-datatable").DataTable({
    processing: true,
    serverSide: true,
    ajax: baseUrl + "/product-categories/tagtype-datatable",
    columns: [
        {
            data: "DT_RowIndex",
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
            data: "color",
        },
        {
            data: "action",
        },
        {
            data: "created_at",
            searchable: false,
            visible: false,
        },
    ],
    order: [["5", "desc"]],
    columnDefs: [
        {
            orderable: false,
            targets: [0, 4],
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
                    // return alert("This feature is disable for demo!");
                    Swal.fire(
                        "Failed!",
                        "This feature is disable for demo!",
                        "error"
                    );

                    return;
                }

                ids = [];
                $.each(
                    $(".dt-checkboxes:checked"),
                    function (indexInArray, valueOfElement) {
                        const tr = $(this).closest("tr"); // get the row target
                        const data = tagTypeTable.row(tr).data(); // get detail data
                        if (data !== undefined) ids.push(data.id);
                    }
                );

                if (ids.length < 1) {
                    // return alert("No data selected!");
                    Swal.fire("Failed!", "No data selected!", "error");

                    return;
                }

                // show confirmation alert
                Swal.fire({
                    title: "Are you sure?",
                    text: "Make sure Tag Type is not used in any Product and Price data!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!",
                }).then(async (confirmation) => {
                    // tambahkan async di sini
                    // if user choose true
                    if (confirmation.value) {
                        const url =
                            baseUrl +
                            "/product-categories/tagtype-multi-delete";
                        axios
                            .post(url, {
                                ids: ids,
                            })
                            .then(function (response) {
                                if (response.data.code === 200) {
                                    Swal.fire(
                                        "Deleted!",
                                        response.data.message,
                                        "success"
                                    );
                                    // unchecked all checkboxes
                                    $(".dt-checkboxes").prop("checked", false);
                                    tagTypeTable.ajax.reload();
                                }

                                if (response.data.code === 500) {
                                    Swal.fire(
                                        "Failed!",
                                        response.data.message,
                                        "error"
                                    );
                                }
                            })
                            .catch(function (error) {
                                const errorMessage = error.response.data;
                                Swal.fire("Failed!", errorMessage, "error");
                            });

                        return;
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

$("#tagtype-datatable tbody").on("click", "button.btn-delete", function () {
    var tr = $(this).closest("tr"); // get the row target
    var data = tagTypeTable.row(tr).data(); // get detail data
    // show confirmation alert
    Swal.fire({
        title: "Are you sure?",
        text: "Make sure Tag Type is not used in any Product and Price data!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
    }).then(async (confirmation) => {
        // tambahkan async di sini
        // if user choose true
        if (confirmation.value) {
            // run delete function via ajax
            const url = baseUrl + "/product-categories/tagtype" + "/" + data.id;
            try {
                const response = await axios.delete(url);
                if (response.data.code === 200) {
                    Swal.fire("Deleted!", response.data.message, "success");
                    tagTypeTable.ajax.reload();
                }

                if (response.data.code === 500) {
                    Swal.fire("Failed!", response.data.message, "error");
                }
            } catch (error) {
                const errorMessage = error.response.data;
                Swal.fire("Failed!", errorMessage, "error");
            }
        }
    });
});
