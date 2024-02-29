<nav class="side-navbar">
    <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
            <ul id="side-main-menu" class="side-menu list-unstyled">
                <li>
                    <a href="<?php echo e(url('/')); ?>">
                        <i class="dripicons-meter"></i><span><?php echo e(__('file.dashboard')); ?></span>
                    </a>
                </li>

                
                <li>
                    <?php
                        $requestIsOnProductCategoryMenu = request()->is(
                            'tagtype*',
                            'producttype*',
                            'productproperty*',
                            'gramasi*',
                        )
                            ? 'true'
                            : 'false';
                    ?>
                    <a href="#productcategory" data-toggle="collapse"
                        aria-expanded="<?php echo e($requestIsOnProductCategoryMenu); ?>">
                        <i class="dripicons-card"></i><span><?php echo e(__('file.Product Category')); ?></span>
                    </a>

                    <ul id="productcategory"
                        class="collapse list-unstyled <?php if($requestIsOnProductCategoryMenu === 'true'): ?> show <?php endif; ?>">
                        <li id="productcategory-list-menu" class="<?php if(request()->is('tagtype*')): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('tagtype.index')); ?>"><?php echo e(__('file.Tagging Type')); ?></a>
                        </li>
                        <li id="productcategory-list-menu" class="<?php if(request()->is('productproperty*')): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('productproperty.index')); ?>"><?php echo e(__('file.Product Property')); ?></a>
                        </li>
                        <li id="productcategory-list-menu" class="<?php if(request()->is('producttype*')): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('producttype.index')); ?>"><?php echo e(__('file.Product Type')); ?></a>
                        </li>
                        <li id="productcategory-list-menu" class="<?php if(request()->is('gramasi*')): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('gramasi.index')); ?>"><?php echo e(__('file.Gramasi List')); ?></a>
                        </li>
                    </ul>
                </li>
                

                <li>
                    <?php
                        $role = DB::table('roles')->find(Auth::user()->role_id);
                        $requestIsOnProductMenu = request()->is(
                            'products*',
                            'category*',
                            'qty_adjustment*',
                            'stock-count*',
                        )
                            ? 'true'
                            : 'false';
                    ?>
                    <a href="#product" data-toggle="collapse" aria-expanded="<?php echo e($requestIsOnProductMenu); ?>">
                        <i class="dripicons-list"></i><span><?php echo e(__('file.product')); ?></span><span>
                    </a>
                    <ul id="product" class="collapse list-unstyled <?php if($requestIsOnProductMenu === 'true'): ?> show <?php endif; ?>">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Category::class)): ?>
                            <li id="category-menu" class="<?php if(request()->is('category*')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('category.index')); ?>"><?php echo e(__('file.category')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Product::class)): ?>
                            <li id="product-list-menu" class="<?php if(request()->is('products/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('products.index')); ?>"><?php echo e(__('file.product_list')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Product::class)): ?>
                            <li id="product-create-menu" class="<?php if(request()->is('products/create')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('products.create')); ?>"><?php echo e(__('file.add_product')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('printBarcode', App\Product::class)): ?>
                            <li id="printBarcode-menu" class="<?php if(request()->is('products/print_barcode')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('product.printBarcode')); ?>"><?php echo e(__('file.print_barcode')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Adjustment::class)): ?>
                            <li id="adjustment-list-menu" class="<?php if(request()->is('adjustment/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('qty_adjustment.index')); ?>"><?php echo e(trans('file.Adjustment List')); ?></a>
                            </li>
                            <li id="adjustment-create-menu" class="<?php if(request()->is('adjustment/create')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('qty_adjustment.create')); ?>"><?php echo e(trans('file.Add Adjustment')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\StockCount::class)): ?>
                            <li id="stock-count-menu" class="<?php if(request()->is('stock-count/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('stock-count.index')); ?>"><?php echo e(trans('file.Stock Count')); ?></a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </li>

                <li>
                    <?php
                        $requestIsOnPurchaseMenu = request()->is('purchases*') ? 'true' : 'false';
                    ?>
                    <a href="#purchase" aria-expanded="<?php echo e($requestIsOnPurchaseMenu); ?>" data-toggle="collapse">
                        <i class="dripicons-card"></i><span><?php echo e(trans('file.Purchase')); ?></span>
                    </a>
                    <ul id="purchase" class="collapse list-unstyled <?php if($requestIsOnPurchaseMenu === 'true'): ?> show <?php endif; ?>">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Purchase::class)): ?>
                            <li id="purchase-list-menu" class="<?php if(request()->is('purchases/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('purchases.index')); ?>"><?php echo e(trans('file.Purchase List')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Purchase::class)): ?>
                            <li id="purchase-create-menu" class="<?php if(request()->is('purchases/create')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('purchases.create')); ?>"><?php echo e(trans('file.Add Purchase')); ?></a>
                            </li>
                            <li id="purchase-import-menu" class="<?php if(request()->is('purchases/purchase_by_csv')): ?> active <?php endif; ?>">
                                <a
                                    href="<?php echo e(url('purchases/purchase_by_csv')); ?>"><?php echo e(trans('file.Import Purchase By CSV')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

                <li>
                    <?php
                        $requestIsOnSalesMenu = request()->is('sales*') ? 'true' : 'false';
                    ?>
                    <a href="#sale" aria-expanded="<?php echo e($requestIsOnSalesMenu); ?>" data-toggle="collapse">
                        <i class="dripicons-cart"></i><span><?php echo e(trans('file.Sale')); ?></span>
                    </a>
                    <ul id="sale" class="collapse list-unstyled <?php if($requestIsOnSalesMenu === 'true'): ?> show <?php endif; ?>">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Sale::class)): ?>
                            <li id="sale-list-menu" class="<?php if(request()->is('sales/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('sales.index')); ?>"><?php echo e(trans('file.Sale List')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Sale::class)): ?>
                            <li class="<?php if(request()->is('sales/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('sale.pos')); ?>" target="_blank">POS</a>
                            </li>
                            <li id="sale-create-menu" class="<?php if(request()->is('sales/create')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('sales.create')); ?>"><?php echo e(trans('file.Add Sale')); ?></a>
                            </li>
                            <li id="sale-import-menu" class="<?php if(request()->is('sales/sale_by_csv')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(url('sales/sale_by_csv')); ?>"><?php echo e(trans('file.Import Sale By CSV')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\GiftCard::class)): ?>
                            <li id="gift-card-menu" class="<?php if(request()->is('gift_cards/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('gift_cards.index')); ?>"><?php echo e(trans('file.Gift Card List')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Coupon::class)): ?>
                            <li id="coupon-menu" class="<?php if(request()->is('coupons/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('coupons.index')); ?>"><?php echo e(trans('file.Coupon List')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Delivery::class)): ?>
                            <li id="delivery-menu" class="<?php if(request()->is('delivery/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('delivery.index')); ?>"><?php echo e(trans('file.Delivery List')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Expense::class)): ?>
                    <li>
                        <?php
                            $requestIsOnExpenseMenu = request()->is('expenses*') ? 'true' : 'false';
                        ?>
                        <a href="#expense" aria-expanded="<?php echo e($requestIsOnExpenseMenu); ?>" data-toggle="collapse">
                            <i class="dripicons-wallet"></i><span><?php echo e(trans('file.Expense')); ?></span>
                        </a>
                        <ul id="expense" class="collapse list-unstyled <?php if($requestIsOnExpenseMenu === 'true'): ?> show <?php endif; ?> ">
                            <li id="exp-cat-menu" class="<?php if(request()->is('expense_categories/')): ?> active <?php endif; ?>">
                                <a
                                    href="<?php echo e(route('expense_categories.index')); ?>"><?php echo e(trans('file.Expense Category')); ?></a>
                            </li>
                            <li id="exp-list-menu" class="<?php if(request()->is('expenses/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('expenses.index')); ?>"><?php echo e(trans('file.Expense List')); ?></a>
                            </li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Expense::class)): ?>
                                <li class="<?php if(request()->is('expenses/create')): ?> active <?php endif; ?>">>
                                    <a id="add-expense" href=""> <?php echo e(trans('file.Add Expense')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Quotation::class)): ?>
                    <li>
                        <?php
                            $requestIsOnQuotationMenu = request()->is('quotations*') ? 'true' : 'false';
                        ?>
                        <a href="#quotation" aria-expanded="<?php echo e($requestIsOnQuotationMenu); ?>" data-toggle="collapse">
                            <i class="dripicons-document"></i><span><?php echo e(trans('file.Quotation')); ?></span><span>
                        </a>

                        <ul id="quotation" class="collapse list-unstyled <?php if($requestIsOnQuotationMenu === 'true'): ?> show <?php endif; ?>">
                            <li class="<?php if(request()->is('quotations/')): ?> active <?php endif; ?>"">
                                <a href="<?php echo e(route('quotations.index')); ?>"><?php echo e(trans('file.Quotation List')); ?></a>
                            </li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Quotation::class)): ?>
                                <li class="<?php if(request()->is('quotations/create')): ?> active <?php endif; ?>">
                                    <a href="<?php echo e(route('quotations.create')); ?>"><?php echo e(trans('file.Add Quotation')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <li>
                    <?php
                        $requestIsOnTransferMenu = request()->is('transfers*') ? 'true' : 'false';
                    ?>
                    <a href="#transfer" aria-expanded="<?php echo e($requestIsOnTransferMenu); ?>" data-toggle="collapse">
                        <i class="dripicons-export"></i><span><?php echo e(trans('file.Transfer')); ?></span>
                    </a>
                    <ul id="transfer" class="collapse list-unstyled <?php if($requestIsOnTransferMenu === 'true'): ?> show <?php endif; ?>">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Transfer::class)): ?>
                            <li class="<?php if(request()->is('transfers.index')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('transfers.index')); ?>"><?php echo e(trans('file.Transfer List')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Transfer::class)): ?>
                            <li class="<?php if(request()->is('transfers/create')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('transfers.create')); ?>"><?php echo e(trans('file.Add Transfer')); ?></a>
                            </li>
                            <li class="<?php if(request()->is('transfers/transfer_by_csv')): ?> active <?php endif; ?>">
                                <a
                                    href="<?php echo e(url('transfers/transfer_by_csv')); ?>"><?php echo e(trans('file.Import Transfer By CSV')); ?></a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </li>

                <li>
                    <?php
                        $requestIsOnReturnMenu = request()->is('return*') ? 'true' : 'false';
                    ?>
                    <a href="#return" aria-expanded="<?php echo e($requestIsOnReturnMenu); ?>" data-toggle="collapse">
                        <i class="dripicons-return"></i><span><?php echo e(trans('file.return')); ?></span>
                    </a>
                    <ul id="return" class="collapse list-unstyled <?php if($requestIsOnReturnMenu === 'true'): ?> show <?php endif; ?>">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('return', App\Sale::class)): ?>
                            <li class="<?php if(request()->is('return-sale*')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('return-sale.index')); ?>"><?php echo e(trans('file.Sale')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('return', App\Purchase::class)): ?>
                            <li id="purchase-return-menu" class="<?php if(request()->is('return-purchase*')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('return-purchase.index')); ?>"><?php echo e(trans('file.Purchase')); ?></a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </li>

                <li>
                    <?php
                        $requestIsOnAccountingMenu = request()->is('accounts*', 'money-transfers*', 'balancesheet*')
                            ? 'true'
                            : 'false';
                    ?>
                    <a href="#account" aria-expanded="<?php echo e($requestIsOnAccountingMenu); ?>" data-toggle="collapse">
                        <i class="dripicons-briefcase"></i><span><?php echo e(trans('file.Accounting')); ?></span>
                    </a>
                    <ul id="account" class="collapse list-unstyled <?php if($requestIsOnAccountingMenu === 'true'): ?> show <?php endif; ?>">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Account::class)): ?>
                            <li class="<?php if(request()->is('accounts/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('accounts.index')); ?>"><?php echo e(trans('file.Account List')); ?></a>
                            </li>
                            <li class="<?php if(request()->is('accounts/create')): ?> active <?php endif; ?>">
                                <a id="add-account" href="#"><?php echo e(trans('file.Add Account')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\MoneyTransfer::class)): ?>
                            <li class="<?php if(request()->is('money-transfer/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('money-transfers.index')); ?>"><?php echo e(trans('file.Money Transfer')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewBalanceSheet', App\Account::class)): ?>
                            <li class="<?php if(request()->is('accounts/balancesheet/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('accounts.balancesheet')); ?>"><?php echo e(trans('file.Balance Sheet')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewStatement', App\Account::class)): ?>
                            <li class="<?php if(request()->is('accounts/statement/')): ?> active <?php endif; ?>">
                                <a id="account-statement" href=""><?php echo e(trans('file.Account Statement')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

                <?php if(Auth::user()->role_id != 5): ?>
                    <li>
                        <?php
                            $requestIsOnHRMMenu = request()->is(
                                'departments*',
                                'employees*',
                                'attendance*',
                                'payroll*',
                                'holidays*',
                            )
                                ? 'true'
                                : 'false';
                        ?>
                        <a href="#hrm" aria-expanded="<?php echo e($requestIsOnHRMMenu); ?>" data-toggle="collapse">
                            <i class="dripicons-user-group"></i><span>HRM</span>
                        </a>
                        <ul id="hrm"
                            class="collapse list-unstyled <?php if($requestIsOnHRMMenu === 'true'): ?> show <?php endif; ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewany', App\Department::class)): ?>
                                <li id="dept-menu" class="<?php if(request()->is('departments*')): ?> active <?php endif; ?>">
                                    <a href="<?php echo e(route('departments.index')); ?>"><?php echo e(trans('file.Department')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Employee::class)): ?>
                                <li id="employee-menu" class="<?php if(request()->is('employees*')): ?> active <?php endif; ?>">
                                    <a href="<?php echo e(route('employees.index')); ?>"><?php echo e(trans('file.Employee')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Attendance::class)): ?>
                                <li id="attendance-menu" class="<?php if(request()->is('attendance*')): ?> active <?php endif; ?>">
                                    <a href="<?php echo e(route('attendance.index')); ?>"><?php echo e(trans('file.Attendance')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Payroll::class)): ?>
                                <li id="payroll-menu" class="<?php if(request()->is('payroll*')): ?> active <?php endif; ?>">
                                    <a href="<?php echo e(route('payroll.index')); ?>"><?php echo e(trans('file.Payroll')); ?></a>
                                </li>
                            <?php endif; ?>

                            <li id="holiday-menu" class="<?php if(request()->is('holidays*')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('holidays.index')); ?>"><?php echo e(trans('file.Holiday')); ?></a>
                            </li>

                        </ul>
                    </li>
                <?php endif; ?>

                <?php
                    // user permission query original
                    $user_index_permission_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'users-index'], ['role_id', $role->id]])
                        ->first();
                ?>

                <li>
                    <?php
                        $requestIsOnPeopleMenu = request()->is('accounts*', 'money-transfers*', 'balancesheet*')
                            ? 'true'
                            : 'false';
                    ?>
                    <a href="#people" aria-expanded="<?php echo e($requestIsOnPeopleMenu); ?>" data-toggle="collapse">
                        <i class="dripicons-user"></i><span><?php echo e(trans('file.People')); ?></span>
                    </a>
                    <ul id="people" class="collapse list-unstyled <?php if($requestIsOnPeopleMenu === 'true'): ?> show <?php endif; ?>">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\User::class)): ?>
                            <li id="user-list-menu" class="<?php if(request()->is('user/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('user.index')); ?>"><?php echo e(trans('file.User List')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\User::class)): ?>
                            <li id="user-create-menu" class="<?php if(request()->is('user/create/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('user.create')); ?>"><?php echo e(trans('file.Add User')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Customer::class)): ?>
                            <li id="customer-list-menu" class="<?php if(request()->is('customer/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('customer.index')); ?>"><?php echo e(trans('file.Customer List')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Customer::class)): ?>
                            <li id="customer-create-menu" class="<?php if(request()->is('customer/create/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('customer.create')); ?>"><?php echo e(trans('file.Add Customer')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Biller::class)): ?>
                            <li id="biller-list-menu" class="<?php if(request()->is('biller/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('biller.index')); ?>"><?php echo e(trans('file.Biller List')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Biller::class)): ?>
                            <li id="biller-create-menu" class="<?php if(request()->is('biller/create/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('biller.create')); ?>"><?php echo e(trans('file.Add Biller')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Supplier::class)): ?>
                            <li id="supplier-list-menu" class="<?php if(request()->is('supplier/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('supplier.index')); ?>"><?php echo e(trans('file.Supplier List')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Supplier::class)): ?>
                            <li id="supplier-create-menu" class="<?php if(request()->is('supplier/create/')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('supplier.create')); ?>"><?php echo e(trans('file.Add Supplier')); ?></a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </li>

                <li>
                    <?php
                        $requestIsOnReportMenu = request()->is('report*') ? 'true' : 'false';
                    ?>
                    <a href="#report" aria-expanded="<?php echo e($requestIsOnReportMenu); ?>" data-toggle="collapse">
                        <i class="dripicons-document-remove"></i><span><?php echo e(trans('file.Reports')); ?></span>
                    </a>
                    <ul id="report" class="collapse list-unstyled <?php if($requestIsOnReportMenu === 'true'): ?> show <?php endif; ?>">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewProfitLoss')): ?>
                            <li id="profit-loss-report-menu">
                                <?php echo Form::open(['route' => 'report.profitLoss', 'method' => 'post', 'id' => 'profitLoss-report-form']); ?>

                                <input type="hidden" name="start_date" value="<?php echo e(date('Y-m') . '-' . '01'); ?>" />
                                <input type="hidden" name="end_date" value="<?php echo e(date('Y-m-d')); ?>" />
                                <a id="profitLoss-link" href=""><?php echo e(trans('file.Summary Report')); ?></a>
                                <?php echo Form::close(); ?>

                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewBestSeller')): ?>
                            <li id="best-seller-report-menu" class="<?php if(request()->is('report/best_seller*')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(url('report/best_seller')); ?>"><?php echo e(trans('file.Best Seller')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('report', App\Product::class)): ?>
                            <li id="product-report-menu">
                                <?php echo Form::open(['route' => 'report.product', 'method' => 'post', 'id' => 'product-report-form']); ?>

                                <input type="hidden" name="start_date" value="<?php echo e(date('Y-m') . '-' . '01'); ?>" />
                                <input type="hidden" name="end_date" value="<?php echo e(date('Y-m-d')); ?>" />
                                <input type="hidden" name="warehouse_id" value="0" />
                                <a id="report-link" href=""><?php echo e(trans('file.Product Report')); ?></a>
                                <?php echo Form::close(); ?>

                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dailyReport', App\Sale::class)): ?>
                            <li id="daily-sale-report-menu" class="<?php if(request()->is('report/daily_sale*')): ?> active <?php endif; ?>">
                                <a
                                    href="<?php echo e(url('report/daily_sale/' . date('Y') . '/' . date('m'))); ?>"><?php echo e(trans('file.Daily Sale')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('monthlyReport', App\Sale::class)): ?>
                            <li id="monthly-sale-report-menu" class="<?php if(request()->is('report/monthly_sale*')): ?> active <?php endif; ?>">
                                <a
                                    href="<?php echo e(url('report/monthly_sale/' . date('Y'))); ?>"><?php echo e(trans('file.Monthly Sale')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dailyReport', App\Purchase::class)): ?>
                            <li id="daily-purchase-report-menu" class="<?php if(request()->is('report/daily_purchase*')): ?> active <?php endif; ?>">
                                <a
                                    href="<?php echo e(url('report/daily_purchase/' . date('Y') . '/' . date('m'))); ?>"><?php echo e(trans('file.Daily Purchase')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('monthlyReport', App\Purchase::class)): ?>
                            <li id="monthly-purchase-report-menu"
                                class="<?php if(request()->is('report/monthly_purchase*')): ?> active <?php endif; ?>">
                                <a
                                    href="<?php echo e(url('report/monthly_purchase/' . date('Y'))); ?>"><?php echo e(trans('file.Monthly Purchase')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('report', App\Sale::class)): ?>
                            <li id="sale-report-menu">
                                <?php echo Form::open(['route' => 'report.sale', 'method' => 'post', 'id' => 'sale-report-form']); ?>

                                <input type="hidden" name="start_date" value="<?php echo e(date('Y-m') . '-' . '01'); ?>" />
                                <input type="hidden" name="end_date" value="<?php echo e(date('Y-m-d')); ?>" />
                                <input type="hidden" name="warehouse_id" value="0" />
                                <a id="sale-report-link" href=""><?php echo e(trans('file.Sale Report')); ?></a>
                                <?php echo Form::close(); ?>

                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('report', App\Payment::class)): ?>
                            <li id="payment-report-menu">
                                <?php echo Form::open(['route' => 'report.paymentByDate', 'method' => 'post', 'id' => 'payment-report-form']); ?>

                                <input type="hidden" name="start_date" value="<?php echo e(date('Y-m') . '-' . '01'); ?>" />
                                <input type="hidden" name="end_date" value="<?php echo e(date('Y-m-d')); ?>" />
                                <a id="payment-report-link" href=""><?php echo e(trans('file.Payment Report')); ?></a>
                                <?php echo Form::close(); ?>

                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('report', App\Purchase::class)): ?>
                            <li id="purchase-report-menu">
                                <?php echo Form::open(['route' => 'report.purchase', 'method' => 'post', 'id' => 'purchase-report-form']); ?>

                                <input type="hidden" name="start_date" value="<?php echo e(date('Y-m') . '-' . '01'); ?>" />
                                <input type="hidden" name="end_date" value="<?php echo e(date('Y-m-d')); ?>" />
                                <input type="hidden" name="warehouse_id" value="0" />
                                <a id="purchase-report-link" href=""><?php echo e(trans('file.Purchase Report')); ?></a>
                                <?php echo Form::close(); ?>

                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('report', App\Warehouse::class)): ?>
                            <li id="warehouse-report-menu">
                                <a id="warehouse-report-link" href=""><?php echo e(trans('file.Warehouse Report')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('stockReport', App\Warehouse::class)): ?>
                            <li id="warehouse-stock-report-menu"
                                class="<?php if(request()->is('report/warehouse_stock*')): ?> active <?php endif; ?>">
                                <a
                                    href="<?php echo e(route('report.warehouseStock')); ?>"><?php echo e(trans('file.Warehouse Stock Chart')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewProdukQtyAlert', App\Producr::class)): ?>
                            <li id="qtyAlert-report-menu" class="<?php if(request()->is('report/product_quantity_alert*')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('report.qtyAlert')); ?>"><?php echo e(trans('file.Product Quantity Alert')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('report', App\User::class)): ?>
                            <li id="user-report-menu">
                                <a id="user-report-link" href=""><?php echo e(trans('file.User Report')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('report', App\Customer::class)): ?>
                            <li id="customer-report-menu">
                                <a id="customer-report-link" href=""><?php echo e(trans('file.Customer Report')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('report', App\Supplier::class)): ?>
                            <li id="supplier-report-menu">
                                <a id="supplier-report-link" href=""><?php echo e(trans('file.Supplier Report')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewDue')): ?>
                            <li id="due-report-menu">
                                <?php echo Form::open(['route' => 'report.dueByDate', 'method' => 'post', 'id' => 'due-report-form']); ?>

                                <input type="hidden" name="start_date" value="<?php echo e(date('Y-m') . '-' . '01'); ?>" />
                                <input type="hidden" name="end_date" value="<?php echo e(date('Y-m-d')); ?>" />
                                <a id="due-report-link" href=""><?php echo e(trans('file.Due Report')); ?></a>
                                <?php echo Form::close(); ?>

                            </li>
                        <?php endif; ?>

                    </ul>
                </li>

                <li>
                    <?php
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
                    ?>
                    <a href="#setting" aria-expanded="<?php echo e($requestIsOnSettingMenu); ?>" data-toggle="collapse">
                        <i class="dripicons-gear"></i><span><?php echo e(trans('file.settings')); ?></span>
                    </a>
                    <ul id="setting" class="collapse list-unstyled <?php if($requestIsOnSettingMenu === 'true'): ?> show <?php endif; ?>">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Role::class)): ?>
                            <li id="role-menu" class="<?php if(request()->is('role*')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('role.index')); ?>"><?php echo e(trans('file.Role Permission')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sendNotication')): ?>
                            <li id="notification-menu">
                                <a href="" id="send-notification"><?php echo e(trans('file.Send Notification')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewany', App\Warehouse::class)): ?>
                            <li id="warehouse-menu" class="<?php if(request()->is('warehouse*')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('warehouse.index')); ?>"><?php echo e(trans('file.Warehouse')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\CustomerGroup::class)): ?>
                            <li id="customer-group-menu" class="<?php if(request()->is('customer_group*')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('customer_group.index')); ?>"><?php echo e(trans('file.Customer Group')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Brand::class)): ?>
                            <li id="brand-menu" class="<?php if(request()->is('brand*')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('brand.index')); ?>"><?php echo e(trans('file.Brand')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Unit::class)): ?>
                            <li id="unit-menu" class="<?php if(request()->is('unit*')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('unit.index')); ?>"><?php echo e(trans('file.Unit')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Currency::class)): ?>
                            <li id="currency-menu" class="<?php if(request()->is('currency*')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('currency.index')); ?>"><?php echo e(trans('file.Currency')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Tax::class)): ?>
                            <li id="tax-menu" class="<?php if(request()->is('tax*')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('tax.index')); ?>"><?php echo e(trans('file.Tax')); ?></a>
                            </li>
                        <?php endif; ?>

                        <li id="user-menu" class="<?php if(request()->is('user/profile*')): ?> active <?php endif; ?>">
                            <a
                                href="<?php echo e(route('user.profile', ['id' => Auth::id()])); ?>"><?php echo e(trans('file.User Profile')); ?></a>
                        </li>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('createSms')): ?>
                            <li id="create-sms-menu" class="<?php if(request()->is('setting/createsms*')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('setting.createSms')); ?>"><?php echo e(trans('file.Create SMS')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('backUpDatabase')): ?>
                            <li class="<?php if(request()->is('backup*')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('setting.backup')); ?>"><?php echo e(trans('file.Backup Database')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\GeneralSetting::class)): ?>
                            <li id="general-setting-menu" class="<?php if(request()->is('setting/general_setting*')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('setting.general')); ?>"><?php echo e(trans('file.General Setting')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('mailSetting')): ?>
                            <li id="mail-setting-menu" class="<?php if(request()->is('setting/mail_setting*')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('setting.mail')); ?>"><?php echo e(trans('file.Mail Setting')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('smsSetting')): ?>
                            <li id="sms-setting-menu" class="<?php if(request()->is('setting/sms_setting*')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('setting.sms')); ?>"><?php echo e(trans('file.SMS Setting')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('posSetting')): ?>
                            <li id="pos-setting-menu" class="<?php if(request()->is('setting/pos_setting*')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('setting.pos')); ?>">POS <?php echo e(trans('file.settings')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\HrmSetting::class)): ?>
                            <li id="hrm-setting-menu" class="<?php if(request()->is('setting/hrm_setting*')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('setting.hrm')); ?>"><?php echo e(trans('file.HRM Setting')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH D:\laragon\www\mlk-tokomas\resources\views/layout/sidebar.blade.php ENDPATH**/ ?>