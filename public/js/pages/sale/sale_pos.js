const $search_box = $(".search_box");
const $search_field = $("#search_field");
let data_products = [];

$(function () {
    // on search product
    $search_field.autocomplete({
        source: function (request, response) {
            $.ajax({
                url: baseUrl + "/sales/searchProducts",
                type: "POST",
                dataType: "json",
                data: {
                    _token: _token,
                    term: request.term,
                },
                success: function (data) {
                    data_products = data;
                    response(data);
                },
                error: function (error) {
                    console.log(error);
                },
            });
        },
        // minLength: 2,
        select: function (event, ui) {
            $search_field.val(ui.item.label);
            return false;
        },
    });
});
