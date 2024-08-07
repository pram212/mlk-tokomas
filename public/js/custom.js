var filterMultiSelect_getJson = function (b) {
    var result = $.fn.filterMultiSelect.applied
        .map((e) => JSON.parse(e.getSelectedOptionsAsJson(b)))
        .reduce((prev, curr) => {
            prev = {
                ...prev,
                ...curr,
            };
            return prev;
        });
    return result;
};
