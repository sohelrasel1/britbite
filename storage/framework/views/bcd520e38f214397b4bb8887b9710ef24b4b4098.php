<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Popups')); ?></h4>
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
        <a href="#"><?php echo e(__('Announcement Popup')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Popups')); ?></a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card-title d-inline-block"><?php echo e(__('Announcement Popups')); ?></div>
                </div>
                <div class="col-lg-3">
                    <?php if(!empty($langs)): ?>
                        <select name="language" class="form-control" onchange="window.location='<?php echo e(url()->current() . '?language='); ?>'+this.value">
                            <option value="" selected disabled><?php echo e(__('Select a Language')); ?></option>
                            <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($lang->code); ?>" <?php echo e($lang->code == request()->input('language') ? 'selected' : ''); ?>><?php echo e($lang->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
                    <a href="<?php echo e(route('admin.popup.types')); ?>" class="btn btn-primary float-right btn-sm"><i class="fas fa-plus"></i> <?php echo e(__('Add Popup')); ?></a>
                    <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete" data-href="<?php echo e(route('admin.popup.bulk.delete')); ?>"><i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?></button>
                </div>
            </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
       
              <?php if(count($adminpopups) == 0): ?>
                <h3 class="text-center"><?php echo e(__('NO POPUP FOUND')); ?></h3>
              <?php else: ?>
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="alert alert-warning text-dark">
                            All <strong class="text-info"><?php echo e(__('Activated Popups')); ?></strong> <?php echo e(__('will be shown in website according to')); ?> <strong class="text-info"><?php echo e(__('Serial Number')); ?></strong>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">
                            <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Image')); ?></th>
                        <th scope="col"><?php echo e(__('Name')); ?></th>
                        <th scope="col"><?php echo e(__('Status')); ?></th>
                        <th scope="col"><?php echo e(__('Type')); ?></th>
                        <th scope="col"><?php echo e(__('Serial Number')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $adminpopups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $popup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($popup->id); ?>">
                          </td>
                          <td>
                              <div class="mb-2">
                                  <?php if(!empty($popup->image)): ?>
                                      <img src="<?php echo e(asset('assets/front/img/popups/' . $popup->image)); ?>" width="65">
                                  <?php elseif(!empty($popup->background_image)): ?>
                                    <img src="<?php echo e(asset('assets/front/img/popups/' . $popup->background_image)); ?>" width="65">
                                  <?php endif; ?>
                              </div>
                          </td>
                          <td><?php echo e(strlen($popup->name) > 20 ? mb_substr($popup->name,0,20,'utf-8') . '...' : $popup->name); ?></td>
                          <td>
                            <form id="statusForm<?php echo e($popup->id); ?>" class="d-inline-block" action="<?php echo e(route('admin.popup.status')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="popup_id" value="<?php echo e($popup->id); ?>">
                                <select class="form-control form-control-sm
                                <?php if($popup->status == 1): ?>
                                  bg-success
                                <?php elseif($popup->status == 0): ?>
                                  bg-danger
                                <?php endif; ?>
                                " name="status" onchange="document.getElementById('statusForm<?php echo e($popup->id); ?>').submit();">
                                  <option value="1" <?php echo e($popup->status == 1 ? 'selected' : ''); ?>><?php echo e(__('Active')); ?></option>
                                  <option value="0" <?php echo e($popup->status == 0 ? 'selected' : ''); ?>><?php echo e(__('Deactive')); ?></option>
                                </select>
                              </form>
                          </td>
                          <td>
                              <img width="60" src="<?php echo e(asset('assets/admin/img/popups/popup-' . $popup->type . '.jpg')); ?>">
                              <p class="mb-0">
                                <?php echo e(__('Type')); ?> - <?php echo e($popup->type); ?>

                              </p>
                          </td>
                          <td><?php echo e($popup->serial_number); ?></td>
                          <td>
                            <a class="btn btn-secondary btn-sm my-2" href="<?php echo e(route('admin.popup.edit', $popup->id) . "?language=" . request()->input('language')); ?>">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                            </a>
                            <form class="deleteform d-inline-block" action="<?php echo e(route('admin.popup.delete')); ?>" method="post">
                              <?php echo csrf_field(); ?>
                              <input type="hidden" name="popup_id" value="<?php echo e($popup->id); ?>">
                              <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                <span class="btn-label">
                                  <i class="fas fa-trash"></i>
                                </span>
                              </button>
                            </form>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/admin/popups/index.blade.php ENDPATH**/ ?>