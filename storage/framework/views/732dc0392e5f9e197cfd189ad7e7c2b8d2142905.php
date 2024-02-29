<?php $__env->startComponent('components.modal'); ?>
    <?php $__env->slot('title', trans('file.Add Account')); ?>
    <?php $__env->slot('id', 'account-modal'); ?>
    
    <p class="italic">
        <small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small>
    </p>
    <?php echo Form::open(['route' => 'accounts.store', 'method' => 'post']); ?>

    <div class="form-group">
        <label><?php echo e(trans('file.Account No')); ?> *</label>
        <input type="text" name="account_no" required class="form-control">
    </div>
    <div class="form-group">
        <label><?php echo e(trans('file.name')); ?> *</label>
        <input type="text" name="name" required class="form-control">
    </div>
    <div class="form-group">
        <label><?php echo e(trans('file.Initial Balance')); ?></label>
        <input type="text" id="initial_balanceid" name="initial_balance" step="any"
            class="form-control">
    </div>
    <div class="form-group">
        <label><?php echo e(trans('file.Note')); ?></label>
        <textarea name="note" rows="3" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary"><?php echo e(trans('file.submit')); ?></button>
    </div>
    <?php echo e(Form::close()); ?>

<?php echo $__env->renderComponent(); ?><?php /**PATH D:\laragon\www\mlk-tokomas\resources\views/main_utilities/account_modal.blade.php ENDPATH**/ ?>