<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/dashboard', 'HomeController@dashboard');
});

Route::group(['middleware' => ['auth', 'active']], function () {

	Route::get('/', 'HomeController@index');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/dashboard-filter/{start_date}/{end_date}', 'HomeController@dashboardFilter');
	Route::get('language_switch/{locale}', 'LanguageController@switchLanguage');

	// role permission routes
	Route::resource('/role', 'RoleController');
	Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
		Route::post('set_permission', 'RoleController@setPermission')->name('setPermission');
		Route::get('permission/{id}', 'RoleController@permission')->name('permission');
	});

	// unit routes
	Route::resource('unit', 'UnitController');
	Route::group(['prefix' => 'unit', 'as' => 'unit.'], function () {
		Route::get('lims_unit_search', 'UnitController@limsUnitSearch')->name('search');
		Route::post('importunit', 'UnitController@importUnit')->name('import');
		Route::post('deletebyselection', 'UnitController@deleteBySelection');
	});

	// category routes
	Route::resource('category', 'CategoryController');
	Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
		Route::post('category-datatable', 'CategoryController@categoryDatatable')->name('category-datatable');
		Route::post('deletebyselection', 'CategoryController@deleteBySelection');
		Route::post('import', 'CategoryController@import')->name('import');
		Route::post('category-data', 'CategoryController@categoryData');
	});

	// brand routes
	Route::resource('brand', 'BrandController');
	Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
		Route::get('lims_brand_search', 'BrandController@limsBrandSearch')->name('search');
		Route::post('importbrand', 'BrandController@importBrand')->name('import');
		Route::post('deletebyselection', 'BrandController@deleteBySelection');
	});

	// supplier routes
	Route::resource('supplier', 'SupplierController');
	Route::group(['prefix' => 'supplier', 'as' => 'supplier.'], function () {
		Route::get('lims_supplier_search', 'SupplierController@limsSupplierSearch')->name('search');
		Route::post('importsupplier', 'SupplierController@importSupplier')->name('import');
		Route::post('deletebyselection', 'SupplierController@deleteBySelection');
	});

	// warehouse routes
	Route::resource('warehouse', 'WarehouseController');
	Route::group(['prefix' => 'warehouse', 'as' => 'warehouse.'], function () {
		Route::get('lims_warehouse_search', 'WarehouseController@limsWarehouseSearch')->name('search');
		Route::post('importwarehouse', 'WarehouseController@importWarehouse')->name('import');
		Route::post('deletebyselection', 'WarehouseController@deleteBySelection');
	});

	// tax routes
	Route::resource('tax', 'TaxController');
	Route::group(['prefix' => 'tax', 'as' => 'tax.'], function () {
		Route::get('lims_tax_search', 'TaxController@limsTaxSearch')->name('search');
		Route::post('importtax', 'TaxController@importTax')->name('import');
		Route::post('deletebyselection', 'TaxController@deleteBySelection');
	});

	// product routes
	Route::resource('products', 'ProductController');
	Route::get('product-datatable', 'ProductController@productDataTable')->name('product-datatable');
	Route::get('print_barcode', 'ProductController@printBarcode')->name('printBarcode');
	Route::get('products-gencode', 'ProductController@generateCode');
	Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
		Route::POST('update/{id}', 'ProductController@update')->name('update');
		Route::get('lims_product_search', 'ProductController@limsProductSearch')->name('search');
		Route::post('importproduct', 'ProductController@importProduct')->name('import');
		Route::post('exportproduct', 'ProductController@exportProduct')->name('export');
		Route::get('product_warehouse/{id}', 'ProductController@productWarehouseData');
		Route::post('deletebyselection', 'ProductController@deleteBySelection');
		Route::get('saleunit/{id}', 'ProductController@saleUnit');
		// Route::get('getbarcode', 'ProductController@getBarcode');
		Route::get('getdata/{id}', 'ProductController@getData');
		Route::get('search', 'ProductController@search');
	});

	// customer group routes
	Route::resource('customer_group', 'CustomerGroupController');
	Route::group(['prefix' => 'customer_group', 'as' => 'customer_group.'], function () {
		Route::get('lims_customer_group_search', 'CustomerGroupController@limsCustomerGroupSearch')->name('search');
		Route::post('importcustomer_group', 'CustomerGroupController@importCustomerGroup')->name('import');
		Route::post('deletebyselection', 'CustomerGroupController@deleteBySelection');
	});

	// customer routes
	Route::resource('customer', 'CustomerController');
	Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
		Route::get('lims_customer_search', 'CustomerController@limsCustomerSearch')->name('search');
		Route::post('update_deposit', 'CustomerController@updateDeposit')->name('updateDeposit');
		Route::post('deleteDeposit', 'CustomerController@deleteDeposit')->name('deleteDeposit');
		Route::post('importcustomer', 'CustomerController@importCustomer')->name('import');
		Route::post('add_deposit', 'CustomerController@addDeposit')->name('addDeposit');
		Route::post('deletebyselection', 'CustomerController@deleteBySelection');
		Route::get('getDeposit/{id}', 'CustomerController@getDeposit');
	});

	// biller routes
	Route::resource('biller', 'BillerController');
	Route::group(['prefix' => 'biller', 'as' => 'biller.'], function () {
		Route::get('lims_biller_search', 'BillerController@limsBillerSearch')->name('search');
		Route::post('importbiller', 'BillerController@importBiller')->name('import');
		Route::post('deletebyselection', 'BillerController@deleteBySelection');
	});

	// sales routes
	Route::resource('/sales', 'SaleController')->except('show');
	Route::get('sales-getproduct/{id}', 'SaleController@getProduct')->name('getproduct');
	Route::get('sales-getproduct/{category_id}/{brand_id}', 'SaleController@getProductByFilter');
	Route::get('sales-getcustomergroup/{id}', 'SaleController@getCustomerGroup')->name('getcustomergroup');
	Route::get('sales-lims_product_search', 'SaleController@limsProductSearch')->name('product_sale.search');

	Route::group(['prefix' => 'sales', 'as' => 'sales.'], function () {
		Route::get('pos', 'SaleController@posSale')->name('pos');
		Route::get('print-last-reciept', 'SaleController@printLastReciept')->name('printLastReciept');
		Route::post('updatepayment', 'SaleController@updatePayment')->name('update-payment');
		Route::post('deletepayment', 'SaleController@deletePayment')->name('delete-payment');
		Route::get('getpayment/{id}', 'SaleController@getPayment')->name('get-payment');
		Route::get('lims_sale_search', 'SaleController@limsSaleSearch')->name('search');
		Route::get('paypalPaymentSuccess/{id}', 'SaleController@paypalPaymentSuccess');
		Route::get('gen_invoice/{id}', 'SaleController@genInvoice')->name('invoice');
		Route::post('add_payment', 'SaleController@addPayment')->name('add-payment');
		Route::get('today-profit/{warehouse_id}', 'SaleController@todayProfit');
		Route::post('importsale', 'SaleController@importSale')->name('import');
		Route::post('sendmail', 'SaleController@sendMail')->name('sendmail');
		Route::post('deletebyselection', 'SaleController@deleteBySelection');
		Route::get('product_sale/{id}', 'SaleController@productSaleData');
		Route::get('paypalSuccess', 'SaleController@paypalSuccess');
		Route::get('get_gift_card', 'SaleController@getGiftCard');
		Route::get('getfeatured', 'SaleController@getFeatured');
		Route::get('{id}/create', 'SaleController@createSale');
		Route::get('sale_by_csv', 'SaleController@saleByCsv');
		Route::get('today-sale', 'SaleController@todaySale');
		Route::post('sale-data', 'SaleController@saleData');
	});

	// delivery routes
	Route::group(['prefix' => 'delivery', 'as' => 'delivery.'], function() {
		Route::get('product_delivery/{id}', 'DeliveryController@productDeliveryData');
		Route::post('deletebyselection', 'DeliveryController@deleteBySelection');
		Route::post('sendmail', 'DeliveryController@sendMail')->name('sendMail');
		Route::post('delete/{id}', 'DeliveryController@delete')->name('delete');
		Route::post('update', 'DeliveryController@update')->name('update');
		Route::post('store', 'DeliveryController@store')->name('store');
		Route::get('/', 'DeliveryController@index')->name('index');
		Route::get('create/{id}', 'DeliveryController@create');
		Route::get('{id}/edit', 'DeliveryController@edit');
	});

	// quotation routes
	Route::resource('/quotations', 'QuotationController');
	Route::post('quotations-sendmail', 'QuotationController@sendMail')->name('quotations.sendmail');
	Route::group(['prefix' => 'quotations', 'as' => 'quotations.'], function() {
		Route::get('lims_product_search', 'QuotationController@limsProductSearch')->name('product_quotation.search');
		Route::get('getcustomergroup/{id}', 'QuotationController@getCustomerGroup')->name('getcustomergroup');
		Route::get('{id}/create_purchase', 'QuotationController@createPurchase')->name('create_purchase');
		Route::get('{id}/create_sale', 'QuotationController@createSale')->name('create_sale');
		Route::get('getproduct/{id}', 'QuotationController@getProduct')->name('getproduct');
		Route::get('product_quotation/{id}', 'QuotationController@productQuotationData');
		Route::post('deletebyselection', 'QuotationController@deleteBySelection');
	});

	// purchase routes
	Route::resource('/purchases', 'PurchaseController');
	Route::get('purchase_by_csv', 'PurchaseController@purchaseByCsv');
	Route::group(['prefix' => 'purchases', 'as' => 'purchases.'], function() {
		Route::get('lims_product_search', 'PurchaseController@limsProductSearch')->name('product_purchase.search');
		Route::post('updatepayment', 'PurchaseController@updatePayment')->name('update-payment');
		Route::post('deletepayment', 'PurchaseController@deletePayment')->name('delete-payment');
		Route::get('getpayment/{id}', 'PurchaseController@getPayment')->name('get-payment');
		Route::post('importpurchase', 'PurchaseController@importPurchase')->name('import');
		Route::post('add_payment', 'PurchaseController@addPayment')->name('add-payment');
		Route::post('purchase-data', 'PurchaseController@purchaseData')->name('data');
		Route::get('product_purchase/{id}', 'PurchaseController@productPurchaseData');
		Route::post('deletebyselection', 'PurchaseController@deleteBySelection');
	});

	// tranfer routes
	Route::resource('/transfers', 'TransferController');
	Route::group(['prefix' => 'transfers', 'as' => 'transfers.'], function() {
		Route::get('lims_product_search', 'TransferController@limsProductSearch')->name('product_transfer.search');
		Route::post('importtransfer', 'TransferController@importTransfer')->name('import');
		Route::get('getproduct/{id}', 'TransferController@getProduct')->name('getproduct');
		Route::get('product_transfer/{id}', 'TransferController@productTransferData');
		Route::post('deletebyselection', 'TransferController@deleteBySelection');
		Route::get('transfer_by_csv', 'TransferController@transferByCsv');
	});

	// qty adjustment routes
	Route::resource('/qty_adjustment', 'AdjustmentController');
	Route::group(['prefix' => 'qty_adjustment', 'as' => 'qty_adjustment.'], function() {
		Route::get('lims_product_search', 'AdjustmentController@limsProductSearch')->name('product_adjustment.search');
		Route::get('getproduct/{id}', 'AdjustmentController@getProduct')->name('adjustment.getproduct');
		Route::post('deletebyselection', 'AdjustmentController@deleteBySelection');
	});

	// return sale routes
	Route::resource('/return-sale', 'ReturnController');
	Route::group(['prefix' => 'return-sale', 'as' => 'return-sale.'], function() {
		Route::get('getcustomergroup/{id}', 'ReturnController@getCustomerGroup')->name('getcustomergroup');
		Route::get('lims_product_search', 'ReturnController@limsProductSearch')->name('product_search');
		Route::get('getproduct/{id}', 'ReturnController@getProduct')->name('getproduct');
		Route::get('product_return/{id}', 'ReturnController@productReturnData');
		Route::post('sendmail', 'ReturnController@sendMail')->name('sendmail');
		Route::post('deletebyselection', 'ReturnController@deleteBySelection');
	});

	// return purchase routes
	Route::resource('/return-purchase', 'ReturnPurchaseController');
	Route::group(['prefix' => 'return-purchase', 'as' => 'return-purchase.'], function() {
		Route::get('lims_product_search', 'ReturnPurchaseController@limsProductSearch')->name('product_return-purchase.search');
		Route::get('getcustomergroup/{id}', 'ReturnPurchaseController@getCustomerGroup')->name('getcustomergroup');
		Route::get('getproduct/{id}', 'ReturnPurchaseController@getProduct')->name('getproduct');
		Route::get('product_return/{id}', 'ReturnPurchaseController@productReturnData');
		Route::post('deletebyselection', 'ReturnPurchaseController@deleteBySelection');
		Route::post('sendmail', 'ReturnPurchaseController@sendMail')->name('sendmail');
	});
	
	// report routes
	Route::group(['prefix' => 'report', 'as' => 'report.'], function() {
		Route::post('daily_purchase/{year}/{month}', 'ReportController@dailyPurchaseByWarehouse')->name('dailyPurchaseByWarehouse');
		Route::post('monthly_purchase/{year}', 'ReportController@monthlyPurchaseByWarehouse')->name('monthlyPurchaseByWarehouse');
		Route::post('daily_sale/{year}/{month}', 'ReportController@dailySaleByWarehouse')->name('dailySaleByWarehouse');
		Route::post('monthly_sale/{year}', 'ReportController@monthlySaleByWarehouse')->name('monthlySaleByWarehouse');
		Route::post('payment_report_by_date', 'ReportController@paymentReportByDate')->name('paymentByDate');
		Route::post('best_seller', 'ReportController@bestSellerByWarehouse')->name('bestSellerByWarehouse');
		Route::get('product_quantity_alert', 'ReportController@productQuantityAlert')->name('qtyAlert');
		Route::post('warehouse_stock', 'ReportController@warehouseStockById')->name('warehouseStock');
		Route::get('warehouse_stock', 'ReportController@warehouseStock')->name('warehouseStock');
		Route::post('due_report_by_date', 'ReportController@dueReportByDate')->name('dueByDate');
		Route::post('warehouse_report', 'ReportController@warehouseReport')->name('warehouse');
		Route::post('customer_report', 'ReportController@customerReport')->name('customer');
		Route::post('product_report', 'ReportController@productReport')->name('product');
		Route::get('daily_purchase/{year}/{month}', 'ReportController@dailyPurchase');
		Route::post('profit_loss', 'ReportController@profitLoss')->name('profitLoss');
		Route::post('purchase', 'ReportController@purchaseReport')->name('purchase');
		Route::post('supplier', 'ReportController@supplierReport')->name('supplier');
		Route::get('monthly_purchase/{year}', 'ReportController@monthlyPurchase');
		Route::post('sale_report', 'ReportController@saleReport')->name('sale');
		Route::post('user_report', 'ReportController@userReport')->name('user');
		Route::get('daily_sale/{year}/{month}', 'ReportController@dailySale');
		Route::get('monthly_sale/{year}', 'ReportController@monthlySale');
		Route::get('best_seller', 'ReportController@bestSeller');
	});

	// user routes
	Route::resource('/user', 'UserController');
	Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
		Route::put('update_profile/{id}', 'UserController@profileUpdate')->name('profileUpdate');
		Route::put('changepass/{id}', 'UserController@changePassword')->name('password');
		Route::get('profile/{id}', 'UserController@profile')->name('profile');
		Route::post('deletebyselection', 'UserController@deleteBySelection');
		Route::get('genpass', 'UserController@generatePassword');
	});

	// setting routes
	Route::group(['prefix' => 'setting', 'as' => 'setting.'], function() {
		Route::post('general_setting_store', 'SettingController@generalSettingStore')->name('generalStore');
		Route::post('mail_setting_store', 'SettingController@mailSettingStore')->name('mailStore');
		Route::post('hrm_setting_store', 'SettingController@hrmSettingStore')->name('hrmStore');
		Route::post('sms_setting_store', 'SettingController@smsSettingStore')->name('smsStore');
		Route::post('pos_setting_store', 'SettingController@posSettingStore')->name('posStore');
		Route::get('empty-database', 'SettingController@emptyDatabase')->name('emptyDatabase');
		Route::get('general_setting/change-theme/{theme}', 'SettingController@changeTheme');
		Route::get('general_setting', 'SettingController@generalSetting')->name('general');
		Route::get('mail_setting', 'SettingController@mailSetting')->name('mail');
		Route::get('createsms', 'SettingController@createSms')->name('createSms');
		Route::get('sms_setting', 'SettingController@smsSetting')->name('sms');
		Route::get('hrm_setting', 'SettingController@hrmSetting')->name('hrm');
		Route::get('pos_setting', 'SettingController@posSetting')->name('pos');
		Route::post('sendsms', 'SettingController@sendSms')->name('sendSms');
		Route::get('backup', 'SettingController@backup')->name('backup');
	});

	// expense categories routes
	Route::resource('/expense_categories', 'ExpenseCategoryController');
	Route::group(['prefix' => 'expense_categories', 'as' => 'expense_categories.'], function() {
		Route::post('deletebyselection', 'ExpenseCategoryController@deleteBySelection');
		Route::post('import', 'ExpenseCategoryController@import')->name('import');
		Route::get('gencode', 'ExpenseCategoryController@generateCode');
	});

	// expenses routes
	Route::resource('/expenses', 'ExpenseController');
	Route::group(['prefix' => 'expenses', 'as' => 'expenses.'], function() {
		Route::post('deletebyselection', 'ExpenseController@deleteBySelection');
	});

	// gift card routes
	Route::resource('/gift_cards', 'GiftCardController');
	Route::group(['prefix' => 'gift_cards', 'as' => 'gift_cards.'], function() {
		Route::post('recharge/{id}', 'GiftCardController@recharge')->name('recharge');
		Route::post('deletebyselection', 'GiftCardController@deleteBySelection');
		Route::get('gencode', 'GiftCardController@generateCode');
	});

	// coupen routes
	Route::resource('/coupons', 'CouponController');
	Route::group(['prefix' => 'coupons', 'as' => 'coupons.'], function() {
		Route::post('deletebyselection', 'CouponController@deleteBySelection');
		Route::get('gencode', 'CouponController@generateCode');
	});

	// accounting routes
	Route::resource('/accounts', 'AccountsController');
	Route::group(['prefix' => 'accounts', 'as' => 'accounts.'], function() {
		Route::post('account-statement', 'AccountsController@accountStatement')->name('statement');
		Route::get('balancesheet', 'AccountsController@balanceSheet')->name('balancesheet');
		Route::get('make-default/{id}', 'AccountsController@makeDefault');
	});

	// money transfer routes
	Route::resource('money-transfers', 'MoneyTransferController');

	// Departments routes
	Route::resource('/departments', 'DepartmentController');
	Route::group(['prefix' => 'departments', 'as' => 'departments.'], function() {
		Route::post('/deletebyselection', 'DepartmentController@deleteBySelection');
	});

	// employees routes
	Route::resource('/employees', 'EmployeeController');
	Route::group(['prefix' => 'employees', 'as' => 'employees.'], function() {
		Route::post('deletebyselection', 'EmployeeController@deleteBySelection');
	});

	// payroll routes
	Route::resource('/payroll', 'PayrollController');
	Route::group(['prefix' => 'payroll', 'as' => 'payroll.'], function() {
		Route::post('deletebyselection', 'PayrollController@deleteBySelection');
	});

	// attendance routes
	Route::resource('/attendance', 'AttendanceController');
	Route::group(['prefix' => 'attendance', 'as' => 'attendance.'], function() {
		Route::post('deletebyselection', 'AttendanceController@deleteBySelection');
	});

	// stock count routes
	Route::resource('/stock-count', 'StockCountController');
	Route::group(['prefix' => 'stock-count', 'as' => 'stock-count.'], function() {
		Route::get('{id}/qty_adjustment', 'StockCountController@qtyAdjustment')->name('adjustment');
		Route::post('finalize', 'StockCountController@finalize')->name('finalize');
		Route::get('stockdif/{id}', 'StockCountController@stockDif');
	});

	// holidays routes
	Route::resource('/holidays', 'HolidayController');
	Route::group(['prefix' => 'holidays', 'as' => 'holidays.'], function() {
		Route::get('approve-holiday/{id}', 'HolidayController@approveHoliday')->name('approveHoliday');
		Route::get('my-holiday/{year}/{month}', 'HolidayController@myHoliday')->name('myHoliday');
		Route::post('deletebyselection', 'HolidayController@deleteBySelection');
	});

	// cash register routes
	Route::group(['prefix' => 'cash-register', 'as' => 'cash-register.'], function() {
		Route::get('check-availability/{warehouse_id}', 'CashRegisterController@checkAvailability')->name('checkAvailability');
		Route::get('showDetails/{warehouse_id}', 'CashRegisterController@showDetails');
		Route::post('store', 'CashRegisterController@store')->name('store');
		Route::post('close', 'CashRegisterController@close')->name('close');
		Route::get('getDetails/{id}', 'CashRegisterController@getDetails');
		Route::get('/', 'CashRegisterController@index')->name('index');
	});

	// notifications routes
	Route::group(['prefix' => 'notifications', 'as' => 'notifications.'], function() {
		Route::post('store', 'NotificationController@store')->name('store');
		Route::get('mark-as-read', 'NotificationController@markAsRead');
	});

	// currency routes
	Route::resource('currency', 'CurrencyController');

	Route::group(['prefix' => 'master', 'as' => 'master.'], function() {
		Route::post('price-multi-delete', 'PriceController@destroyMultiple');
		Route::get('price-datatable', 'PriceController@priceData');
		Route::resource("/price", 'PriceController');
	});


	// product categories routes
	Route::group(['prefix' => 'product-categories', 'as' => 'product-categories.'], function() {
		
		Route::post('tagtype-multi-delete', 'TagTypeController@destroyMultiple');
		Route::get('tagtype-datatable', 'TagTypeController@tagTypeData');
		Route::resource('tagtype', 'TagTypeController');
	
		Route::post('producttype-multi-delete', 'ProductTypeController@destroyMultiple');
		Route::get('producttype-datatable', 'ProductTypeController@productTypeData');
		Route::get('producttype-getByCategory/{id}', 'ProductTypeController@getByCategory');
		Route::resource('producttype', 'ProductTypeController');
	
		Route::get('productproperty-datatable', 'ProductPropertyController@productPropertyData');
		Route::post('productproperty-multi-delete', 'ProductPropertyController@destroyMultiple');
		Route::resource('productproperty', 'ProductPropertyController');
	
		Route::post('gramasi-multi-delete', 'GramasiController@destroyMultiple');
		Route::get('gramasi-datatable', 'GramasiController@gramasiData');
		Route::get('gramasi-getByCategoryAndProductType/{category_id}/{product_type_id}', 'GramasiController@getByCategoryAndProductType');
		Route::resource('gramasi', 'GramasiController');

	});

	Route::resource('productbaseontag', 'ProductBaseOnTagController');

	Route::get('my-transactions/{year}/{month}', 'HomeController@myTransaction');

	Route::get('help', function () {
		return view('help');
	});

});
