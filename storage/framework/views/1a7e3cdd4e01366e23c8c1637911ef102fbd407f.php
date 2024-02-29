<?php
    $lims_expense_category_list = DB::table('expense_categories')->where('is_active', true)->get();
    $lims_warehouse_list = \App\Warehouse::when( auth()->user()->role_id > 2, fn($query) => $query->where('id', auth()->user()->warehouse_id) )
                            ->where('is_active', true)
                            ->get();
    $lims_account_list = \App\Account::where('is_active', true)->get();
?>

<?php $__env->startComponent('components.modal'); ?>
    <?php $__env->slot('title', trans('file.Add Account')); ?>
    <?php $__env->slot('id', 'expense-modal'); ?>
    
    <p class="italic">
        <small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small>
    </p>
    <?php echo Form::open(['route' => 'expenses.store', 'method' => 'post']); ?>

    <div class="row">
        <div class="col-md-6 form-group">
            <label><?php echo e(trans('file.Expense Category')); ?> *</label>
            <select name="expense_category_id" class="selectpicker form-control" required
                data-live-search="true" data-live-search-style="begins" title="Select Expense Category...">
                <?php $__currentLoopData = $lims_expense_category_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($expense_category->id); ?>">
                        <?php echo e($expense_category->name . ' (' . $expense_category->code . ')'); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-6 form-group">
            <label><?php echo e(trans('file.Warehouse')); ?> *</label>
            <select name="warehouse_id" class="selectpicker form-control" required data-live-search="true"
                data-live-search-style="begins" title="Select Warehouse...">
                <?php $__currentLoopData = $lims_warehouse_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-6 form-group">
            <label><?php echo e(trans('file.Amount')); ?> *</label>
            <input type="text" id="amountid" name="amount" step="any" required class="form-control">
        </div>
        <div class="col-md-6 form-group">
            <label> <?php echo e(trans('file.Account')); ?></label>
            <select class="form-control selectpicker" name="account_id">
                <?php $__currentLoopData = $lims_account_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if($account->is_default): ?> selected <?php endif; ?> value="<?php echo e($account->id); ?>">
                        <?php echo e($account->name); ?> [<?php echo e($account->account_no); ?>]
                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label><?php echo e(trans('file.Note')); ?></label>
        <textarea name="note" rows="3" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary"><?php echo e(trans('file.submit')); ?></button>
    </div>
    <?php echo e(Form::close()); ?>

   
<?php echo $__env->renderComponent(); ?>
<?php /**PATH D:\laragon\www\mlk-tokomas\resources\views/main_utilities/expense_modal.blade.php ENDPATH**/ ?>