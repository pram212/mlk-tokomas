<?php

namespace App\Providers;

use App\Policies\MoneyTransferPolicy;
use App\Policies\AdjustmentPolicy;
use App\Policies\AttendancePolicy;
use App\Policies\DepartmentPolicy;
use App\Policies\StockCountPolicy;
use App\Policies\QuotationPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\DeliveryPolicy;
use App\Policies\EmployeePolicy;
use App\Policies\GiftCardPolicy;
use App\Policies\PurchasePolicy;
use App\Policies\SupplierPolicy;
use App\Policies\TransferPolicy;
use App\Policies\AccountPolicy;
use App\Policies\ExpensePolicy;
use App\Policies\PayrollPolicy;
use App\Policies\ProductPolicy;
use App\Policies\BillerPolicy;
use App\Policies\CouponPolicy;
use App\Policies\SalePolicy;
use App\Policies\UserPolicy;
use App\MoneyTransfer;
use App\Adjustment;
use App\Attendance;
use App\Department;
use App\StockCount;
use App\Quotation;
use App\Category;
use App\Customer;
use App\Delivery;
use App\Employee;
use App\GiftCard;
use App\Purchase;
use App\Supplier;
use App\Transfer;
use App\Account;
use App\Expense;
use App\Payroll;
use App\Product;
use App\Biller;
use App\Brand;
use App\Coupon;
use App\CustomerGroup;
use App\Payment;
use App\Policies\BrandPolicy;
use App\Policies\CustomerGroupPolicy;
use App\Policies\PaymentPolicy;
use App\Policies\ReportPolicy;
use App\Policies\RolePolicy;
use App\Policies\SettingPolicy;
use App\Policies\TaxPolicy;
use App\Policies\UnitPolicy;
use App\Policies\WarehousePolicy;
use App\User;
use App\Sale;
use App\Tax;
use App\Unit;
use App\Warehouse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        MoneyTransfer::class => MoneyTransferPolicy::class,
        CustomerGroup::class => CustomerGroupPolicy::class,
        Adjustment::class => AdjustmentPolicy::class,
        Attendance::class => AttendancePolicy::class,
        Department::class => DepartmentPolicy::class,
        StockCount::class => StockCountPolicy::class,
        Warehouse::class => WarehousePolicy::class,
        Quotation::class => QuotationPolicy::class,
        Category::class => CategoryPolicy::class,
        Customer::class => CustomerPolicy::class,
        Delivery::class => DeliveryPolicy::class,
        Employee::class => EmployeePolicy::class,
        GiftCard::class => GiftCardPolicy::class,
        Purchase::class => PurchasePolicy::class,
        Transfer::class => TransferPolicy::class,
        Supplier::class => SupplierPolicy::class,
        Account::class => AccountPolicy::class,
        Product::class => ProductPolicy::class,
        Expense::class => ExpensePolicy::class,
        Payroll::class => PayrollPolicy::class,
        Payment::class => PaymentPolicy::class,
        Coupon::class => CouponPolicy::class,
        Biller::class => BillerPolicy::class,
        Brand::class => BrandPolicy::class,
        Unit::class => UnitPolicy::class,
        Sale::class => SalePolicy::class,
        Role::class => RolePolicy::class,
        User::class => UserPolicy::class,
        Tax::class => TaxPolicy::class,
        SettingPolicy::class,
        ReportPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
