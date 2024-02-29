
<?php
    $lims_expense_category_list = DB::table('expense_categories')->where('is_active', true)->get();
    $lims_warehouse_list = \App\Warehouse::when( auth()->user()->role_id > 2, fn($query) => $query->where('id', auth()->user()->warehouse_id) )
                            ->where('is_active', true)
                            ->get();
    $lims_account_list = \App\Account::where('is_active', true)->get();
?>

<?php $__env->startComponent('components.modal'); ?>
    <?php $__env->slot('title', trans('file.Account Statement') ); ?>
    <?php $__env->slot('id', 'account-statement-modal'); ?>
        
    <p class="italic">
        <small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small>
    </p>
    <?php echo Form::open(['route' => 'accounts.statement', 'method' => 'post']); ?>

    <div class="row">
        <div class="col-md-6 form-group">
            <label> <?php echo e(trans('file.Account')); ?></label>
            <select class="form-control selectpicker" name="account_id">
                <?php $__currentLoopData = $lims_account_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($account->id); ?>"><?php echo e($account->name); ?> [<?php echo e($account->account_no); ?>]</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-6 form-group">
            <label> <?php echo e(trans('file.Type')); ?></label>
            <select class="form-control selectpicker" name="type">
                <option value="0"><?php echo e(trans('file.All')); ?></option>
                <option value="1"><?php echo e(trans('file.Debit')); ?></option>
                <option value="2"><?php echo e(trans('file.Credit')); ?></option>
            </select>
        </div>
        <div class="col-md-12 form-group">
            <label><?php echo e(trans('file.Choose Your Date')); ?></label>
            <div class="input-group">
                <input type="text" class="daterangepicker-field form-control" required />
                <input type="hidden" name="start_date" />
                <input type="hidden" name="end_date" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary"><?php echo e(trans('file.submit')); ?></button>
    </div>
    <?php echo e(Form::close()); ?>

<?php echo $__env->renderComponent(); ?>

<?php /**PATH D:\laragon\www\mlk-tokomas\resources\views/main_utilities/account_statement_modal.blade.php ENDPATH**/ ?>