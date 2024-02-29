<?php $__env->startComponent('components.modal'); ?>
    <?php $__env->slot('title', trans('file.Supplier Report')); ?> 
    <?php $__env->slot('id', 'supplier-modal'); ?>

    <p class="italic">
        <small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small>
    </p>
    <?php
        $lims_supplier_list = DB::table('suppliers')->where('is_active', true)->get();
    ?>
    <?php echo Form::open(['route' => 'report.supplier', 'method' => 'post']); ?>

    <div class="form-group">
        <label><?php echo e(trans('file.Supplier')); ?> *</label>
        <select name="supplier_id" class="selectpicker form-control" required data-live-search="true"
            id="supplier-id" data-live-search-style="begins" title="Select Supplier...">
            <?php $__currentLoopData = $lims_supplier_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($supplier->id); ?>">
                    <?php echo e($supplier->name . ' (' . $supplier->phone_number . ')'); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <input type="hidden" name="start_date" value="<?php echo e(date('Y-m') . '-' . '01'); ?>" />
    <input type="hidden" name="end_date" value="<?php echo e(date('Y-m-d')); ?>" />

    <div class="form-group">
        <button type="submit" class="btn btn-primary"><?php echo e(trans('file.submit')); ?></button>
    </div>
    <?php echo e(Form::close()); ?>

<?php echo $__env->renderComponent(); ?><?php /**PATH D:\laragon\www\mlk-tokomas\resources\views/main_utilities/supplier_modal.blade.php ENDPATH**/ ?>