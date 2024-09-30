<?php $__env->startSection('content'); ?>
<div class="page-header">
   <h4 class="page-title"><?php echo e(__('Pages')); ?></h4>
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
         <a href="#"><?php echo e(__('Create Page')); ?></a>
      </li>
      <li class="separator">
         <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
         <a href="#"><?php echo e(__('Pages')); ?></a>
      </li>
   </ul>
</div>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header">
            <div class="card-title"><?php echo e(__('Create Page')); ?></div>
         </div>
         <div class="card-body pt-5 pb-4">
            <div class="row">
               <div class="col-lg-10 offset-lg-1">
                  <form id="ajaxForm" action="<?php echo e(route('admin.page.store')); ?>" method="post">
                     <?php echo csrf_field(); ?>
                     <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for=""><?php echo e(__('Language')); ?> **</label>
                              <select id="language" name="language_id" class="form-control">
                                 <option value="" selected disabled><?php echo e(__('Select a language')); ?></option>
                                 <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($lang->id); ?>"><?php echo e($lang->name); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                              <p id="errlanguage_id" class="mb-0 text-danger em"></p>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for=""><?php echo e(__('Name')); ?> **</label>
                              <input type="text" name="name" class="form-control" placeholder="<?php echo e(__('Enter Name')); ?>" value="">
                              <p id="errname" class="em text-danger mb-0"></p>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for=""><?php echo e(__('Title')); ?> **</label>
                              <input type="text" class="form-control" name="title" placeholder="<?php echo e(__('Enter Title')); ?>" value="">
                              <p id="errtitle" class="em text-danger mb-0"></p>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for=""><?php echo e(__('Status')); ?> **</label>
                              <select class="form-control ltr" name="status">
                                 <option value="1"><?php echo e(__('Active')); ?></option>
                                 <option value="0"><?php echo e(__('Deactive')); ?></option>
                              </select>
                              <p id="errstatus" class="em text-danger mb-0"></p>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for=""><?php echo e(__('Body')); ?> **</label>
                        <textarea id="body" class="form-control summernote" name="body" data-height="500"></textarea>
                        <p id="errbody" class="em text-danger mb-0"></p>
                     </div>
                     <div class="form-group">
                        <label><?php echo e(__('Meta Keywords')); ?></label>
                        <input class="form-control" name="meta_keywords" value="" placeholder="<?php echo e(__('Enter meta keywords')); ?>" data-role="tagsinput">
                     </div>
                     <div class="form-group">
                        <label><?php echo e(__('Meta Description')); ?></label>
                        <textarea class="form-control" name="meta_description" rows="5" placeholder="<?php echo e(__('Enter meta description')); ?>"></textarea>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="card-footer">
            <div class="form">
               <div class="form-group from-show-notify row">
                  <div class="col-12 text-center">
                     <button type="submit" id="submitBtn" class="btn btn-success"><?php echo e(__('Submit')); ?></button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\BritBite-Company-England\britbite-git\britbite\resources\views/admin/page/create.blade.php ENDPATH**/ ?>