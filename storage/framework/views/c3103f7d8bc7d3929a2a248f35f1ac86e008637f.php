<?php
use App\Http\Helpers\UserPermissionHelper;
$user = getRootUser();

$package = UserPermissionHelper::currentPackage($user->id);

if (!empty($package)) {
$packageHas = json_decode($package->features, true);
}

?>



<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h4 class="page-title">Roles</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="<?php echo e(route('user.dashboard')); ?>">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#"><?php echo e($role->name); ?></a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Permissions Management</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <div class="card-title d-inline-block">Permissions Management</div>
                <a class="btn btn-info btn-sm float-right d-inline-block" href="<?php echo e(route('user.role.index')); ?>">
                    <span class="btn-label">
                        <i class="fas fa-backward"></i>
                    </span>
                    Back
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form id="permissionsForm" class="" action="<?php echo e(route('user.role.permissions.update')); ?>"
                            method="post">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="role_id" value="<?php echo e(Request::route('id')); ?>">

                            <?php
                            $features = $role->permissions;
                            if (!empty($role->permissions)) {
                            $features = json_decode($features, true);
                            }
                            ?>

                            <div class="form-group">
                                <label class="form-label"><?php echo e(__('Permissions')); ?></label>
                                <div class="selectgroup selectgroup-pills">
                                    <?php if(is_array($packageHas) && (in_array('Custom Domain', $packageHas) || in_array('Subdomain', $packageHas))): ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="Domains & URLs"
                                            class="selectgroup-input"
                                            <?php if(is_array($features) && in_array('Domains & URLs', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('Domains & URLs')); ?></span>
                                    </label>
                                    <?php endif; ?>
                                    <?php if(is_array($packageHas) && in_array('POS', $packageHas)): ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="POS"
                                            class="selectgroup-input"
                                            <?php if(is_array($features) && in_array('POS', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('POS')); ?></span>
                                    </label>
                                    <?php endif; ?>
                                    <?php if(is_array($packageHas) && (in_array('Online Order', $packageHas))): ?>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="permissions[]" value="Order Management"
                                                    class="selectgroup-input"
                                                    <?php if(is_array($features) && in_array('Order Management', $features)): ?> checked <?php endif; ?>>
                                                <span class="selectgroup-button"><?php echo e(__('Order Management')); ?></span>
                                            </label>
                                    <?php endif; ?>


<!-- 
                                    <?php if(is_array($packageHas) && in_array('Online Order', $packageHas)): ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="Order Management" class="selectgroup-input"
                                            <?php if(is_array($features) && in_array('Order Management', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('Order Management')); ?></span>
                                    </label>

                                        <?php if(is_array($features) && in_array('Order Management', $features)): ?>
                                        <div class="ml-3">
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="permissions[]" value="Orders" class="selectgroup-input"
                                                    <?php if(is_array($features) && in_array('Orders', $features)): ?> checked <?php endif; ?>>
                                                <span class="selectgroup-button"><?php echo e(__('Orders')); ?></span>
                                            </label>
                                        </div>
                                        <?php endif; ?>
                                    <?php endif; ?> -->






                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="Items Management"
                                            class="selectgroup-input" <?php if(is_array($features) && in_array('Items Management', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('Items Management')); ?></span>
                                    </label>


                                    <?php if(is_array($packageHas) && in_array('QR Menu', $packageHas)): ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="QR Code Builder"
                                            class="selectgroup-input"
                                            <?php if(is_array($features) && in_array('QR Code Builder', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('QR Code Builder')); ?></span>
                                    </label>
                                    <?php endif; ?>
                                    <?php if(is_array($packageHas) && in_array('Table Reservation', $packageHas)): ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="Reservation Settings"
                                            class="selectgroup-input"
                                            <?php if(is_array($features) && in_array('Reservation Settings', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('Reservation Settings')); ?></span>
                                    </label>
                                    <?php endif; ?>
                                    <?php if(is_array($packageHas) && in_array('Custom Page', $packageHas)): ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="Custom Pages"
                                            class="selectgroup-input"
                                            <?php if(is_array($features) && in_array('Custom Pages', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('Custom Pages')); ?></span>
                                    </label>
                                    <?php endif; ?>
                                    <?php if(is_array($packageHas) && in_array('Table Reservation', $packageHas)): ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="Table Reservations"
                                            class="selectgroup-input"
                                            <?php if(is_array($features) && in_array('Table Reservations', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('Table Reservations')); ?></span>
                                    </label>
                                    <?php endif; ?>

                                    <?php if(is_array($packageHas) && in_array('Table QR Builder', $packageHas)): ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="Tables & QR Builder"
                                            class="selectgroup-input"
                                            <?php if(is_array($features) && in_array('Tables & QR Builder', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('Tables & QR Builder')); ?></span>
                                    </label>
                                    <?php else: ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="Tables & QR Builder"
                                            class="selectgroup-input"
                                            <?php if(is_array($features) && in_array('Tables & QR Builder', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('Tables')); ?></span>
                                    </label>
                                    <?php endif; ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="Drag & Drop Menu Builder"
                                            class="selectgroup-input" <?php if(is_array($features) && in_array('Drag & Drop Menu Builder', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('Drag & Drop Menu Builder')); ?></span>
                                    </label>
                                    <?php if(is_array($packageHas) && in_array('Custom page', $packageHas)): ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="Custom Pages"
                                            class="selectgroup-input"
                                            <?php if(is_array($features) && in_array('Custom Pages', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('Custom Pages')); ?></span>
                                    </label>
                                    <?php endif; ?>
                                    <?php if(is_array($packageHas) && in_array('Blog', $packageHas)): ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="Blog Management"
                                            class="selectgroup-input"
                                            <?php if(is_array($features) && in_array('Blog Management', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('Blog Management')); ?></span>
                                    </label>
                                    <?php endif; ?>

                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="Language Management"
                                            class="selectgroup-input"
                                            <?php if(is_array($features) && in_array('Language Management', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('Language Management')); ?></span>
                                    </label>

                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="Payment Gateways"
                                            class="selectgroup-input"
                                            <?php if(is_array($features) && in_array('Payment Gateways', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('Payment Gateways')); ?></span>
                                    </label>
                                    <?php if(is_array($packageHas) && (in_array('Online Order', $packageHas))): ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="Website Pages"
                                            class="selectgroup-input"
                                            <?php if(is_array($features) && in_array('Website Pages', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('Website Pages')); ?></span>
                                    </label>
                                    <?php endif; ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="Settings"
                                            class="selectgroup-input"
                                            <?php if(is_array($features) && in_array('Settings', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('Settings')); ?></span>
                                    </label>
                                    <?php if(is_array($packageHas) && in_array('Live Orders', $packageHas)): ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="Push Notification"
                                            class="selectgroup-input"
                                            <?php if(is_array($features) && in_array('Push Notification', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('Push Notification')); ?></span>
                                    </label>
                                    <?php endif; ?>
                                    <?php if(is_array($packageHas) && (in_array('Online Order', $packageHas))): ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="Subscribers"
                                            class="selectgroup-input"
                                            <?php if(is_array($features) && in_array('Subscribers', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('Subscribers')); ?></span>
                                    </label>
                                    <?php endif; ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="Announcement Popups"
                                            class="selectgroup-input"
                                            <?php if(is_array($features) && in_array('Announcement Popups', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('Announcement Popups')); ?></span>
                                    </label>
                                    <?php if(is_array($packageHas) && (in_array('Online Order', $packageHas) || in_array('POS', $packageHas))): ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="Customers"
                                            class="selectgroup-input"
                                            <?php if(is_array($features) && in_array('Customers', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('Customers')); ?></span>
                                    </label>
                                    <?php endif; ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="permissions[]" value="Sitemap"
                                            class="selectgroup-input"
                                            <?php if(is_array($features) && in_array('Sitemap', $features)): ?> checked <?php endif; ?>>
                                        <span class="selectgroup-button"><?php echo e(__('Sitemap')); ?></span>
                                    </label>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="form">
                    <div class="form-group from-show-notify row">
                        <div class="col-12 text-center">
                            <button type="submit" id="permissionBtn" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\BritBite-Company-England\britbite-git\britbite\resources\views/user/role/permission/manage.blade.php ENDPATH**/ ?>