$("ul#product").siblings("a").attr("aria-expanded", "true");
$("ul#product").addClass("show");
$("ul#product #category-menu").addClass("active");

function deleteCategory(category_id) {
    axios
        .delete(baseUrl + "/category/" + category_id)
        .then(function (response) {
            if (response.data.code == 200) {
                Swal.fire("Deleted!", response.data.message, "success");
                category_table.ajax.reload();
            } else {
                Swal.fire("Oops...", response.data.message, "error");
            }
        })
        .catch(function (error) {
            Swal.fire("Oops...", "Something went wrong!", "error");
        });
}

function confirmDeletes(category_id) {
    Swal.fire({
        title: "Are you sure?",
        text: "Make sure category is not used in any product!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.value) {
            deleteCategory(category_id);
        }
    });
}

var category_id = [];

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).on("click", ".open-EditCategoryDialog", function () {
    var url = "category/";
    var id = $(this).data("id").toString();
    url = url.concat(id).concat("/edit");

    $.get(url, function (data) {
        $("#editModal input[name='name']").val(data.name);
        $("#editModal select[name='parent_id']").val(data.parent_id);
        $("#editModal input[name='category_id']").val(data.id);
        $("#edit-category").val(data.category).trigger("change");
        $("#edit-sub_category").val(data.sub_category);
        $(".selectpicker").selectpicker("refresh");
        $("#form-edit").attr(
            "action",
            "{!! url('category') !!}" + "/" + data.id
        );
    });
});

// onclikc btn_trash
// $(btn_trash).on("click", function () {
//     if (modeData.val() === "index") {
//         modeData.val("trash");
//         $(btn_trash_span).text("Back to Category");
//         $(btn_trash).removeClass("btn-danger").addClass("btn-primary");
//     } else {
//         modeData.val("index");
//         $(btn_trash_span).text(lang_trash);
//         $(btn_trash).removeClass("btn-primary").addClass("btn-danger");
//     }

//     category_table.ajax.reload();
// });

var category_table = $("#category-table").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: "category/category-datatable",
        dataType: "json",
        type: "post",
        data: function (d) {
            // d.modeData = modeData.val();
            _token: $('meta[name="csrf-token"]').attr("content");
        },
    },
    createdRow: function (row, data, dataIndex) {
        $(row).attr("data-id", data["id"]);
    },
    columns: [
        {
            data: "id",
        },
        {
            data: "name",
            name: "name",
            render: function (data, type, row) {
                return `<div style="width:200px"><div>${data}</div></div>`;
            },
        },
        {
            data: "created_at",
            searchable: false,
            render: function (data, type, row) {
                let date = moment(data).format("YYYY-MM-DD");
                return `<div style="width:200px"><div>${date}</div></div>`;
            },
        },
        {
            data: "options",
            searchable: false,
            orderable: false,
            render: function (data, type, row) {
                return `<div style="display: flex;width="100px"">${data}</div>`;
            },
        },

        {
            data: "updated_at",
            visible: false,
            searchable: false,
        },
    ],
    language: {
        lengthMenu: `_MENU_ ${lang_records_per_page}`,
        info: `<small>${lang_Showing} _START_ - _END_ (_TOTAL_)</small>`,
        search: `${lang_search}`,
        paginate: {
            previous: '<i class="dripicons-chevron-left"></i>',
            next: '<i class="dripicons-chevron-right"></i>',
        },
    },
    order: [["2", "desc"]],
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
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"],
    ],

    dom: '<"row"lfB>rtip',
    buttons: [
        {
            extend: "pdf",
            text: lang_PDF,
            exportOptions: {
                columns: ":visible:Not(.not-exported)",
                rows: ":visible",
            },
            title: lang_category, // Ubah judul di sini
            filename: lang_category, // Ubah nama file di sini
            footer: true,
        },
        {
            extend: "csv",
            text: lang_CSV,
            exportOptions: {
                columns: ":visible:Not(.not-exported)",
                rows: ":visible",
            },
            title: lang_category, // Ubah judul di sini
            filename: lang_category, // Ubah nama file di sini
            footer: true,
        },
        {
            extend: "print",
            text: lang_print,
            exportOptions: {
                columns: ":visible:Not(.not-exported)",
                rows: ":visible",
            },
            title: lang_category, // Ubah judul di sini

            footer: true,
        },
        {
            text: lang_delete,
            className: "buttons-delete",
            action: function (e, dt, node, config) {
                if (user_verified == "1") {
                    category_id.length = 0;
                    $(":checkbox:checked").each(function (i) {
                        if (i) {
                            category_id[i - 1] = $(this)
                                .closest("tr")
                                .data("id");
                        }
                    });

                    if (category_id.length) {
                        // swall confirm
                        Swal.fire({
                            title: "Are you sure?",
                            text: "Make sure category is not used in any product!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#d33",
                            cancelButtonColor: "#3085d6",
                            confirmButtonText: "Yes, delete it!",
                        }).then((result) => {
                            if (result.value) {
                                axios
                                    .post("category/deletebyselection", {
                                        categoryIdArray: category_id,
                                    })
                                    .then(function (response) {
                                        let msg = response.data.message;
                                        if (response.data.code == 200) {
                                            Swal.fire(
                                                "Deleted!",
                                                msg,
                                                "success"
                                            );

                                            category_table.ajax.reload();
                                            category_id.length = 0;
                                        }

                                        if (response.data.code == 500) {
                                            Swal.fire("Failed!", msg, "error");
                                        }
                                    })
                                    .catch(function (error) {
                                        console.error("Error:", error);
                                        Swal.fire(
                                            "Failed!",
                                            "An error occurred while processing your request.",
                                            "error"
                                        );
                                    });
                            }
                        });
                    } else if (!category_id.length)
                        alert("No category is selected!");
                } else alert("This feature is disable for demo!");
            },
        },
        {
            extend: "colvis",
            text: lang_visibility,
            columns: ":gt(0)",
        },
    ],
});
