const startDate = $("#start_date");
const endDate = $("#end_date");
$(function () {
    startDate
        .datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            orientation: "bottom",
            endDate: endDate.val(),
        })
        .on("changeDate", function (e) {
            endDate.datepicker("setStartDate", e.date);
        });

    endDate
        .datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            orientation: "bottom",
            startDate: startDate.val(),
        })
        .on("changeDate", function (e) {
            startDate.datepicker("setEndDate", e.date);
        });
});
