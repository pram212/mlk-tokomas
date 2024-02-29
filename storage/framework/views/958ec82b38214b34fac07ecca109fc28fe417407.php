<?php $__env->startComponent('components.modal'); ?>
    <?php $__env->slot('title', trans('file.Customer Report')); ?>
    <?php $__env->slot('id', 'customer-modal'); ?>
    <p class="italic">
        <small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small>
    </p>
    <?php echo Form::open(['route' => 'report.customer', 'method' => 'post']); ?>

    <?php
        $lims_customer_list = DB::table('customers')->where('is_active', true)->get();
    ?>
    <div class="form-group">
        <label><?php echo e(trans('file.customer')); ?> *</label>
        <select name="customer_id" class="selectpicker form-control" required data-live-search="true" id="customer-id" data-live-search-style="begins" title="Select customer...">
            <?php $__currentLoopData = $lims_customer_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->name . ' (' . $customer->phone_number . ')'); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <input type="hidden" name="start_date" value="<?php echo e(date('Y-m') . '-' . '01'); ?>" />
    <input type="hidden" name="end_date" value="<?php echo e(date('Y-m-d')); ?>" />

    <div class="form-group">
        <button type="submit" class="btn btn-primary"><?php echo e(trans('file.submit')); ?></button>
    </div>
    <?php echo e(Form::close()); ?>

<?php echo $__env->renderComponent(); ?><?php /**PATH D:\laragon\www\mlk-tokomas\resources\views/main_utilities/customer_modal.blade.php ENDPATH**/ ?>