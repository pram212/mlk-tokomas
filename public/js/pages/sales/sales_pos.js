const $credit_card_box = $("#credit_card_box");
const $paid_by_id_select = $('select[name="paid_by_id_select"]');
const $quick_cash_box = $("div.qc");
const $payment_box_left = $("#payment-box-left");
const $select_credit_card_bank = $("#credit_card_bank");
const $hidden_credit_card_bank_id = $("input[name='credit_card_bank_id']");
const $input_digit = $(".digit-input");

$(function () {
    /* Credit Card */
    $credit_card_box.hide();

    $input_digit.each(function () {
        $(this).data("real-value", ""); // Simpan nilai asli
    });

    $input_digit.on("input", function () {
        var $this = $(this);
        var val = $this.val().replace(/\D/g, ""); // Hanya angka

        if (val.length > 4) {
            val = val.slice(0, 4); // Batasi input hingga 4 digit
        }

        $this.data("real-value", val); // Simpan nilai asli

        // Update hidden input value
        var pos = $this.data("pos");
        $("#hidden-credit-card-" + pos).val(val);

        if (val.length === 4) {
            $this.nextAll(".digit-input").first().focus();
        }
    });

    $input_digit.on("keydown", function (e) {
        var $this = $(this);
        var val = $this.data("real-value");

        // Deteksi backspace dan jika input kosong, pindahkan fokus ke input sebelumnya
        if (e.key === "Backspace" && val.length === 0) {
            $this.prevAll(".digit-input").first().focus();
        }
    });

    $input_digit.on("keypress", function (e) {
        var charCode = e.which ? e.which : e.keyCode;
        // Cegah karakter non-angka
        if (charCode < 48 || charCode > 57) {
            e.preventDefault();
        }
    });
    /* End Credit Card */

    /* Bank Id */
    $select_credit_card_bank.on("change", function () {
        const bank_id = $(this).val();
        $hidden_credit_card_bank_id.val(bank_id);
    });
    /* End Bank Id */
});

function validation() {
    const paid_by_id = $paid_by_id_select.val();

    if (!validation_paid_amount()) return false;

    switch (paid_by_id) {
        case "1":
            // Quick Cash
            return true;
            break;
        case "3":
            // Credit Card
            return validation_credit_card();
            break;
        default:
            alert("Metode pembayaran harus dipilih!");
            return false;
    }
}

function validation_paid_amount() {
    const paying_amount = $("#paying_amountid").val();
    const paid_amount = $("#paid_amountid").val();

    if (paying_amount === "" || paying_amount === undefined) {
        alert("Jumlah bayar harus diisi!");
        return false;
    }

    // handle jika paying amount kurang dari paid amount, hilangkan "." dan "," di angka
    const paying_amount_int = parseInt(paying_amount.replace(/[^0-9]/g, ""));
    const paid_amount_int = parseInt(paid_amount.replace(/[^0-9]/g, ""));

    if (paying_amount_int < paid_amount_int) {
        alert("Jumlah bayar tidak boleh kurang dari total tagihan!");
        return false;
    }

    return true;
}

function validation_credit_card() {
    const credit_card_bank = $select_credit_card_bank.val();
    const credit_card_number_1 = $("#hidden-credit-card-1").val();
    const credit_card_number_2 = $("#hidden-credit-card-2").val();
    const credit_card_number_3 = $("#hidden-credit-card-3").val();
    const credit_card_number_4 = $("#hidden-credit-card-4").val();

    if (credit_card_bank === "") {
        alert("Bank kartu kredit harus dipilih!");
        return false;
    }

    if (
        credit_card_number_1 === "" ||
        credit_card_number_2 === "" ||
        credit_card_number_3 === "" ||
        credit_card_number_4 === "" ||
        credit_card_number_1.length < 4 ||
        credit_card_number_2.length < 4 ||
        credit_card_number_3.length < 4 ||
        credit_card_number_4.length < 4
    ) {
        alert("Nomor kartu kredit harus diisi minimal 16 digit!");
        return false;
    }

    return true;
}
