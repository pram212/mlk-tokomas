<nav class="side-navbar shrink">
    <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
            <ul id="side-main-menu" class="side-menu list-unstyled">
                <li>
                    <a href="{{ url('/') }}">
                        <i class="dripicons-meter"></i><span>{{ __('file.dashboard') }}</span>
                    </a>
                </li>

                {{-- MASTER MENU --}}
                <li>
                    @php
                    $requestIsOnProductCategoryMenu = request()->is('product-categories*', 'master*',
                    'category*','promo*') ?
                    'true' : 'false';
                    @endphp
                    @can('parentView', App\Master::class)
                    <a href="#productcategory" data-toggle="collapse"
                        aria-expanded="{{ $requestIsOnProductCategoryMenu }}">
                        <i class="dripicons-card"></i><span>Master</span>
                    </a>
                    @endcan

                    <ul id="productcategory"
                        class="collapse list-unstyled @if ($requestIsOnProductCategoryMenu === 'true') show @endif">
                        @can('viewAny', App\Category::class)
                        <li id="category-menu" class="@if (request()->is('category*')) active @endif">
                            <a href="{{ route('category.index') }}">{{ __('file.Product Category') }}</a>
                        </li>
                        @endcan

                        @can('taggingType', App\Master::class)
                            <li id="productcategory-list-menu"
                                class="@if (request()->is('product-categories/tagtype*')) active @endif">
                                <a href="{{ route('product-categories.tagtype.index') }}">{{ __('file.Tagging Type') }}</a>
                            </li>
                        @endcan

                        @can('productProperty', App\Master::class)
                            <li id="productcategory-list-menu"
                            class="@if (request()->is('product-categories/productproperty*')) active @endif">
                            <a href="{{ route('product-categories.productproperty.index') }}">
                                {{ __('file.Product Property') }}</a>
                            </li>
                        @endcan

                        @can('productType', App\Master::class)
                        <li id="productcategory-list-menu"
                            class="@if (request()->is('product-categories/producttype*')) active @endif">
                            <a href="{{ route('product-categories.producttype.index') }}">{{ __('file.Product Type')
                                }}</a>
                        </li>
                        @endcan

                        {{-- Hide Daftar Gramasi --}}
                        {{-- @can('gramasi', App\Master::class)
                        <li id="productcategory-list-menu"
                            class="@if (request()->is('product-categories/gramasi*')) active @endif">
                            <a href="{{ route('product-categories.gramasi.index') }}">{{ __('file.Gramasi List') }}</a>
                        </li>
                        @endcan --}}

                        @can('price', App\Master::class)
                        <li id="price-list-menu" class="@if (request()->is('master/price*')) active @endif">
                            <a href="{{ route('master.price.index') }}">{{ __('file.Price') }}</a>
                        </li>
                        @endcan

                        {{-- Potongan Discount --}}
                        <li id="potongan-list-menu" class="@if (request()->is('master/potongan*')) active @endif">
                            <a href="{{ route('master.potongan.index') }}">{{ __('file.Discount') }}</a>
                        </li>

                        @can('promo', App\Master::class)
                        <li id="promo" class="@if (request()->is('promo*')) active @endif">
                            <a href="{{ url('promo') }}">{{ __('file.promo') }}</a>
                        </li>
                        @endcan

                    </ul>
                </li>
                {{--  MASTER MENU END --}}

                {{-- PRODUCT STOCK  --}}
                <li>
                    @php
                    $requestIsProductStockMenu = request()->is('product_stock*') ? 'true' : 'false';
                    @endphp

                    @can('parentView', App\ProductStock::class)
                    <a href="#stock" aria-expanded="{{ $requestIsProductStockMenu }}" data-toggle="collapse">
                        <i class="dripicons-document-remove"></i><span>{{ trans('file.product_stock') }}</span>
                    </a>
                    @endcan
                    <ul id="stock" class="collapse list-unstyled @if ($requestIsProductStockMenu === 'true') show @endif">
                        @can('productStock', App\ProductStock::class)
                        <li @if (request()->is('product')) active @endif>
                            <a href="{{ route('product_stock.index')}}">{{ trans('file.product_stock') }}</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                {{-- PRODUCT STOCK END --}}


                <li>
                    @php
                    $requestIsOnProductMenu = request()->is(
                    'products*',
                    'category*',
                    'qty_adjustment*',
                    'stock-count*',
                    'product_stock*',
                    'warehouse_transfer*',
                    )
                    ? 'true'
                    : 'false';
                    @endphp
                    @can('parentView', App\Product::class)
                    <a href="#product" aria-expanded="{{ $requestIsOnProductMenu }}" data-toggle="collapse">
                        <i class="dripicons-list"></i><span>{{ __('file.product') }}</span><span>
                    </a>
                    @endcan
                    <ul id="product"
                        class="collapse list-unstyled @if ($requestIsOnProductMenu === 'true') show @endif">

                        {{-- DICOMMENT KARENA MAKE 1 MENU SAJA YAITU YANG DI MASTER --}}
                        {{-- @can('viewAny', App\Category::class)
                        <li id="category-menu" class="{{ request()->is('category*') ? 'active' : '' }}">
                            <a href="{{ route('category.index') }}">{{ __('file.category') }}</a>
                        </li>
                        @endcan --}}

                        @can('viewAny', App\Product::class)
                        <li id="product-list-menu" class="{{ request()->is('products/') ? 'active' : '' }}">
                            <a href="{{ route('products.index') }}">{{ __('file.product_list') }}</a>
                        </li>
                        @endcan

                        @can('create', App\Product::class)
                        <li id="product-create-menu" class="{{ request()->is('products/create') ? 'active' : '' }}">
                            <a href="{{ route('products.create') }}">{{ __('file.add_product') }}</a>
                        </li>
                        @endcan

                        @can('viewAny', App\WarehouseTransfer::class)
                        <li id="warehouse_transfer" class="{{ request()->is('warehouse_transfer*') ? 'active' : '' }}">
                            <a href="{{ url('warehouse_transfer') }}">{{ __('file.warehouse_transfer') }}</a>
                        </li>
                        @endcan

                        @can('productsStock',App\Product::class)
                        <li id="product_stock" class="{{ request()->is('product_stock*') ? 'active' : '' }}">
                            <a href="{{ url('product_stock') }}">{{ __('file.product_stock') }}</a>
                        </li>
                        @endcan

                    </ul>
                </li>




                <li>
                    @php
                    $requestIsOnSalesMenu = request()->is('sales*') ? 'true' : 'false';
                    @endphp
                    @can('parentView', App\Sale::class)
                    <a href="#sale" aria-expanded="{{ $requestIsOnSalesMenu }}" data-toggle="collapse">
                        <i class="dripicons-cart"></i><span>{{ trans('file.Sale') }}</span>
                    </a>
                    @endcan
                    <ul id="sale" class="collapse list-unstyled @if ($requestIsOnSalesMenu === 'true') show @endif">
                        @can('viewAny', App\Sale::class)
                        <li id="sale-list-menu" class="@if (request()->is('sales')) active @endif">
                            <a href="{{ route('sales.index') }}">{{ trans('file.Sale List') }}</a>
                        </li>
                        @endcan

                        @can('create', App\Sale::class)
                        <li class="@if (request()->is('sales/pos')) active @endif">
                            <a href="{{ route('sales.pos') }}" target="_blank">POS</a>
                        </li>
                        @endcan

                        @can('viewAny', App\Coupon::class)
                        <li id="coupon-menu" class="@if (request()->is('coupons*')) active @endif">
                            <a href="{{ route('coupons.index') }}">{{ trans('file.Coupon List') }}</a>
                        </li>
                        @endcan

                    </ul>
                </li>
                @can('viewAny', App\Product::class)
                <li id="buyback">
                    <a href="{{ url('buyback') }}">
                        <i class="dripicons-return"></i><span>{{ __('file.buy back') }}</span>
                    </a>
                </li>
                @endcan


                {{-- HIDE ACM --}}

                {{-- @can('viewAny', App\Expense::class)
                <li>
                    @php
                    $requestIsOnExpenseMenu = request()->is('expenses*') ? 'true' : 'false';
                    @endphp
                    <a href="#expense" aria-expanded="{{ $requestIsOnExpenseMenu }}" data-toggle="collapse">
                        <i class="dripicons-wallet"></i><span>{{ trans('file.Expense') }}</span>
                    </a>
                    <ul id="expense"
                        class="collapse list-unstyled @if ($requestIsOnExpenseMenu === 'true') show @endif ">
                        <li id="exp-cat-menu" class="@if (request()->is('expense_categories/')) active @endif">
                            <a href="{{ route('expense_categories.index') }}">{{ trans('file.Expense Category') }}</a>
                        </li>
                        <li id="exp-list-menu" class="@if (request()->is('expenses/')) active @endif">
                            <a href="{{ route('expenses.index') }}">{{ trans('file.Expense List') }}</a>
                        </li>
                        @can('create', App\Expense::class)
                        <li class="@if (request()->is('expenses/create')) active @endif">
                            <a id="add-expense" href=""> {{ trans('file.Add Expense') }}</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan --}}

                {{-- @can('viewAny', App\Quotation::class)
                <li>
                    @php
                    $requestIsOnQuotationMenu = request()->is('quotations*') ? 'true' : 'false';
                    @endphp
                    <a href="#quotation" aria-expanded="{{ $requestIsOnQuotationMenu }}" data-toggle="collapse">
                        <i class="dripicons-document"></i><span>{{ trans('file.Quotation') }}</span><span>
                    </a>

                    <ul id="quotation"
                        class="collapse list-unstyled @if ($requestIsOnQuotationMenu === 'true') show @endif">
                        <li class="@if (request()->is('quotations/')) active @endif"">
                                <a href=" {{ route('quotations.index') }}">{{ trans('file.Quotation List') }}</a>
                        </li>
                        @can('create', App\Quotation::class)
                        <li class="@if (request()->is('quotations/create')) active @endif">
                            <a href="{{ route('quotations.create') }}">{{ trans('file.Add Quotation') }}</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan --}}

                {{-- <li>
                    @php
                    $requestIsOnTransferMenu = request()->is('transfers*') ? 'true' : 'false';
                    @endphp
                    @can('viewAny', App\Transfer::class)
                    <a href="#transfer" aria-expanded="{{ $requestIsOnTransferMenu }}" data-toggle="collapse">
                        <i class="dripicons-export"></i><span>{{ trans('file.Transfer') }}</span>
                    </a>
                    @endcan
                    <ul id="transfer"
                        class="collapse list-unstyled @if ($requestIsOnTransferMenu === 'true') show @endif">

                        @can('viewAny', App\Transfer::class)
                        <li class="@if (request()->is('transfers.index')) active @endif">
                            <a href="{{ route('transfers.index') }}">{{ trans('file.Transfer List') }}</a>
                        </li>
                        @endcan

                        @can('create', App\Transfer::class)
                        <li class="@if (request()->is('transfers/create')) active @endif">
                            <a href="{{ route('transfers.create') }}">{{ trans('file.Add Transfer') }}</a>
                        </li>
                        <li class="@if (request()->is('transfers/transfer_by_csv')) active @endif">
                            <a href="{{ url('transfers/transfer_by_csv') }}">{{ trans('file.Import Transfer By CSV')
                                }}</a>
                        </li>
                        @endcan

                    </ul>
                </li> --}}

                {{-- <li>
                    @php
                    $requestIsOnReturnMenu = request()->is('return*') ? 'true' : 'false';
                    @endphp
                    @can('return', App\Sale::class)
                    <a href="#return" aria-expanded="{{ $requestIsOnReturnMenu }}" data-toggle="collapse">
                        <i class="dripicons-return"></i><span>{{ trans('file.return') }}</span>
                    </a>
                    @endcan
                    <ul id="return" class="collapse list-unstyled @if ($requestIsOnReturnMenu === 'true') show @endif">

                        @can('return', App\Sale::class)
                        <li class="@if (request()->is('return-sale*')) active @endif">
                            <a href="{{ route('return-sale.index') }}">{{ trans('file.Sale') }}</a>
                        </li>
                        @endcan

                        @can('return', App\Purchase::class)
                        <li id="purchase-return-menu" class="@if (request()->is('return-purchase*')) active @endif">
                            <a href="{{ route('return-purchase.index') }}">{{ trans('file.Purchase') }}</a>
                        </li>
                        @endcan

                    </ul>
                </li> --}}

                {{-- <li>
                    @php
                    $requestIsOnAccountingMenu = request()->is('accounts*', 'money-transfers*', 'balancesheet*')
                    ? 'true'
                    : 'false';
                    @endphp
                    @can('viewAny', App\Account::class)
                    <a href="#account" aria-expanded="{{ $requestIsOnAccountingMenu }}" data-toggle="collapse">
                        <i class="dripicons-briefcase"></i><span>{{ trans('file.Accounting') }}</span>
                    </a>
                    @endcan
                    <ul id="account"
                        class="collapse list-unstyled @if ($requestIsOnAccountingMenu === 'true') show @endif">

                        @can('viewAny', App\Account::class)
                        <li class="@if (request()->is('accounts/')) active @endif">
                            <a href="{{ route('accounts.index') }}">{{ trans('file.Account List') }}</a>
                        </li>
                        <li class="@if (request()->is('accounts/create')) active @endif">
                            <a id="add-account" href="#">{{ trans('file.Add Account') }}</a>
                        </li>
                        @endcan

                        @can('viewAny', App\MoneyTransfer::class)
                        <li class="@if (request()->is('money-transfer/')) active @endif">
                            <a href="{{ route('money-transfers.index') }}">{{ trans('file.Money Transfer') }}</a>
                        </li>
                        @endcan

                        @can('viewBalanceSheet', App\Account::class)
                        <li class="@if (request()->is('accounts/balancesheet/')) active @endif">
                            <a href="{{ route('accounts.balancesheet') }}">{{ trans('file.Balance Sheet') }}</a>
                        </li>
                        @endcan

                        @can('viewStatement', App\Account::class)
                        <li class="@if (request()->is('accounts/statement/')) active @endif">
                            <a id="account-statement" href="">{{ trans('file.Account Statement') }}</a>
                        </li>
                        @endcan
                    </ul>
                </li> --}}

                {{-- @if (Auth::user()->role_id != 5)
                <li>
                    @php
                    $requestIsOnHRMMenu = request()->is(
                    'departments*',
                    'employees*',
                    'attendance*',
                    'payroll*',
                    'holidays*',
                    )
                    ? 'true'
                    : 'false';
                    @endphp
                    @can('viewany', App\Department::class)
                    <a href="#hrm" aria-expanded="{{ $requestIsOnHRMMenu }}" data-toggle="collapse">
                        <i class="dripicons-user-group"></i><span>HRM</span>
                    </a>
                    @endcan
                    <ul id="hrm" class="collapse list-unstyled @if ($requestIsOnHRMMenu === 'true') show @endif">
                        @can('viewany', App\Department::class)
                        <li id="dept-menu" class="@if (request()->is('departments*')) active @endif">
                            <a href="{{ route('departments.index') }}">{{ trans('file.Department') }}</a>
                        </li>
                        @endcan

                        @can('viewAny', App\Employee::class)
                        <li id="employee-menu" class="@if (request()->is('employees*')) active @endif">
                            <a href="{{ route('employees.index') }}">{{ trans('file.Employee') }}</a>
                        </li>
                        @endcan

                        @can('viewAny', App\Attendance::class)
                        <li id="attendance-menu" class="@if (request()->is('attendance*')) active @endif">
                            <a href="{{ route('attendance.index') }}">{{ trans('file.Attendance') }}</a>
                        </li>
                        @endcan

                        @can('viewAny', App\Payroll::class)
                        <li id="payroll-menu" class="@if (request()->is('payroll*')) active @endif">
                            <a href="{{ route('payroll.index') }}">{{ trans('file.Payroll') }}</a>
                        </li>
                        @endcan

                        <li id="holiday-menu" class="@if (request()->is('holidays*')) active @endif">
                            <a href="{{ route('holidays.index') }}">{{ trans('file.Holiday') }}</a>
                        </li>

                    </ul>
                </li>
                @endif --}}

                @php
                $role = DB::table('roles')->find(Auth::user()->role_id);
                // user permission query original
                $user_index_permission_active = DB::table('permissions')
                ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                ->where([['permissions.name', 'users-index'], ['role_id', $role->id]])
                ->first();
                @endphp

                <li>
                    @php
                    $requestIsOnPeopleMenu = request()->is('accounts*', 'money-transfers*', 'balancesheet*')
                    ? 'true'
                    : 'false';
                    @endphp
                    @can('parentView', App\User::class)
                        <a href="#people" aria-expanded="{{ $requestIsOnPeopleMenu }}" data-toggle="collapse">
                            <i class="dripicons-user"></i><span>{{ trans('file.People') }}</span>
                        </a>
                    @endcan
                    <ul id="people" class="collapse list-unstyled @if ($requestIsOnPeopleMenu === 'true') show @endif">
                        @can('viewAny', App\User::class)
                        <li id="user-list-menu" class="@if (request()->is('user/')) active @endif">
                            <a href="{{ route('user.index') }}">{{ trans('file.User List') }}</a>
                        </li>
                        @endcan

                        @can('create', App\User::class)
                        <li id="user-create-menu" class="@if (request()->is('user/create/')) active @endif">
                            <a href="{{ route('user.create') }}">{{ trans('file.Add User') }}</a>
                        </li>
                        @endcan

                        @can('viewAny', App\Customer::class)
                        <li id="customer-list-menu" class="@if (request()->is('customer/')) active @endif">
                            <a href="{{ route('customer.index') }}">{{ trans('file.Customer List') }}</a>
                        </li>
                        @endcan

                        @can('create', App\Customer::class)
                        <li id="customer-create-menu" class="@if (request()->is('customer/create/')) active @endif">
                            <a href="{{ route('customer.create') }}">{{ trans('file.Add Customer') }}</a>
                        </li>
                        @endcan

                        @can('viewAny', App\Biller::class)
                        <li id="biller-list-menu" class="@if (request()->is('biller/')) active @endif">
                            <a href="{{ route('biller.index') }}">{{ trans('file.Biller List') }}</a>
                        </li>
                        @endcan

                        @can('create', App\Biller::class)
                        <li id="biller-create-menu" class="@if (request()->is('biller/create/')) active @endif">
                            <a href="{{ route('biller.create') }}">{{ trans('file.Add Biller') }}</a>
                        </li>
                        @endcan

                        @can('viewAny', App\Supplier::class)
                        <li id="supplier-list-menu" class="@if (request()->is('supplier/')) active @endif">
                            <a href="{{ route('supplier.index') }}">{{ trans('file.Supplier List') }}</a>
                        </li>
                        @endcan

                        @can('create', App\Supplier::class)
                        <li id="supplier-create-menu" class="@if (request()->is('supplier/create/')) active @endif">
                            <a href="{{ route('supplier.create') }}">{{ trans('file.Add Supplier') }}</a>
                        </li>
                        @endcan

                    </ul>
                </li>

                <li>
                    @php
                    $requestIsOnReportMenu = request()->is('report*') ? 'true' : 'false';
                    @endphp
                    @can('parentView', App\Report::class)
                        <a href="#report" aria-expanded="{{ $requestIsOnReportMenu }}" data-toggle="collapse">
                            <i class="dripicons-document-remove"></i><span>{{ trans('file.Reports') }}</span>
                        </a>
                    @endcan
                    <ul id="report" class="collapse list-unstyled @if ($requestIsOnReportMenu === 'true') show @endif">
                        @can('report', App\Product::class)
                        <li @if (request()->is('report/sale')) active @endif>
                            <a href="{{ route('report.sale')}}">{{ trans('file.sale_report') }}</a>
                        </li>
                        @endcan
                    </ul>
                </li>

                <li>
                    @php
                    $requestIsOnSettingMenu = request()->is(
                    'role*',
                    'warehouse*',
                    'customer_group*',
                    'brand*',
                    'unit*',
                    'currency*',
                    'tax*',
                    'user/porfile*',
                    'setting/createsms*',
                    'backup*',
                    'setting/general_setting*',
                    'setting/mail_setting*',
                    )
                    ? 'true'
                    : 'false';
                    @endphp

                    @can('parentView', App\Setting::class)
                    <a href="#setting" aria-expanded="{{ $requestIsOnSettingMenu }}" data-toggle="collapse">
                        <i class="dripicons-gear"></i><span>{{ trans('file.settings') }}</span>
                    </a>
                    <ul id="setting" class="collapse list-unstyled @if ($requestIsOnSettingMenu === 'true') show @endif">
                        @can('viewAny', App\Role::class)
                        <li id="role-menu" class="@if (request()->is('role*')) active @endif">
                            <a href="{{ route('role.index') }}">{{ trans('file.Role Permission') }}</a>
                        </li>
                        @endcan

                        @can('sendNotication')
                        <li id="notification-menu">
                            <a href="" id="send-notification">{{ trans('file.Send Notification') }}</a>
                        </li>
                        @endcan

                        @can('viewany', App\Warehouse::class)
                        <li id="warehouse-menu" class="@if (request()->is('warehouse*')) active @endif">
                            <a href="{{ route('warehouse.index') }}">{{ trans('file.Warehouse') }}</a>
                        </li>
                        @endcan

                        @can('viewAny', App\CustomerGroup::class)
                        <li id="customer-group-menu" class="@if (request()->is('customer_group*')) active @endif">
                            <a href="{{ route('customer_group.index') }}">{{ trans('file.Customer Group') }}</a>
                        </li>
                        @endcan

                        {{-- @can('viewAny', App\Brand::class)
                        <li id="brand-menu" class="@if (request()->is('brand*')) active @endif">
                            <a href="{{ route('brand.index') }}">{{ trans('file.Brand') }}</a>
                        </li>
                        @endcan --}}

                        {{-- @can('viewAny', App\Unit::class)
                        <li id="unit-menu" class="@if (request()->is('unit*')) active @endif">
                            <a href="{{ route('unit.index') }}">{{ trans('file.Unit') }}</a>
                        </li>
                        @endcan

                        @can('viewAny', App\Currency::class)
                        <li id="currency-menu" class="@if (request()->is('currency*')) active @endif">
                            <a href="{{ route('currency.index') }}">{{ trans('file.Currency') }}</a>
                        </li>
                        @endcan --}}

                        @can('viewAny', App\Tax::class)
                        <li id="tax-menu" class="@if (request()->is('tax*')) active @endif">
                            <a href="{{ route('tax.index') }}">{{ trans('file.Tax') }}</a>
                        </li>
                        @endcan

                        <li id="user-menu" class="@if (request()->is('user/profile*')) active @endif">
                            <a href="{{ route('user.profile', ['id' => Auth::id()]) }}">{{ trans('file.User Profile')
                                }}</a>
                        </li>

                        {{-- @can('createSms')
                        <li id="create-sms-menu" class="@if (request()->is('setting/createsms*')) active @endif">
                            <a href="{{ route('setting.createSms') }}">{{ trans('file.Create SMS') }}</a>
                        </li>
                        @endcan --}}

                        {{-- @can('backUpDatabase')
                        <li class="@if (request()->is('backup*')) active @endif">
                            <a href="{{ route('setting.backup') }}">{{ trans('file.Backup Database') }}</a>
                        </li>
                        @endcan --}}

                        @can('viewAny', App\GeneralSetting::class)
                        <li id="general-setting-menu"
                            class="@if (request()->is('setting/general_setting*')) active @endif">
                            <a href="{{ route('setting.general') }}">{{ trans('file.General Setting') }}</a>
                        </li>
                        @endcan

                        {{-- @can('mailSetting')
                        <li id="mail-setting-menu" class="@if (request()->is('setting/mail_setting*')) active @endif">
                            <a href="{{ route('setting.mail') }}">{{ trans('file.Mail Setting') }}</a>
                        </li>
                        @endcan

                        @can('smsSetting')
                        <li id="sms-setting-menu" class="@if (request()->is('setting/sms_setting*')) active @endif">
                            <a href="{{ route('setting.sms') }}">{{ trans('file.SMS Setting') }}</a>
                        </li>
                        @endcan --}}

                        <li id="invoice-setting-menu"
                            class="@if (request()->is('setting/invoice_setting*')) active @endif">
                            <a href="{{ route('setting.invoice') }}">{{ trans('file.invoice_setting') }}</a>
                        </li>

                        @can('posSetting')
                        <li id="pos-setting-menu" class="@if (request()->is('setting/pos_setting*')) active @endif">
                            <a href="{{ route('setting.pos') }}">POS {{ trans('file.settings') }}</a>
                        </li>
                        @endcan

                        {{-- @can('viewAny', App\HrmSetting::class)
                        <li id="hrm-setting-menu" class="@if (request()->is('setting/hrm_setting*')) active @endif">
                            <a href="{{ route('setting.hrm') }}">{{ trans('file.HRM Setting') }}</a>
                        </li>
                        @endcan --}}
                    </ul>
                    @endcan
                </li>
            </ul>
        </div>
    </div>
</nav>
