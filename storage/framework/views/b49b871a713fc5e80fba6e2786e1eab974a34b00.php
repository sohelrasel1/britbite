<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Package Features')); ?></h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="<?php echo e(route('admin.dashboard')); ?>">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Packages Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Package Features')); ?></a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block"><?php echo e(__('Package Features')); ?></div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <form id="permissionsForm" class="" action="<?php echo e(route('admin.package.features')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="alert alert-warning">
                  <?php echo e(__('Only these selected features will be visible in frontend Pricing Section')); ?>

                </div>
                <div class="form-group">
                    <label class="form-label"><?php echo e(__('Package Features')); ?></label>
                    <div class="selectgroup selectgroup-pills">
                        <label class="selectgroup-item">
                            <input type="checkbox" name="features[]" value="Custom Domain" class="selectgroup-input" <?php if(is_array($features) && in_array('Custom Domain', $features)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('Custom Domain')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="checkbox" name="features[]" value="Subdomain" class="selectgroup-input" <?php if(is_array($features) && in_array('Subdomain', $features)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('Subdomain')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="checkbox" name="features[]" value="POS" class="selectgroup-input" <?php if(is_array($features) && in_array('POS', $features)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('POS')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="checkbox" name="features[]" value="Coupon" class="selectgroup-input" <?php if(is_array($features) && in_array('Coupon', $features)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('Coupon')); ?></span>
                        </label>
          
                        <label class="selectgroup-item">
                            <input type="checkbox" name="features[]" value="Live Orders" class="selectgroup-input" <?php if(is_array($features) && in_array('Live Orders', $features)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('Live Order')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="checkbox" name="features[]" value="Whatsapp Order & Notification" class="selectgroup-input" <?php if(is_array($features) && in_array('Whatsapp Order & Notification', $features)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('Whatsapp Order & Notification')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="checkbox" name="features[]" value="QR Menu" class="selectgroup-input" <?php if(is_array($features) && in_array('QR Menu', $features)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('QR Menu')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="checkbox" name="features[]" value="Table Reservation" class="selectgroup-input" <?php if(is_array($features) && in_array('Table Reservation', $features)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('Table Reservation')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="checkbox" name="features[]" value="Table QR Builder" class="selectgroup-input" <?php if(is_array($features) && in_array('Table QR Builder', $features)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('Table QR Builder')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="checkbox" name="features[]" value="Call Waiter" class="selectgroup-input" <?php if(is_array($features) && in_array('Call Waiter', $features)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('Call Waiter')); ?></span>
                        </label>
                       
                        <label class="selectgroup-item">
                            <input type="checkbox" name="features[]" value="Staffs" class="selectgroup-input" <?php if(is_array($features) && in_array('Staffs', $features)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('Staffs')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="checkbox" name="features[]" value="Blog" class="selectgroup-input" <?php if(is_array($features) && in_array('Blog', $features)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('Blog')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="checkbox" name="features[]" value="Custom Page" class="selectgroup-input" <?php if(is_array($features) && in_array('Custom Page', $features)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('Custom Page')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="checkbox" name="features[]" value="Online Order" class="selectgroup-input" <?php if(is_array($features) && in_array('Online Order', $features)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('Online Order')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="checkbox" name="features[]" value="On Table" class="selectgroup-input" <?php if(is_array($features) && in_array('On Table', $features)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('On Table')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="checkbox" name="features[]" value="Pick Up" class="selectgroup-input" <?php if(is_array($features) && in_array('Pick Up', $features)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('Pick Up')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="checkbox" name="features[]" value="Home Delivery" class="selectgroup-input" <?php if(is_array($features) && in_array('Home Delivery', $features)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('Home Delivery')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="checkbox" name="features[]" value="Postal Code Based Delivery Charge" class="selectgroup-input" <?php if(is_array($features) && in_array('Postal Code Based Delivery Charge', $features)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('Postal Code Based Delivery Charge')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="checkbox" name="features[]" value="PWA Installability" class="selectgroup-input" <?php if(is_array($features) && in_array('PWA Installability', $features)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('PWA Installability')); ?></span>
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
                <button type="submit" id="permissionBtn" class="btn btn-success"><?php echo e(__('Update')); ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/admin/packages/features.blade.php ENDPATH**/ ?>