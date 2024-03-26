<script type="text/javascript">
    $("ul#sale").siblings('a').attr('aria-expanded', 'true');
    $("ul#sale").addClass("show");
    $("ul#sale #sale-pos-menu").addClass("active");

    var public_key = @json($lims_pos_setting_data->stripe_public_key);
    var alert_product = @json($alert_product);
    var currency = @json($currency);
    var valid;

    // array data depend on warehouse
    var lims_product_array = [];
    var product_code = [];
    var product_name = [];
    var product_qty = [];
    var product_type = [];
    var product_id = [];
    var product_list = [];
    var qty_list = [];

    // array data with selection
    var product_price = [];
    var product_discount = [];
    var tax_rate = [];
    var tax_name = [];
    var tax_method = [];
    var unit_name = [];
    var unit_operator = [];
    var unit_operation_value = [];
    var gift_card_amount = [];
    var gift_card_expense = [];

    // temporary array
    var temp_unit_name = [];
    var temp_unit_operator = [];
    var temp_unit_operation_value = [];

    var deposit = @json($deposit);
    var product_row_number = @json($lims_pos_setting_data->product_number);
    var rowindex;
    var customer_group_rate;
    var row_product_price;
    var pos;
    var keyboard_active = @json($keybord_active);
    var role_id = @json(\Auth::user()->role_id);
    var warehouse_id = @json(\Auth::user()->warehouse_id);
    var biller_id = @json(\Auth::user()->biller_id);
    var coupon_list = @json($lims_coupon_list);
    var currency = @json($currency);

    var localStorageQty = [];
    var localStorageProductId = [];
    var localStorageProductDiscount = [];
    var localStorageTaxRate = [];
    var localStorageNetUnitPrice = [];
    var localStorageTaxValue = [];
    var localStorageTaxName = [];
    var localStorageTaxMethod = [];
    var localStorageSubTotalUnit = [];
    var localStorageSubTotal = [];
    var localStorageProductCode = [];
    var localStorageSaleUnit = [];
    var localStorageTempUnitName = [];
    var localStorageSaleUnitOperator = [];
    var localStorageSaleUnitOperationValue = [];

    $("#reference-no").val(getSavedValue("reference-no"));
    $("#order-discount").val(getSavedValue("order-discount"));
    $("#order-tax-rate-select").val(getSavedValue("order-tax-rate-select"));


    $("#shipping-cost-val").val(getSavedValue("shipping-cost-val"));

    if (localStorage.getItem("tbody-id")) {
        $("#tbody-id").html(localStorage.getItem("tbody-id"));
    }

    function saveValue(e) {
        var id = e.id; // get the sender's id to save it.
        var val = e.value; // get the value.
        localStorage.setItem(id, val); // Every time user writing something, the localStorage's value will override.
    }
    //get the saved value function - return the value of "v" from localStorage. 
    function getSavedValue(v) {
        if (!localStorage.getItem(v)) {
            return ""; // You can change this to your defualt value. 
        }
        return localStorage.getItem(v);
    }

    if (getSavedValue("localStorageQty")) {
        localStorageQty = getSavedValue("localStorageQty").split(",");
        localStorageProductDiscount = getSavedValue("localStorageProductDiscount").split(",");
        localStorageTaxRate = getSavedValue("localStorageTaxRate").split(",");
        localStorageNetUnitPrice = getSavedValue("localStorageNetUnitPrice").split(",");
        localStorageTaxValue = getSavedValue("localStorageTaxValue").split(",");
        localStorageTaxName = getSavedValue("localStorageTaxName").split(",");
        localStorageTaxMethod = getSavedValue("localStorageTaxMethod").split(",");
        localStorageSubTotalUnit = getSavedValue("localStorageSubTotalUnit").split(",");
        localStorageSubTotal = getSavedValue("localStorageSubTotal").split(",");
        localStorageProductId = getSavedValue("localStorageProductId").split(",");
        localStorageProductCode = getSavedValue("localStorageProductCode").split(",");
        localStorageSaleUnit = getSavedValue("localStorageSaleUnit").split(",");
        localStorageTempUnitName = getSavedValue("localStorageTempUnitName").split(",,");
        localStorageSaleUnitOperator = getSavedValue("localStorageSaleUnitOperator").split(",,");
        localStorageSaleUnitOperationValue = getSavedValue("localStorageSaleUnitOperationValue").split(",,");
        /*localStorageQty.pop();
        localStorage.setItem("localStorageQty", localStorageQty);*/
        for (var i = 0; i < localStorageQty.length; i++) {
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ') .qty').val(localStorageQty[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.discount-value').val(
                localStorageProductDiscount[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-rate').val(localStorageTaxRate[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.net_unit_price').val(
                localStorageNetUnitPrice[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-value').val(localStorageTaxValue[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-name').val(localStorageTaxName[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-method').val(localStorageTaxMethod[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('td:nth-child(2)').text(
                localStorageSubTotalUnit[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('td:nth-child(4)').text(localStorageSubTotal[
                i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.subtotal-value').val(localStorageSubTotal[
                i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.product-id').val(localStorageProductId[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.product-code').val(localStorageProductCode[
                i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit').val(localStorageSaleUnit[i]);
            if (i == 0) {
                localStorageTempUnitName[i] += ',';
                localStorageSaleUnitOperator[i] += ',';
                localStorageSaleUnitOperationValue[i] += ',';
            }
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit-operator').val(
                localStorageSaleUnitOperator[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit-operation-value').val(
                localStorageSaleUnitOperationValue[i]);

            product_price.push(parseInt($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.product_price')
                .val()));
            var quantity = parseInt($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.qty').val());
            product_discount.push(parseInt(localStorageProductDiscount[i] / localStorageQty[i]));
            tax_rate.push(parseInt($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-rate').val()));
            tax_name.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-name').val());
            tax_method.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-method').val());
            temp_unit_name = $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit').val().split(
                ',');
            unit_name.push(localStorageTempUnitName[i]);
            unit_operator.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit-operator')
                .val());
            unit_operation_value.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find(
                '.sale-unit-operation-value').val());
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit').val(temp_unit_name[0]);
            calculateTotal();
            //calculateRowProductData(localStorageQty[i]);
        }
    }


    $('.selectpicker').selectpicker({
        style: 'btn-link',
    });

    if (keyboard_active == 1) {

        $("input.numkey:text").keyboard({
            usePreview: false,
            layout: 'custom',
            display: {
                'accept': '&#10004;',
                'cancel': '&#10006;'
            },
            customLayout: {
                'normal': ['1 2 3', '4 5 6', '7 8 9', '0 {dec} {bksp}', '{clear} {cancel} {accept}']
            },
            restrictInput: true, // Prevent keys not in the displayed keyboard from being typed in
            preventPaste: true, // prevent ctrl-v and right click
            autoAccept: true,
            css: {
                // input & preview
                // keyboard container
                container: 'center-block dropdown-menu', // jumbotron
                // default state
                buttonDefault: 'btn btn-default',
                // hovered button
                buttonHover: 'btn-primary',
                // Action keys (e.g. Accept, Cancel, Tab, etc);
                // this replaces "actionClass" option
                buttonAction: 'active'
            },
        });

        $('input[type="text"]').keyboard({
            usePreview: false,
            autoAccept: true,
            autoAcceptOnEsc: true,
            css: {
                // input & preview
                // keyboard container
                container: 'center-block dropdown-menu', // jumbotron
                // default state
                buttonDefault: 'btn btn-default',
                // hovered button
                buttonHover: 'btn-primary',
                // Action keys (e.g. Accept, Cancel, Tab, etc);
                // this replaces "actionClass" option
                buttonAction: 'active',
                // used when disabling the decimal button {dec}
                // when a decimal exists in the input area
                buttonDisabled: 'disabled'
            },
            change: function(e, keyboard) {
                keyboard.$el.val(keyboard.$preview.val())
                keyboard.$el.trigger('propertychange')
            }
        });

        $('textarea').keyboard({
            usePreview: false,
            autoAccept: true,
            autoAcceptOnEsc: true,
            css: {
                // input & preview
                // keyboard container
                container: 'center-block dropdown-menu', // jumbotron
                // default state
                buttonDefault: 'btn btn-default',
                // hovered button
                buttonHover: 'btn-primary',
                // Action keys (e.g. Accept, Cancel, Tab, etc);
                // this replaces "actionClass" option
                buttonAction: 'active',
                // used when disabling the decimal button {dec}
                // when a decimal exists in the input area
                buttonDisabled: 'disabled'
            },
            change: function(e, keyboard) {
                keyboard.$el.val(keyboard.$preview.val())
                keyboard.$el.trigger('propertychange')
            }
        });

        $('#lims_productcodeSearch').keyboard().autocomplete().addAutocomplete({
            // add autocomplete window positioning
            // options here (using position utility)
            position: {
                of: '#lims_productcodeSearch',
                my: 'top+18px',
                at: 'center',
                collision: 'flip'
            }
        });
    }

    $("li#notification-icon").on("click", function(argument) {
        $.get('notifications/mark-as-read', function(data) {
            $("span.notification-number").text(alert_product);
        });
    });

    $("#register-details-btn").on("click", function(e) {
        e.preventDefault();
        $.ajax({
            url: 'cash-register/showDetails/' + warehouse_id,
            type: "GET",
            success: function(data) {
                $('#register-details-modal #cash_in_hand').text(data['cash_in_hand']);
                $('#register-details-modal #total_sale_amount').text(data['total_sale_amount']);
                $('#register-details-modal #total_payment').text(data['total_payment']);
                $('#register-details-modal #cash_payment').text(data['cash_payment']);
                $('#register-details-modal #credit_card_payment').text(data['credit_card_payment']);
                $('#register-details-modal #cheque_payment').text(data['cheque_payment']);
                $('#register-details-modal #gift_card_payment').text(data['gift_card_payment']);
                $('#register-details-modal #paypal_payment').text(data['paypal_payment']);
                $('#register-details-modal #total_sale_return').text(data['total_sale_return']);
                $('#register-details-modal #total_expense').text(data['total_expense']);
                $('#register-details-modal #total_cash').text(data['total_cash']);
                $('#register-details-modal input[name=cash_register_id]').val(data['id']);
            }
        });
        $('#register-details-modal').modal('show');
    });

    $("#today-sale-btn").on("click", function(e) {
        e.preventDefault();
        $.ajax({
            url: 'sales/today-sale/',
            type: "GET",
            success: function(data) {
                $('#today-sale-modal .total_sale_amount').text(data['total_sale_amount']);
                $('#today-sale-modal .total_payment').text(data['total_payment']);
                $('#today-sale-modal .cash_payment').text(data['cash_payment']);
                $('#today-sale-modal .credit_card_payment').text(data['credit_card_payment']);
                $('#today-sale-modal .cheque_payment').text(data['cheque_payment']);
                $('#today-sale-modal .gift_card_payment').text(data['gift_card_payment']);
                $('#today-sale-modal .paypal_payment').text(data['paypal_payment']);
                $('#today-sale-modal .total_sale_return').text(data['total_sale_return']);
                $('#today-sale-modal .total_expense').text(data['total_expense']);
                $('#today-sale-modal .total_cash').text(data['total_cash']);
            }
        });
        $('#today-sale-modal').modal('show');
    });

    $("#today-profit-btn").on("click", function(e) {
        e.preventDefault();
        calculateTodayProfit(0);
    });

    $("#today-profit-modal select[name=warehouseId]").on("change", function() {
        calculateTodayProfit($(this).val());
    });

    function calculateTodayProfit(warehouse_id) {
        $.ajax({
            url: 'sales/today-profit/' + warehouse_id,
            type: "GET",
            success: function(data) {
                $('#today-profit-modal .product_revenue').text(data['product_revenue']);
                $('#today-profit-modal .product_cost').text(data['product_cost']);
                $('#today-profit-modal .expense_amount').text(data['expense_amount']);
                $('#today-profit-modal .profit').text(data['profit']);
            }
        });
        $('#today-profit-modal').modal('show');
    }

    if (role_id > 2) {
        $('#biller_id').addClass('d-none');
        $('#warehouse_id').addClass('d-none');
        $('select[name=warehouse_id]').val(warehouse_id);
        $('select[name=biller_id]').val(biller_id);
        isCashRegisterAvailable(warehouse_id);
    } else {
        if (getSavedValue("warehouse_id")) {
            warehouse_id = getSavedValue("warehouse_id");
        } else {
            warehouse_id = $("input[name='warehouse_id_hidden']").val();
        }

        if (getSavedValue("biller_id")) {
            biller_id = getSavedValue("biller_id");
        } else {
            biller_id = $("input[name='biller_id_hidden']").val();
        }
        $('select[name=warehouse_id]').val(warehouse_id);
        $('select[name=biller_id]').val(biller_id);
    }

    if (getSavedValue("biller_id")) {
        $('select[name=customer_id]').val(getSavedValue("customer_id"));
    } else {
        $('select[name=customer_id]').val(parseInt($("input[name='customer_id_hidden']").val()));
    }

    $('.selectpicker').selectpicker('refresh');

    var id = $("#customer_id").val();
    $.get(`{!! url('sales-getcustomergroup/${id}') !!}`, function(data) {
        customer_group_rate = (data / 100);
    });

    var id = $("#warehouse_id").val();
    $.get(`{!! url('sales-getproduct/${id}') !!}`, function(data) {
        lims_product_array = [];
        product_code = data[0];
        product_name = data[1];
        product_qty = data[2];
        product_type = data[3];
        product_id = data[4];
        product_list = data[5];
        qty_list = data[6];
        product_warehouse_price = data[7];
        $.each(product_code, function(index) {
            lims_product_array.push(product_code[index] + ' (' + product_name[index] + ')');
        });
    });

    isCashRegisterAvailable(id);

    function isCashRegisterAvailable(warehouse_id) {
        $.ajax({
            url: `{!! url('cash-register/check-availability/${warehouse_id}') !!}`,
            type: "GET",
            success: function(data) {
                if (data == 'false') {
                    $("#register-details-btn").addClass('d-none');
                    $('#cash-register-modal select[name=warehouse_id]').val(warehouse_id);

                    if (role_id <= 2)
                        $("#cash-register-modal .warehouse-section").removeClass('d-none');
                    else
                        $("#cash-register-modal .warehouse-section").addClass('d-none');

                    $('.selectpicker').selectpicker('refresh');
                    $("#cash-register-modal").modal('show');
                } else
                    $("#register-details-btn").removeClass('d-none');
            }
        });
    }

    if (keyboard_active == 1) {
        $('#lims_productcodeSearch').bind('keyboardChange', function(e, keyboard, el) {
            var customer_id = $('#customer_id').val();
            var warehouse_id = $('select[name="warehouse_id"]').val();
            temp_data = $('#lims_productcodeSearch').val();
            if (!customer_id) {
                $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                alert('Please select Customer!');
            } else if (!warehouse_id) {
                $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                alert('Please select Warehouse!');
            }
        });
    } else {
        $('#lims_productcodeSearch').on('input', function() {
            var customer_id = $('#customer_id').val();
            var warehouse_id = $('#warehouse_id').val();
            temp_data = $('#lims_productcodeSearch').val();
            if (!customer_id) {
                $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                alert('Please select Customer!');
            } else if (!warehouse_id) {
                $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                alert('Please select Warehouse!');
            }

        });
    }

    $("#print-btn").on("click", function() {
        var divToPrint = document.getElementById('sale-details');
        var newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write(
            '<link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap.min.css'); ?>" type="text/css"><style type="text/css">@media print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">' +
            divToPrint.innerHTML + '</body>');
        newWin.document.close();
        setTimeout(function() {
            newWin.close();
        }, 10);
    });

    $('body').on('click', function(e) {
        $('.filter-window').hide('slide', {
            direction: 'right'
        }, 'fast');
    });

    $('#category-filter').on('click', function(e) {
        e.stopPropagation();
        $('.filter-window').show('slide', {
            direction: 'right'
        }, 'fast');
        $('.category').show();
        $('.brand').hide();
    });

    $('.category-img').on('click', function() {
        var category_id = $(this).data('category');
        var brand_id = 0;

        $(".table-container").children().remove();
        $.get('/sales-getproduct/' + category_id + '/' + brand_id, function(data) {
            populateProduct(data);
        });
    });

    $('#brand-filter').on('click', function(e) {
        e.stopPropagation();
        $('.filter-window').show('slide', {
            direction: 'right'
        }, 'fast');
        $('.brand').show();
        $('.category').hide();
    });

    $('.brand-img').on('click', function() {
        var brand_id = $(this).data('brand');
        var category_id = 0;

        $(".table-container").children().remove();
        $.get('/sales-getproduct/' + category_id + '/' + brand_id, function(data) {
            populateProduct(data);
        });
    });

    $('#featured-filter').on('click', function() {
        $(".table-container").children().remove();
        $.get('sales/getfeatured', function(data) {
            populateProduct(data);
        });
    });

    function populateProduct(data) {
        var tableData =
            '<table id="product-table" class="table no-shadow product-list"> <thead class="d-none"> <tr> <th></th> <th></th> <th></th> <th></th> <th></th> </tr></thead> <tbody><tr>';

        if (Object.keys(data).length != 0) {
            $.each(data['name'], function(index) {
                var product_info = data['code'][index] + ' (' + data['name'][index] + ')';
                if (index % 5 == 0 && index != 0)
                    tableData += '</tr><tr><td class="product-img sound-btn" title="' + data['name'][index] +
                    '" data-product = "' + product_info + '"><img  src="public/images/product/' + data['image'][
                        index
                    ] + '" width="100%" /><p>' + data['name'][index] + '</p><span>' + data['code'][index] +
                    '</span></td>';
                else
                    tableData += '<td class="product-img sound-btn" title="' + data['name'][index] +
                    '" data-product = "' + product_info + '"><img  src="public/images/product/' + data['image'][
                        index
                    ] + '" width="100%" /><p>' + data['name'][index] + '</p><span>' + data['code'][index] +
                    '</span></td>';
            });

            if (data['name'].length % 5) {
                var number = 5 - (data['name'].length % 5);
                while (number > 0) {
                    tableData += '<td style="border:none;"></td>';
                    number--;
                }
            }

            tableData += '</tr></tbody></table>';
            $(".table-container").html(tableData);
            $('#product-table').DataTable({
                "order": [],
                'pageLength': product_row_number,
                'language': {
                    'paginate': {
                        'previous': '<i class="fa fa-angle-left"></i>',
                        'next': '<i class="fa fa-angle-right"></i>'
                    }
                },
                dom: 'tp'
            });
            $('table.product-list').hide();
            $('table.product-list').show(500);
        } else {
            tableData += '<td class="text-center">No data avaialable</td></tr></tbody></table>'
            $(".table-container").html(tableData);
        }
    }

    $('select[name="customer_id"]').on('change', function() {
        saveValue(this);
        var id = $(this).val();
        $.get(`{!! url('sales-getcustomergroup/${id}') !!}`, function(data) {
            customer_group_rate = (data / 100);
        });
    });

    $('select[name="biller_id"]').on('change', function() {
        saveValue(this);
    });

    $('select[name="warehouse_id"]').on('change', function() {
        saveValue(this);
        warehouse_id = $(this).val();
        $.get(`{!! url('sales-getproduct/${warehouse_id}') !!}`, function(data) {
            lims_product_array = [];
            product_code = data[0];
            product_name = data[1];
            product_qty = data[2];
            product_type = data[3];
            product_id = data[4];
            product_list = data[5];
            qty_list = data[6];
            product_warehouse_price = data[7];
            $.each(product_code, function(index) {
                lims_product_array.push(product_code[index] + ' (' + product_name[index] + ')');
            });
        });

        isCashRegisterAvailable(warehouse_id);
    });

    var lims_productcodeSearch = $('#lims_productcodeSearch');

    lims_productcodeSearch.autocomplete({
        source: function(request, response) {
            var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(lims_product_array, function(item) {
                return matcher.test(item);
            }));
        },
        response: function(event, ui) {
            if (ui.content.length == 1) {
                var data = ui.content[0].value;
                $(this).autocomplete("close");
                productSearch(data);
            };
        },
        select: function(event, ui) {
            var data = ui.item.value;
            productSearch(data);
        },
    });

    $('#myTable').keyboard({
        accepted: function(event, keyboard, el) {
            checkQuantity(el.value, true);
        }
    });

    $("#myTable").on('click', '.plus', function() {
        rowindex = $(this).closest('tr').index();
        var qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val();

        if (!qty)
            qty = 1;
        else
            qty = parseInt(qty) + 1;

        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);
        checkQuantity(String(qty), true);
        localStorage.setItem("tbody-id", $("table.order-list tbody").html());
    });

    $("#myTable").on('click', '.minus', function() {
        rowindex = $(this).closest('tr').index();
        var qty = parseInt($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val()) - 1;
        if (qty > 0) {
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);
        } else {
            qty = 1;
        }
        checkQuantity(String(qty), true);
    });

    //Change quantity
    $("#myTable").on('input', '.qty', function() {
        rowindex = $(this).closest('tr').index();
        if ($(this).val() < 0 && $(this).val() != '') {
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(1);
            alert("Quantity can't be less than 0");
        }
        checkQuantity($(this).val(), true);
    });

    $("#myTable").on('click', '.qty', function() {
        rowindex = $(this).closest('tr').index();
    });

    $(document).on('click', '.sound-btn', function() {
        var audio = $("#mysoundclip1")[0];
        audio.play();
    });

    $(document).on('click', '.product-img', function() {
        var customer_id = $('#customer_id').val();
        var warehouse_id = $('select[name="warehouse_id"]').val();
        if (!customer_id)
            alert('Please select Customer!');
        else if (!warehouse_id)
            alert('Please select Warehouse!');
        else {
            var data = $(this).data('product');
            data = data.split(" ");
            pos = product_code.indexOf(data[0]);
            if (pos < 0)
                alert('Product is not avaialable in the selected warehouse');
            else {
                productSearch(data[0]);
            }
        }
    });
    //Delete product
    $("table.order-list tbody").on("click", ".ibtnDel", function(event) {
        var audio = $("#mysoundclip2")[0];
        audio.play();
        rowindex = $(this).closest('tr').index();
        product_price.splice(rowindex, 1);
        product_discount.splice(rowindex, 1);
        tax_rate.splice(rowindex, 1);
        tax_name.splice(rowindex, 1);
        tax_method.splice(rowindex, 1);
        unit_name.splice(rowindex, 1);
        unit_operator.splice(rowindex, 1);
        unit_operation_value.splice(rowindex, 1);

        localStorageProductId.splice(rowindex, 1);
        localStorageQty.splice(rowindex, 1);
        localStorageSaleUnit.splice(rowindex, 1);
        localStorageProductDiscount.splice(rowindex, 1);
        localStorageTaxRate.splice(rowindex, 1);
        localStorageNetUnitPrice.splice(rowindex, 1);
        localStorageTaxValue.splice(rowindex, 1);
        localStorageSubTotalUnit.splice(rowindex, 1);
        localStorageSubTotal.splice(rowindex, 1);
        localStorageProductCode.splice(rowindex, 1);

        localStorageTaxName.splice(rowindex, 1);
        localStorageTaxMethod.splice(rowindex, 1);
        localStorageTempUnitName.splice(rowindex, 1);
        localStorageSaleUnitOperator.splice(rowindex, 1);
        localStorageSaleUnitOperationValue.splice(rowindex, 1);

        localStorage.setItem("localStorageProductId", localStorageProductId);
        localStorage.setItem("localStorageQty", localStorageQty);
        localStorage.setItem("localStorageSaleUnit", localStorageSaleUnit);
        localStorage.setItem("localStorageProductCode", localStorageProductCode);
        localStorage.setItem("localStorageProductDiscount", localStorageProductDiscount);
        localStorage.setItem("localStorageTaxRate", localStorageTaxRate);
        localStorage.setItem("localStorageTaxName", localStorageTaxName);
        localStorage.setItem("localStorageTaxMethod", localStorageTaxMethod);
        localStorage.setItem("localStorageTempUnitName", localStorageTempUnitName);
        localStorage.setItem("localStorageSaleUnitOperator", localStorageSaleUnitOperator);
        localStorage.setItem("localStorageSaleUnitOperationValue", localStorageSaleUnitOperationValue);
        localStorage.setItem("localStorageNetUnitPrice", localStorageNetUnitPrice);
        localStorage.setItem("localStorageTaxValue", localStorageTaxValue);
        localStorage.setItem("localStorageSubTotalUnit", localStorageSubTotalUnit);
        localStorage.setItem("localStorageSubTotal", localStorageSubTotal);

        $(this).closest("tr").remove();
        localStorage.setItem("tbody-id", $("table.order-list tbody").html());
        calculateTotal();
    });

    //Edit product
    $("table.order-list").on("click", ".edit-product", function() {
        rowindex = $(this).closest('tr').index();
        edit();
    });

    //Update product
    $('button[name="update_btn"]').on("click", function() {
        var edit_discount = $('input[name="edit_discount"]').val();
        var edit_qty = $('input[name="edit_qty"]').val();
        var edit_unit_price = $('input[name="edit_unit_price"]').val();

        if (parseInt(edit_discount.replaceAll('.', '') == '' ? 0 : edit_discount.replaceAll('.', '')) >
            parseInt(edit_unit_price.replaceAll('.', '') == '' ? 0 : edit_unit_price.replaceAll('.', ''))) {
            alert('Invalid Discount Input!');
            return;
        }

        if (edit_qty < 1) {
            $('input[name="edit_qty"]').val(1);
            edit_qty = 1;
            alert("Quantity can't be less than 1");
        }

        var tax_rate_all = @json($tax_rate_all);

        tax_rate[rowindex] = localStorageTaxRate[rowindex] = parseInt(tax_rate_all[$(
            'select[name="edit_tax_rate"]').val()]);
        tax_name[rowindex] = localStorageTaxName[rowindex] = $('select[name="edit_tax_rate"] option:selected')
            .text();

        product_discount[rowindex] = parseInt($('input[name="edit_discount"]').val().replaceAll('.', '') == '' ?
            0 : $('input[name="edit_discount"]').val().replaceAll('.', ''));
        if (product_type[pos] == 'standard') {
            var row_unit_operator = unit_operator[rowindex].slice(0, unit_operator[rowindex].indexOf(","));
            var row_unit_operation_value = unit_operation_value[rowindex].slice(0, unit_operation_value[
                rowindex].indexOf(","));
            if (row_unit_operator == '*') {
                product_price[rowindex] = parseInt($('input[name="edit_unit_price"]').val().replaceAll('.',
                        '') == '' ? 0 : $('input[name="edit_unit_price"]').val().replaceAll('.', '')) /
                    row_unit_operation_value;
            } else {
                product_price[rowindex] = parseInt($('input[name="edit_unit_price"]').val().replaceAll('.',
                        '') == '' ? 0 : $('input[name="edit_unit_price"]').val().replaceAll('.', '')) *
                    row_unit_operation_value;
            }
            var position = $('select[name="edit_unit"]').val();
            var temp_operator = temp_unit_operator[position];
            var temp_operation_value = temp_unit_operation_value[position];
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.sale-unit').val(
                temp_unit_name[position]);
            temp_unit_name.splice(position, 1);
            temp_unit_operator.splice(position, 1);
            temp_unit_operation_value.splice(position, 1);

            temp_unit_name.unshift($('select[name="edit_unit"] option:selected').text());
            temp_unit_operator.unshift(temp_operator);
            temp_unit_operation_value.unshift(temp_operation_value);

            unit_name[rowindex] = localStorageTempUnitName[rowindex] = temp_unit_name.toString() + ',';
            unit_operator[rowindex] = localStorageSaleUnitOperator[rowindex] = temp_unit_operator.toString() +
                ',';
            unit_operation_value[rowindex] = localStorageSaleUnitOperationValue[rowindex] =
                temp_unit_operation_value.toString() + ',';

            localStorage.setItem("localStorageTaxRate", localStorageTaxRate);
            localStorage.setItem("localStorageTaxName", localStorageTaxName);
            localStorage.setItem("localStorageTempUnitName", localStorageTempUnitName);
            localStorage.setItem("localStorageSaleUnitOperator", localStorageSaleUnitOperator);
            localStorage.setItem("localStorageSaleUnitOperationValue", localStorageSaleUnitOperationValue);
        } else {
            product_price[rowindex] = parseInt($('input[name="edit_unit_price"]').val().replaceAll('.', '') ==
                '' ? 0 : $('input[name="edit_unit_price"]').val().replaceAll('.', ''));
        }
        checkQuantity(edit_qty, false);
    });

    $('button[name="order_discount_btn"]').on("click", function() {
        calculateGrandTotal();
    });

    $('button[name="shipping_cost_btn"]').on("click", function() {
        calculateGrandTotal();
    });

    $('button[name="order_tax_btn"]').on("click", function() {
        calculateGrandTotal();
    });

    $(".coupon-check").on("click", function() {
        couponDiscount();
    });

    $(".payment-btn").on("click", function() {
        var audio = $("#mysoundclip2")[0];
        audio.play();
        $('input[name="paid_amount"]').val(parseInt($("#grand-total").text().replaceAll('.', '') == '' ? 0 : $(
            "#grand-total").text().replaceAll('.', '')));
        $('input[name="paying_amount"]').val(parseInt($("#grand-total").text().replaceAll('.', '') == '' ? 0 :
            $("#grand-total").text().replaceAll('.', '')));
        $("#change").text(0);
        $('.qc').data('initial', 1);
    });

    $("#draft-btn").on("click", function() {
        var audio = $("#mysoundclip2")[0];
        audio.play();
        $('input[name="sale_status"]').val(3);
        $('input[name="paying_amount"]').prop('required', false);
        $('input[name="paid_amount"]').prop('required', false);
        var rownumber = $('table.order-list tbody tr:last').index();
        if (rownumber < 0) {
            alert("Please insert product to order table!")
        } else
            $('.payment-form').submit();
    });

    $("#submit-btn").on("click", function() {
        $('.payment-form').submit();
    });

    $("#gift-card-btn").on("click", function() {
        $('select[name="paid_by_id_select"]').val(2);
        $('.selectpicker').selectpicker('refresh');
        $('div.qc').hide();
        giftCard();
    });

    $("#credit-card-btn").on("click", function() {
        $('select[name="paid_by_id_select"]').val(3);
        $('.selectpicker').selectpicker('refresh');
        $('div.qc').hide();
        creditCard();
    });

    $("#cheque-btn").on("click", function() {
        $('select[name="paid_by_id_select"]').val(4);
        $('.selectpicker').selectpicker('refresh');
        $('div.qc').hide();
        cheque();
    });

    $("#cash-btn").on("click", function() {
        $('select[name="paid_by_id_select"]').val(1);
        $('.selectpicker').selectpicker('refresh');
        $('div.qc').show();
        hide();
    });

    $("#paypal-btn").on("click", function() {
        $('select[name="paid_by_id_select"]').val(5);
        $('.selectpicker').selectpicker('refresh');
        $('div.qc').hide();
        hide();
    });

    $("#deposit-btn").on("click", function() {
        $('select[name="paid_by_id_select"]').val(6);
        $('.selectpicker').selectpicker('refresh');
        $('div.qc').hide();
        hide();
        deposits();
    });

    $('select[name="paid_by_id_select"]').on("change", function() {
        var id = $(this).val();
        $(".payment-form").off("submit");
        if (id == 2) {
            $('div.qc').hide();
            giftCard();
        } else if (id == 3) {
            $('div.qc').hide();
            creditCard();
        } else if (id == 4) {
            $('div.qc').hide();
            cheque();
        } else {
            hide();
            if (id == 1)
                $('div.qc').show();
            else if (id == 6) {
                $('div.qc').hide();
                deposits();
            }
        }
    });

    $('#add-payment select[name="gift_card_id_select"]').on("change", function() {
        var balance = gift_card_amount[parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val()
            .replaceAll('.', ''))] - gift_card_expense[parseInt($(this).val().replaceAll('.', '') == '' ?
            0 : $(this).val().replaceAll('.', ''))];
        $('#add-payment input[name="gift_card_id"]').val(parseInt($(this).val()));
        if (parseInt($('input[name="paid_amount"]').val().replaceAll('.', '') == '' ? 0 : $(
                'input[name="paid_amount"]').val().replaceAll('.', '')) > balance) {
            alert('Amount exceeds card balance! Gift Card balance: ' + balance);
        }
    });

    $('#add-payment input[name="paying_amount"]').on("input", function() {
        change(parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', '')),
            parseInt($('input[name="paid_amount"]').val().replaceAll('.', '') == '' ? 0 : $(
                'input[name="paid_amount"]').val().replaceAll('.', '')));
    });

    $('input[name="paid_amount"]').on("input", function() {
        if (parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', '')) >
            parseInt($('input[name="paying_amount"]').val().replaceAll('.', '') == '' ? 0 : $(
                'input[name="paying_amount"]').val().replaceAll('.', ''))) {
            alert('Paying amount cannot be bigger than recieved amount');
            $(this).val('');
        } else if (parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', '')) >
            parseInt($('#grand-total').text().replaceAll('.', '') == '' ? 0 : $('#grand-total').text()
                .replaceAll('.', ''))) {
            alert('Paying amount cannot be bigger than grand total');
            $(this).val('');
        }

        change(parseInt($('input[name="paying_amount"]').val().replaceAll('.', '') == '' ? 0 : $(
            'input[name="paying_amount"]').val().replaceAll('.', '')), parseInt($(this).val()
            .replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', '')));
        var id = $('select[name="paid_by_id_select"]').val();
        if (id == 2) {
            var balance = gift_card_amount[parseInt($("#gift_card_id_select").val().replaceAll('.', '') == '' ?
                0 : $("#gift_card_id_select").val().replaceAll('.', ''))] - gift_card_expense[parseInt($(
                "#gift_card_id_select").val().replaceAll('.', '') == '' ? 0 : $(
                "#gift_card_id_select").val().replaceAll('.', ''))];
            if (parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.', '')) >
                balance)
                alert('Amount exceeds card balance! Gift Card balance: ' + balance);
        } else if (id == 6) {
            if (parseInt($('input[name="paid_amount"]').val().replaceAll('.', '') == '' ? 0 : $(
                    'input[name="paid_amount"]').val().replaceAll('.', '')) > deposit[parseInt($('#customer_id')
                    .val().replaceAll('.', '') == '' ? 0 : $('#customer_id').val().replaceAll('.', ''))])
                alert('Amount exceeds customer deposit! Customer deposit : ' + deposit[parseInt($(
                        '#customer_id').val().replaceAll('.', '') == '' ? 0 : $('#customer_id').val()
                    .replaceAll('.', ''))]);
        }
    });

    $('.transaction-btn-plus').on("click", function() {
        $(this).addClass('d-none');
        $('.transaction-btn-close').removeClass('d-none');
    });

    $('.transaction-btn-close').on("click", function() {
        $(this).addClass('d-none');
        $('.transaction-btn-plus').removeClass('d-none');
    });

    $('.coupon-btn-plus').on("click", function() {
        $(this).addClass('d-none');
        $('.coupon-btn-close').removeClass('d-none');
    });

    $('.coupon-btn-close').on("click", function() {
        $(this).addClass('d-none');
        $('.coupon-btn-plus').removeClass('d-none');
    });

    $(document).on('click', '.qc-btn', function(e) {
        if ($(this).data('amount')) {
            if ($('.qc').data('initial')) {
                $('input[name="paying_amount"]').val(parseInt($(this).data('amount')));
                $('.qc').data('initial', 0);
            } else {
                $('input[name="paying_amount"]').val((parseInt($('input[name="paying_amount"]').val()
                    .replaceAll('.', '') == '' ? 0 : $('input[name="paying_amount"]').val()
                    .replaceAll('.', '')) + parseInt($(this).data('amount'))));
            }
        } else
            $('input[name="paying_amount"]').val('0');

        change(parseInt($('input[name="paying_amount"]').val().replaceAll('.', '') == '' ? 0 : $(
            'input[name="paying_amount"]').val().replaceAll('.', '')), parseInt($(
            'input[name="paid_amount"]').val().replaceAll('.', '') == '' ? 0 : $(
            'input[name="paid_amount"]').val().replaceAll('.', '')));
    });

    function change(paying_amount, paid_amount) {

        $("#change").text(formatRupiah(parseInt(paying_amount) - parseInt(paid_amount)));
    }

    function confirmDelete() {
        if (confirm("Are you sure want to delete?")) {
            return true;
        }
        return false;
    }

    function productSearch(data) {
        $.ajax({
            type: 'GET',
            url: '{!! url('sales-lims_product_search') !!}',
            data: {
                data: data
            },
            success: function(data) {
                var flag = 1;
                $(".product-code").each(function(i) {
                    if ($(this).val() == data[1]) {
                        rowindex = i;
                        var pre_qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) +
                            ') .qty').val();
                        if (pre_qty)
                            var qty = parseInt(pre_qty) + 1;
                        else
                            var qty = 1;
                        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(
                            qty);
                        flag = 0;
                        checkQuantity(String(qty), true);
                        flag = 0;
                        localStorage.setItem("tbody-id", $("table.order-list tbody").html());
                    }
                });
                $("input[name='product_code_name']").val('');
                if (flag) {
                    addNewProduct(data);
                }
            }
        });
    }

    function addNewProduct(data) {
        var newRow = $("<tr>");
        var cols = '';
        temp_unit_name = (data[6]).split(',');
        cols +=
            '<td class="col-sm-4 product-title"><button type="button" class="edit-product btn btn-link" data-toggle="modal" data-target="#editModal"><strong>' +
            data[0] + '</strong></button> [' + data[1] + '] <p>In Stock: <span class="in-stock"></span></p></td>';
        cols += '<td class="col-sm-2 product-price"></td>';
        cols +=
            '<td class="col-sm-3"><div class="input-group"><span class="input-group-btn"><button type="button" class="btn btn-default minus"><span class="dripicons-minus"></span></button></span><input type="text" name="qty[]" class="form-control qty numkey input-number" step="any" required><span class="input-group-btn"><button type="button" class="btn btn-default plus"><span class="dripicons-plus"></span></button></span></div></td>';
        cols += '<td class="col-sm-2 sub-total"></td>';
        cols +=
            '<td class="col-sm-1"><button type="button" class="ibtnDel btn btn-danger btn-sm"><i class="dripicons-cross"></i></button></td>';
        cols += '<input type="hidden" class="product-code" name="product_code[]" value="' + data[1] + '"/>';
        cols += '<input type="hidden" class="product-id" name="product_id[]" value="' + data[9] + '"/>';
        cols += '<input type="hidden" class="product_price" />';
        cols += '<input type="hidden" class="sale-unit" name="sale_unit[]" value="' + temp_unit_name[0] + '"/>';
        cols += '<input type="hidden" class="net_unit_price" name="net_unit_price[]" />';
        cols += '<input type="hidden" class="discount-value" name="discount[]" />';
        cols += '<input type="hidden" class="tax-rate" name="tax_rate[]" value="' + data[3] + '"/>';
        cols += '<input type="hidden" class="tax-value" name="tax[]" />';
        cols += '<input type="hidden" class="tax-name" value="' + data[4] + '" />';
        cols += '<input type="hidden" class="tax-method" value="' + data[5] + '" />';
        cols += '<input type="hidden" class="sale-unit-operator" value="' + data[7] + '" />';
        cols += '<input type="hidden" class="sale-unit-operation-value" value="' + data[8] + '" />';
        cols += '<input type="hidden" class="subtotal-value" name="subtotal[]" />';

        newRow.append(cols);
        if (keyboard_active == 1) {
            $("table.order-list tbody").prepend(newRow).find('.qty').keyboard({
                usePreview: false,
                layout: 'custom',
                display: {
                    'accept': '&#10004;',
                    'cancel': '&#10006;'
                },
                customLayout: {
                    'normal': ['1 2 3', '4 5 6', '7 8 9', '0 {dec} {bksp}', '{clear} {cancel} {accept}']
                },
                restrictInput: true,
                preventPaste: true,
                autoAccept: true,
                css: {
                    container: 'center-block dropdown-menu',
                    buttonDefault: 'btn btn-default',
                    buttonHover: 'btn-primary',
                    buttonAction: 'active',
                    buttonDisabled: 'disabled'
                },
            });
        } else
            $("table.order-list tbody").prepend(newRow);

        rowindex = newRow.index();
        pos = product_code.indexOf(data[1]);
        if (!data[11] && product_warehouse_price[pos]) {
            product_price.splice(rowindex, 0, parseInt(parseInt(product_warehouse_price[pos].replaceAll('.', '') == '' ?
                0 : product_warehouse_price[pos].replaceAll('.', '')) * currency['exchange_rate']) + parseInt(
                product_warehouse_price[pos] * parseInt(currency['exchange_rate']) * parseInt(
                    customer_group_rate)));
        } else {
            product_price.splice(rowindex, 0, parseInt(parseInt(data[2]) * currency['exchange_rate']) + parseInt(
                parseInt(data[2]) * currency['exchange_rate'] * parseInt(customer_group_rate)));
        }
        product_discount.splice(rowindex, 0, '0');
        tax_rate.splice(rowindex, 0, parseInt(data[3]));
        tax_name.splice(rowindex, 0, data[4]);
        tax_method.splice(rowindex, 0, data[5]);
        unit_name.splice(rowindex, 0, data[6]);
        unit_operator.splice(rowindex, 0, data[7]);
        unit_operation_value.splice(rowindex, 0, data[8]);
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(1);
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product_price').val(parseInt(
            product_price[rowindex]));
        localStorageQty.splice(rowindex, 0, 1);
        localStorageProductId.splice(rowindex, 0, data[9]);
        localStorageProductCode.splice(rowindex, 0, data[1]);
        localStorageSaleUnit.splice(rowindex, 0, temp_unit_name[0]);
        localStorageProductDiscount.splice(rowindex, 0, parseInt(product_discount[rowindex]));
        localStorageTaxRate.splice(rowindex, 0, parseInt(tax_rate[rowindex]));
        localStorageTaxName.splice(rowindex, 0, data[4]);
        localStorageTaxMethod.splice(rowindex, 0, data[5]);
        localStorageTempUnitName.splice(rowindex, 0, data[6]);
        localStorageSaleUnitOperator.splice(rowindex, 0, data[7]);
        localStorageSaleUnitOperationValue.splice(rowindex, 0, data[8]);
        //put some dummy value
        localStorageNetUnitPrice.splice(rowindex, 0, '0');
        localStorageTaxValue.splice(rowindex, 0, '0');
        localStorageSubTotalUnit.splice(rowindex, 0, '0');
        localStorageSubTotal.splice(rowindex, 0, '0');

        localStorage.setItem("localStorageProductId", localStorageProductId);
        localStorage.setItem("localStorageSaleUnit", localStorageSaleUnit);
        localStorage.setItem("localStorageProductCode", localStorageProductCode);
        localStorage.setItem("localStorageTaxName", localStorageTaxName);
        localStorage.setItem("localStorageTaxMethod", localStorageTaxMethod);
        localStorage.setItem("localStorageTempUnitName", localStorageTempUnitName);
        localStorage.setItem("localStorageSaleUnitOperator", localStorageSaleUnitOperator);
        localStorage.setItem("localStorageSaleUnitOperationValue", localStorageSaleUnitOperationValue);
        checkQuantity(1, true);
        localStorage.setItem("tbody-id", $("table.order-list tbody").html());
    }

    function edit() {
        var row_product_name_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find(
            'td:nth-child(1)').text();
        $('#modal_header').text(row_product_name_code);

        var qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val();
        $('input[name="edit_qty"]').val(qty);

        $('input[name="edit_discount"]').val(parseInt(product_discount[rowindex]));

        var tax_name_all = @json($tax_name_all);
        pos = tax_name_all.indexOf(tax_name[rowindex]);
        $('select[name="edit_tax_rate"]').val(pos);

        var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-code')
            .val();
        pos = product_code.indexOf(row_product_code);
        if (product_type[pos] == 'standard') {
            unitConversion();
            temp_unit_name = (unit_name[rowindex]).split(',');
            temp_unit_name.pop();
            temp_unit_operator = (unit_operator[rowindex]).split(',');
            temp_unit_operator.pop();
            temp_unit_operation_value = (unit_operation_value[rowindex]).split(',');
            temp_unit_operation_value.pop();
            $('select[name="edit_unit"]').empty();
            $.each(temp_unit_name, function(key, value) {
                $('select[name="edit_unit"]').append('<option value="' + key + '">' + value + '</option>');
            });
            $("#edit_unit").show();
        } else {
            row_product_price = parseInt(product_price[rowindex]);
            $("#edit_unit").hide();
        }
        $('input[name="edit_unit_price"]').val(parseInt(row_product_price));
        $('.selectpicker').selectpicker('refresh');
    }

    function couponDiscount() {
        var rownumber = $('table.order-list tbody tr:last').index();
        if (rownumber < 0) {
            alert("Please insert product to order table!")
        } else if ($("#coupon-code").val() != '') {
            valid = 0;
            $.each(coupon_list, function(key, value) {
                if ($("#coupon-code").val() == value['code']) {
                    valid = 1;
                    todyDate = @json(date('Y-m-d'));
                    if (parseInt(value['quantity']) <= parseInt(value['used']))
                        alert('This Coupon is no longer available');
                    else if (todyDate > value['expired_date'])
                        alert('This Coupon has expired!');
                    else if (value['type'] == 'fixed') {
                        if (parseInt($('input[name="grand_total"]').val().replaceAll('.', '') == '' ? 0 : $(
                                'input[name="grand_total"]').val().replaceAll('.', '')) >= parseInt(value[
                                'minimum_amount'])) {
                            $('input[name="grand_total"]').val(parseInt($('input[name="grand_total"]').val()
                                .replaceAll('.', '') == '' ? 0 : $('input[name="grand_total"]').val()
                                .replaceAll('.', '')) - parseInt(value['amount']));
                            $('#grand-total').text(formatRupiah($('input[name="grand_total"]').val().replaceAll(
                                    '.', '') == '' ? 0 : $('input[name="grand_total"]').val()
                                .replaceAll('.', '')));
                            if (!$('input[name="coupon_active"]').val())
                                alert('Congratulation! You got Rp ' + formatRupiah(value['amount']) +
                                    ' discount');
                            $(".coupon-check").prop("disabled", true);
                            $("#coupon-code").prop("disabled", true);
                            $('input[name="coupon_active"]').val(1);
                            $("#coupon-modal").modal('hide');
                            $('input[name="coupon_id"]').val(value['id']);
                            $('input[name="coupon_discount"]').val(parseInt(value['amount']));
                            $('#coupon-text').text(formatRupiah(value['amount']));
                        } else
                            alert('Grand Total is not sufficient for discount! Required Rp ' + formatRupiah(
                                value['minimum_amount']));
                    } else {
                        var grand_total = parseInt($('input[name="grand_total"]').val().replaceAll('.', '') ==
                            '' ? 0 : $('input[name="grand_total"]').val().replaceAll('.', ''));
                        var coupon_discount = grand_total * (parseInt(value['amount']) / 100);
                        grand_total = grand_total - coupon_discount;
                        $('input[name="grand_total"]').val(parseInt(grand_total));
                        $('#grand-total').text(parseInt(grand_total));
                        if (!$('input[name="coupon_active"]').val())
                            alert('Congratulation! You got Rp ' + formatRupiah(value['amount']) + '% discount');
                        $(".coupon-check").prop("disabled", true);
                        $("#coupon-code").prop("disabled", true);
                        $('input[name="coupon_active"]').val(1);
                        $("#coupon-modal").modal('hide');
                        $('input[name="coupon_id"]').val(value['id']);
                        $('input[name="coupon_discount"]').val(parseInt(coupon_discount));
                        $('#coupon-text').text(formatRupiah(coupon_discount));
                    }
                }
            });
            if (!valid)
                alert('Invalid coupon code!');
        }
    }

    function checkQuantity(sale_qty, flag) {
        var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-code')
            .val();
        pos = product_code.indexOf(row_product_code);
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.in-stock').text(product_qty[pos]);
        localStorageQty[rowindex] = sale_qty;
        localStorage.setItem("localStorageQty", localStorageQty);
        if (product_type[pos] == 'standard') {
            var operator = unit_operator[rowindex].split(',');
            var operation_value = unit_operation_value[rowindex].split(',');
            if (operator[0] == '*')
                total_qty = sale_qty * operation_value[0];
            else if (operator[0] == '/')
                total_qty = sale_qty / operation_value[0];
            if (total_qty > parseInt(product_qty[pos])) {
                alert('Quantity exceeds stock quantity!');
                if (flag) {
                    sale_qty = sale_qty.substring(0, sale_qty.length - 1);
                    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
                    localStorageQty[rowindex] = sale_qty;
                    localStorage.setItem("localStorageQty", localStorageQty);
                    checkQuantity(sale_qty, true);
                } else {
                    localStorageQty[rowindex] = sale_qty;
                    localStorage.setItem("localStorageQty", localStorageQty);
                    edit();
                    return;
                }
            }
        } else if (product_type[pos] == 'combo') {
            child_id = product_list[pos].split(',');
            child_qty = qty_list[pos].split(',');
            $(child_id).each(function(index) {
                var position = product_id.indexOf(parseInt(child_id[index]));
                if (parseInt(sale_qty * child_qty[index]) > parseInt(product_qty[position])) {
                    alert('Quantity exceeds stock quantity!');
                    if (flag) {
                        sale_qty = sale_qty.substring(0, sale_qty.length - 1);
                        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(
                            sale_qty);
                    } else {
                        edit();
                        flag = true;
                        return false;
                    }
                }
            });
        }

        if (!flag) {
            $('#editModal').modal('hide');
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
        }
        calculateRowProductData(sale_qty);

    }

    function unitConversion() {
        var row_unit_operator = unit_operator[rowindex].slice(0, unit_operator[rowindex].indexOf(","));
        var row_unit_operation_value = unit_operation_value[rowindex].slice(0, unit_operation_value[rowindex].indexOf(
            ","));

        if (row_unit_operator == '*') {
            row_product_price = parseInt(product_price[rowindex]) * row_unit_operation_value;
        } else {
            row_product_price = parseInt(product_price[rowindex]) / row_unit_operation_value;
        }
    }

    function calculateRowProductData(quantity) {
        if (product_type[pos] == 'standard')
            unitConversion();
        else
            row_product_price = parseInt(product_price[rowindex]);

        if (tax_method[rowindex] == 1) {
            var net_unit_price = parseInt(row_product_price) - parseInt(product_discount[rowindex]);
            var tax = net_unit_price * quantity * (tax_rate[rowindex] / 100);
            var sub_total = (net_unit_price * quantity) + tax;

            if (parseInt(quantity))
                var sub_total_unit = sub_total / quantity;
            else
                var sub_total_unit = sub_total;
        } else {
            var sub_total_unit = parseInt(row_product_price) - parseInt(product_discount[rowindex]);
            var net_unit_price = (100 / (100 + tax_rate[rowindex])) * sub_total_unit;
            var tax = (sub_total_unit - net_unit_price) * quantity;
            var sub_total = sub_total_unit * quantity;
        }

        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.discount-value').val(parseInt(
            product_discount[rowindex] * quantity));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-rate').val(parseInt(tax_rate[
            rowindex]));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_price').val(parseInt(
            net_unit_price));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-value').val(parseInt(tax));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text(formatRupiah(
            sub_total_unit));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(4)').text(formatRupiah(
            sub_total));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.subtotal-value').val(parseInt(
            sub_total));

        localStorageProductDiscount.splice(rowindex, 1, (parseInt(product_discount[rowindex]) * quantity));
        localStorageTaxRate.splice(rowindex, 1, parseInt(tax_rate[rowindex]));
        localStorageNetUnitPrice.splice(rowindex, 1, parseInt(net_unit_price));
        localStorageTaxValue.splice(rowindex, 1, parseInt(tax));
        localStorageSubTotalUnit.splice(rowindex, 1, parseInt(sub_total_unit));
        localStorageSubTotal.splice(rowindex, 1, parseInt(sub_total));
        console.log(localStorageNetUnitPrice);

        localStorage.setItem("localStorageProductDiscount", localStorageProductDiscount);
        localStorage.setItem("localStorageTaxRate", localStorageTaxRate);
        localStorage.setItem("localStorageNetUnitPrice", localStorageNetUnitPrice);
        localStorage.setItem("localStorageTaxValue", localStorageTaxValue);
        localStorage.setItem("localStorageSubTotalUnit", localStorageSubTotalUnit);
        localStorage.setItem("localStorageSubTotal", localStorageSubTotal);

        calculateTotal();
    }

    function calculateTotal() {
        //Sum of quantity
        var total_qty = 0;
        $("table.order-list tbody .qty").each(function(index) {
            if ($(this).val() == '') {
                total_qty += 0;
            } else {
                total_qty += parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll(
                    '.', ''));
            }
        });
        $('input[name="total_qty"]').val(total_qty);

        //Sum of discount
        var total_discount = 0;
        $("table.order-list tbody .discount-value").each(function() {
            total_discount += parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll(
                '.', ''));
        });

        $('input[name="total_discount"]').val(parseInt(total_discount));

        //Sum of tax
        var total_tax = 0;
        $(".tax-value").each(function() {
            total_tax += parseInt($(this).val().replaceAll('.', '') == '' ? 0 : $(this).val().replaceAll('.',
                ''));
        });

        $('input[name="total_tax"]').val(parseInt(total_tax));

        //Sum of subtotal
        var total = 0;
        $(".sub-total").each(function() {
            total += parseInt($(this).text().replaceAll('.', '') == '' ? 0 : $(this).text().replaceAll('.',
            ''));
        });
        $('input[name="total_price"]').val(parseInt(total));

        calculateGrandTotal();
    }

    function calculateGrandTotal() {
        var item = $('table.order-list tbody tr:last').index();
        var total_qty = parseInt($('input[name="total_qty"]').val().replaceAll('.', '') == '' ? 0 : $(
            'input[name="total_qty"]').val().replaceAll('.', ''));
        var subtotal = parseInt($('input[name="total_price"]').val().replaceAll('.', '') == '' ? 0 : $(
            'input[name="total_price"]').val().replaceAll('.', ''));
        var order_tax = parseInt($('select[name="order_tax_rate_select"]').val().replaceAll('.', '') == '' ? 0 : $(
            'select[name="order_tax_rate_select"]').val().replaceAll('.', ''));
        //alert(order_tax);
        localStorage.setItem("order-tax-rate-select", order_tax);
        var order_discount = parseInt($('input[name="order_discount"]').val().replaceAll('.', '') == '' ? 0 : $(
            'input[name="order_discount"]').val().replaceAll('.', ''));
        if (!order_discount)
            order_discount = 0;
        $("#discount").text(formatRupiah(order_discount)); //riki diskon edit

        var shipping_cost = parseInt($('input[name="shipping_cost"]').val().replaceAll('.', '') == '' ? 0 : $(
            'input[name="shipping_cost"]').val().replaceAll('.', ''));
        if (!shipping_cost)
            shipping_cost = 0;

        item = ++item + '(' + total_qty + ')';
        order_tax = (subtotal - order_discount) * (order_tax / 100);
        var grand_total = (subtotal + order_tax + shipping_cost) - order_discount;
        $('input[name="grand_total"]').val(formatRupiah(grand_total));

        couponDiscount();
        var coupon_discount = parseInt($('input[name="coupon_discount"]').val().replaceAll('.', '') == '' ? 0 : $(
            'input[name="coupon_discount"]').val().replaceAll('.', ''));
        if (!coupon_discount)
            coupon_discount = 0;
        grand_total -= coupon_discount;

        $('#item').text(item);
        $('input[name="item"]').val($('table.order-list tbody tr:last').index() + 1);
        $('#subtotal').text(formatRupiah(subtotal));
        $('#tax').text(formatRupiah(order_tax));
        $('input[name="order_tax"]').val(formatRupiah(order_tax));
        $('#shipping-cost').text(formatRupiah(shipping_cost));
        $('#grand-total').text(formatRupiah(grand_total));
        $('input[name="grand_total"]').val(formatRupiah(grand_total));
    }

    function hide() {
        $(".card-element").hide();
        $(".card-errors").hide();
        $(".cheque").hide();
        $(".gift-card").hide();
        $('input[name="cheque_no"]').attr('required', false);
    }

    function giftCard() {
        $(".gift-card").show();
        $.ajax({
            url: 'sales/get_gift_card',
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#add-payment select[name="gift_card_id_select"]').empty();
                $.each(data, function(index) {
                    gift_card_amount[data[index]['id']] = data[index]['amount'];
                    gift_card_expense[data[index]['id']] = data[index]['expense'];
                    $('#add-payment select[name="gift_card_id_select"]').append('<option value="' +
                        data[index]['id'] + '">' + data[index]['card_no'] + '</option>');
                });
                $('.selectpicker').selectpicker('refresh');
                $('.selectpicker').selectpicker();
            }
        });
        $(".card-element").hide();
        $(".card-errors").hide();
        $(".cheque").hide();
        $('input[name="cheque_no"]').attr('required', false);
    }

    function cheque() {
        $(".cheque").show();
        $('input[name="cheque_no"]').attr('required', true);
        $(".card-element").hide();
        $(".card-errors").hide();
        $(".gift-card").hide();
    }

    function creditCard() {
        $.getScript("public/vendor/stripe/checkout.js");
        $(".card-element").show();
        $(".card-errors").show();
        $(".cheque").hide();
        $(".gift-card").hide();
        $('input[name="cheque_no"]').attr('required', false);
    }

    function deposits() {
        if (parseInt($('input[name="paid_amount"]').val().replaceAll('.', '') == '' ? 0 : $('input[name="paid_amount"]')
                .val().replaceAll('.', '')) > parseInt(deposit[$('#customer_id').val()].val().replaceAll('.', '') ==
                '' ? 0 : (deposit[$('#customer_id').val()].val().replaceAll('.', '')))) {
            alert('Amount exceeds customer deposit! Customer deposit : ' + deposit[$('#customer_id').val()]);
        }
        $('input[name="cheque_no"]').attr('required', false);
        $('#add-payment select[name="gift_card_id_select"]').attr('required', false);
    }

    function cancel(rownumber) {
        while (rownumber >= 0) {
            product_price.pop();
            product_discount.pop();
            tax_rate.pop();
            tax_name.pop();
            tax_method.pop();
            unit_name.pop();
            unit_operator.pop();
            unit_operation_value.pop();
            $('table.order-list tbody tr:last').remove();
            rownumber--;
        }
        $('input[name="shipping_cost"]').val('');
        $('input[name="order_discount"]').val('');
        $('select[name="order_tax_rate_select"]').val(0);
        calculateTotal();
    }

    function confirmCancel() {
        var audio = $("#mysoundclip2")[0];
        audio.play();
        if (confirm("Are you sure want to cancel?")) {
            cancel($('table.order-list tbody tr:last').index());
        }
        return false;
    }

    $(document).on('submit', '.payment-form', function(e) {
        var rownumber = $('table.order-list tbody tr:last').index();
        if (rownumber < 0) {
            alert("Please insert product to order table!")
            e.preventDefault();
        } else if (parseInt($('input[name="paying_amount"]').val().replaceAll('.', '') == '' ? 0 : $(
                'input[name="paying_amount"]').val().replaceAll('.', '')) < parseInt($(
                'input[name="paid_amount"]').val().replaceAll('.', '') == '' ? 0 : $(
                'input[name="paid_amount"]').val().replaceAll('.', ''))) {
            alert('Paying amount cannot be bigger than recieved amount');
            e.preventDefault();
        }
        $('input[name="paid_by_id"]').val(parseInt($('select[name="paid_by_id_select"]').val()));
        $('input[name="order_tax_rate"]').val(parseInt($('select[name="order_tax_rate_select"]').val()));

    });

    $('#product-table').DataTable({
        "order": [],
        'pageLength': product_row_number,
        'language': {
            'paginate': {
                'previous': '<i class="fa fa-angle-left"></i>',
                'next': '<i class="fa fa-angle-right"></i>'
            }
        },
        dom: 'tp'
    });

    var order_discountid = document.getElementById('order_discountid');
    order_discountid.addEventListener('keyup', function(e) {
        order_discountid.value = formatRupiah(this.value, 'input');
    });
    order_discountid.addEventListener('mouseover', function(e) {
        order_discountid.value = formatRupiah(this.value, 'input');
    });

    var shipping_costid = document.getElementById('shipping_costid');
    shipping_costid.addEventListener('keyup', function(e) {
        shipping_costid.value = formatRupiah(this.value, 'input');
    });
    shipping_costid.addEventListener('mouseover', function(e) {
        shipping_costid.value = formatRupiah(this.value, 'input');
    });

    var paying_amountid = document.getElementById('paying_amountid');
    paying_amountid.addEventListener('keyup', function(e) {
        paying_amountid.value = formatRupiah(this.value, 'input');
    });
    paying_amountid.addEventListener('mouseover', function(e) {
        paying_amountid.value = formatRupiah(this.value, 'input');
    });

    var paid_amountid = document.getElementById('paid_amountid');
    paid_amountid.addEventListener('keyup', function(e) {
        paid_amountid.value = formatRupiah(this.value, 'input');
    });
    paid_amountid.addEventListener('mouseover', function(e) {
        paid_amountid.value = formatRupiah(this.value, 'input');
    });

    var edit_discountid = document.getElementById('edit_discountid');
    edit_discountid.addEventListener('keyup', function(e) {
        edit_discountid.value = formatRupiah(this.value, 'input');
    });
    edit_discountid.addEventListener('mouseover', function(e) {
        edit_discountid.value = formatRupiah(this.value, 'input');
    });

    var edit_unit_priceid = document.getElementById('edit_unit_priceid');
    edit_unit_priceid.addEventListener('keyup', function(e) {
        edit_unit_priceid.value = formatRupiah(this.value, 'input');
    });
    edit_unit_priceid.addEventListener('mouseover', function(e) {
        edit_unit_priceid.value = formatRupiah(this.value, 'input');
    });

    var cash_in_handid = document.getElementById('cash_in_handid');
    cash_in_handid.addEventListener('keyup', function(e) {
        cash_in_handid.value = formatRupiah(this.value, 'input');
    });
    cash_in_handid.addEventListener('mouseover', function(e) {
        cash_in_handid.value = formatRupiah(this.value, 'input');
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
        return ('' + rupiah);
    }
</script>

<script type="text/javascript" src="https://js.stripe.com/v3/"></script>