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

function formatMoney(
    amount,
    {
        lang = "id",
        showSymbol = false,
        currency = "IDR",
        style = "currency",
    } = {}
) {
    let options = {};

    if (showSymbol) {
        options = {
            style: style,
            currency: currency,
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
        };
    }

    return new Intl.NumberFormat(lang, options).format(amount);
}

function formatMoneyToDecimal(value) {
    let string = value.toString().replace(/\./g, "");
    const result = parseFloat(string.replace(/[^0-9.-]+/g, ""));
    return result;
}

// Other Event Bindings
$(".format-money").on("input", handleMoneyFormat);
$(".format-money").on("click", handleMoneyFormatClick);

function handleMoneyFormat() {
    const value = formatMoneyToDecimal($(this).val()) || 0;
    $(this).val(formatMoney(value));
}

function handleMoneyFormatClick() {
    $(this).select();
}
