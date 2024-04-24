if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/saleproposmajed/service-worker.js').then(function(registration) {
            // Registration was successful
            console.log('ServiceWorker registration successful with scope: ', registration.scope);
        }, function(err) {
            // registration failed :(
            console.log('ServiceWorker registration failed: ', err);
        });
    });
}

var alert_product = '{!! json_encode($alert_product) !!}';

if ($(window).outerWidth() > 1199) {
    $('nav.side-navbar').removeClass('shrink');
}

function myFunction() {
    setTimeout(showPage, 150);
}

function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("content").style.display = "block";
}

function confirmDelete() {
    if (confirm("Are you sure want to delete?")) {
        return true;
    }
    return false;
}

$("li#notification-icon").on("click", function (argument) {
    $.get('notifications/mark-as-read', function (data) {
        $("span.notification-number").text(alert_product);
    });
});

$("a#add-expense").click(function (e) {
    e.preventDefault();
    $('#expense-modal').modal();
});

$("a#send-notification").click(function (e) {
    e.preventDefault();
    $('#notification-modal').modal();
});

$("a#add-account").click(function (e) {
    e.preventDefault();
    $('#account-modal').modal();
});

$("a#account-statement").click(function (e) {
    e.preventDefault();
    $('#account-statement-modal').modal();
});

$("a#profitLoss-link").click(function (e) {
    e.preventDefault();
    $("#profitLoss-report-form").submit();
});

$("a#report-link").click(function (e) {
    e.preventDefault();
    $("#product-report-form").submit();
});

$("a#purchase-report-link").click(function (e) {
    e.preventDefault();
    $("#purchase-report-form").submit();
});

$("a#sale-report-link").click(function (e) {
    e.preventDefault();
    $("#sale-report-form").submit();
});

$("a#payment-report-link").click(function (e) {
    e.preventDefault();
    $("#payment-report-form").submit();
});

$("a#warehouse-report-link").click(function (e) {
    e.preventDefault();
    $('#warehouse-modal').modal();
});

$("a#user-report-link").click(function (e) {
    e.preventDefault();
    $('#user-modal').modal();
});

$("a#customer-report-link").click(function (e) {
    e.preventDefault();
    $('#customer-modal').modal();
});

$("a#supplier-report-link").click(function (e) {
    e.preventDefault();
    $('#supplier-modal').modal();
});

$("a#due-report-link").click(function (e) {
    e.preventDefault();
    $("#due-report-form").submit();
});

$(".daterangepicker-field").daterangepicker({
    callback: function (startDate, endDate, period) {
        var start_date = startDate.format('YYYY-MM-DD');
        var end_date = endDate.format('YYYY-MM-DD');
        var title = start_date + ' To ' + end_date;
        $(this).val(title);
        $('#account-statement-modal input[name="start_date"]').val(start_date);
        $('#account-statement-modal input[name="end_date"]').val(end_date);
    }
});

$('.selectpicker').selectpicker({
    style: 'btn-link',
});

var amountid = document.getElementById('amountid');
amountid.addEventListener('keyup', function (e) {
    amountid.value = formatRupiah(this.value, 'input');
});
amountid.addEventListener('mouseover', function (e) {
    amountid.value = formatRupiah(this.value, 'input');
});

var initial_balanceid = document.getElementById('initial_balanceid');
initial_balanceid.addEventListener('keyup', function (e) {
    initial_balanceid.value = formatRupiah(this.value, 'input');
});
initial_balanceid.addEventListener('mouseover', function (e) {
    initial_balanceid.value = formatRupiah(this.value, 'input');
});



function formatRupiah(angka, type) {
    var number_string = '';
    var split = '';
    var sisa = '';
    var rupiah = '';
    var ribuan = '';
    if (angka.toString().includes("-")) {
        var reverse = angka.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return "-" + ribuan;
    }
    if (type == 'input') {
        number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(',');
        sisa = split[0].length % 3;
        rupiah = split[0].substr(0, sisa);
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    } else {
        number_string = angka.toString();
        split = number_string.split(',');
        sisa = split[0].length % 3;
        rupiah = split[0].substr(0, sisa);
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    }


    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    // return prefix == undefined || ? rupiah : (rupiah ? '' + rupiah : '');
    return (rupiah);
}