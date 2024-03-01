<header class="header">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
                <a id="toggle-btn" href="#" class="menu-btn"><i class="fa fa-bars"> </i></a>
                <span class="brand-big">
                    <?php if($general_setting->site_logo): ?>
                        <img src="<?php echo e(asset($general_setting->site_logo)); ?>" width="50">&nbsp;&nbsp;
                    <?php endif; ?>
                    <a href="<?php echo e(url('/')); ?>">
                        <h1 class="d-inline"><?php echo e($general_setting->site_title); ?></h1>
                    </a>
                </span>

                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Sale::class)): ?>
                    <li class="nav-item">
                        <a class="dropdown-item btn-pos btn-sm" href="<?php echo e(route('sale.pos')); ?>">
                            <i class="dripicons-shopping-bag"></i><span>POS</span>
                        </a>
                    </li>
                    <?php endif; ?>                        

                    <li class="nav-item"><a id="btnFullscreen"><i class="dripicons-expand"></i></a></li>
                    <?php if(\Auth::user()->role_id <= 2): ?>
                        <li class="nav-item"><a href="<?php echo e(route('cashRegister.index')); ?>"
                                title="<?php echo e(trans('file.Cash Register List')); ?>"><i
                                    class="dripicons-archive"></i></a></li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('report', App\Product::class)): ?>
                        <?php if($alert_product + count(\Auth::user()->unreadNotifications) > 0): ?>
                            <li class="nav-item" id="notification-icon">
                                <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item"><i
                                        class="dripicons-bell"></i><span
                                        class="badge badge-danger notification-number"><?php echo e($alert_product + count(\Auth::user()->unreadNotifications)); ?></span>
                                </a>
                                <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default notifications"
                                    user="menu">
                                    <li class="notifications">
                                        <a href="<?php echo e(route('report.qtyAlert')); ?>" class="btn btn-link">
                                            <?php echo e($alert_product); ?> product exceeds alert quantity</a>
                                    </li>
                                    <?php $__currentLoopData = \Auth::user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="notifications">
                                            <a href="#"
                                                class="btn btn-link"><?php echo e($notification->data['message']); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li>
                        <?php elseif(count(\Auth::user()->unreadNotifications) > 0): ?>
                            <li class="nav-item" id="notification-icon">
                                <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item"><i
                                        class="dripicons-bell"></i><span
                                        class="badge badge-danger notification-number"><?php echo e(count(\Auth::user()->unreadNotifications)); ?></span>
                                </a>
                                <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default notifications"
                                    user="menu">
                                    <?php $__currentLoopData = \Auth::user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="notifications">
                                            <a href="#"
                                                class="btn btn-link"><?php echo e($notification->data['message']); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                   
                    <li class="nav-item">
                        <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item"><i
                                class="dripicons-web"></i> <span><?php echo e(__('file.language')); ?></span> <i
                                class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default"
                            user="menu">
                            <li>
                                <a href="<?php echo e(url('language_switch/en')); ?>" class="btn btn-link"> English</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('language_switch/id')); ?>" class="btn btn-link"> Indonesia</a>
                            </li>
                        </ul>
                    </li>
                    <?php if(Auth::user()->role_id != 5): ?>
                        <li class="nav-item">
                            <a class="dropdown-item" href="<?php echo e(url('help')); ?>" target="_blank"><i
                                    class="dripicons-information"></i> <?php echo e(trans('file.Help')); ?></a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item"><i
                                class="dripicons-user"></i> <span><?php echo e(ucfirst(Auth::user()->name)); ?></span> <i
                                class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default"
                            user="menu">
                            <li>
                                <a href="<?php echo e(route('user.profile', ['id' => Auth::id()])); ?>">
                                    <i class="dripicons-user"></i> <?php echo e(trans('file.profile')); ?>

                                </a>
                            </li>
                            
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\GeneralSetting::class)): ?>
                            <li>
                                <a href="<?php echo e(route('setting.general')); ?>">
                                    <i class="dripicons-gear"></i><?php echo e(trans('file.settings')); ?>

                                </a>
                            </li>
                            <?php endif; ?>
                            <li>
                                <a href="<?php echo e(url('my-transactions/' . date('Y') . '/' . date('m'))); ?>">
                                    <i class="dripicons-swap"></i> <?php echo e(trans('file.My Transaction')); ?>

                                </a>
                            </li>
                            <?php if(Auth::user()->role_id != 5): ?>
                                <li>
                                    <a href="<?php echo e(url('holidays/my-holiday/' . date('Y') . '/' . date('m'))); ?>">
                                        <i class="dripicons-vibrate"></i> <?php echo e(trans('file.My Holiday')); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('emptyDatabase')): ?>
                            <li>
                                <a onclick="return confirm('Are you sure want to delete? If you do this all of your data will be lost.')"
                                    href="<?php echo e(route('setting.emptyDatabase')); ?>"><i
                                        class="dripicons-stack"></i> <?php echo e(trans('file.Empty Database')); ?></a>
                            </li>
                            <?php endif; ?>
                            
                            <li>
                                <a href="<?php echo e(route('logout')); ?>"
                                    onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();"><i
                                        class="dripicons-power"></i>
                                    <?php echo e(trans('file.logout')); ?>

                                </a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                    style="display: none;">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </li>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header><?php /**PATH D:\laragon\www\mlk-tokomas\resources\views/layout/navbar.blade.php ENDPATH**/ ?>