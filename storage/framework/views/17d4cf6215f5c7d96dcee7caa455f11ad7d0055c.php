<?php if(!empty($input->language) && $input->language->rtl == 1): ?>
<?php $__env->startSection('styles'); ?>
<style>
    form input,
    form textarea,
    form select {
        direction: rtl;
    }
    .nicEdit-main {
        direction: rtl;
        text-align: right;
    }
</style>
<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title">Form Builder</h4>
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
        <a href="#">Reservation Settings</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Form Builder</a>
      </li>
    </ul>
  </div>


      <div class="card">
        <div class="card-header">
          <div class="card-title">
              <div class="row">
                  <div class="col-lg-6">
                    Edit Input
                  </div>
                  <div class="col-lg-6 text-right">
                    <a class="btn btn-primary" href="<?php echo e(route('user.reservation.form') . '?language=' . request()->input('language')); ?>">Back</a>
                  </div>
              </div>
          </div>
        </div>

        <div class="card-body">
            <div class="row" id="app">

                <div class="col-lg-6 offset-lg-3">
                    <form id="ajaxForm" action="<?php echo e(route('user.reservation.inputUpdate')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="input_id" value="<?php echo e($input->id); ?>">
                        <input type="hidden" name="type" value="<?php echo e($input->type); ?>">

                        <div class="form-group">
                            <label>Required</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="required" value="1" class="selectgroup-input" <?php echo e($input->required == 1 ? 'checked' : ''); ?>>
                                    <span class="selectgroup-button">Yes</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="required" value="0" class="selectgroup-input" <?php echo e($input->required == 0 ? 'checked' : ''); ?>>
                                    <span class="selectgroup-button">No</span>
                                </label>
                            </div>
                            <p id="errrequired" class="mb-0 text-danger em"></p>
                        </div>


                        <div class="form-group">
                            <label for=""><strong>Label Name</strong></label>
                            <div class="">
                            <input type="text" class="form-control" name="label" value="<?php echo e($input->label); ?>" placeholder="Enter Label Name">
                            </div>
                            <p id="errlabel" class="mb-0 text-danger em"></p>
                        </div>


                        <?php if($input->type != 3): ?>
                            <div class="form-group">
                                <label for=""><strong>Placeholder</strong></label>
                                <div class="">
                                    <input type="text" class="form-control" name="placeholder" value="<?php echo e($input->placeholder); ?>" placeholder="Enter Placeholder">
                                </div>
                                <p id="errplaceholder" class="mb-0 text-danger em"></p>
                            </div>
                        <?php endif; ?>

                        <?php if($input->type == 2 || $input->type == 3): ?>
                            <div class="form-group">
                                <label for=""><strong>Options</strong></label>
                                <div class="row mb-2 counterrow" v-for="n in counter" :id="'counterrow'+n">
                                <div class="col-md-11">
                                    <input class="form-control optionin" type="text" name="options[]" :value="names[n-1]" placeholder="Option label">
                                </div>

                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger text-white" @click="removeOption(n)"><i class="fa fa-times"></i></button>
                                </div>
                                </div>
                                <button type="button" class="btn btn-success btn-sm text-white" @click="addOption()"><i class="fa fa-plus"></i> Add Option</button>
                                <p id="erroptions" class="mb-2 text-danger em"></p>
                                <p id="erroptions.3" class="mb-2 text-danger em"></p>
                            </div>
                        <?php endif; ?>


                        <div class="text-center form-group">
                        <button id="submitBtn" type="submit" class="btn btn-primary">UPDATE FIELD</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

      </div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('vuescripts'); ?>
<script>
  var counters = "<?php echo e($counter); ?>";
  var reservationRoute = "<?php echo e(route('user.reservation.options', $input->id)); ?>";
</script>
   <script src="<?php echo e(asset('assets/tenant/js/vue__edit_blade.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\BritBite-Company-England\britbite-git\britbite\resources\views/user/reservations/form-edit.blade.php ENDPATH**/ ?>