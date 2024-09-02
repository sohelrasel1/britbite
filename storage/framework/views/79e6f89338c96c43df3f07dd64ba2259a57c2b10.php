<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>


<?php $__env->startSection('pageHeading'); ?>
 <?php echo e($keywords['Reservation'] ??  __('Reservation')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-keywords', !empty($userSeo) ? $userSeo->reservation_meta_keywords : ''); ?>
<?php $__env->startSection('meta-description', !empty($userSeo) ? $userSeo->reservation_meta_description : ''); ?>
<?php $__env->startSection('content'); ?>

  <?php echo $__env->make('user-front.breadcrum',['title' => $upageHeading?->reservation_page_title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="reservation-2-area reservation-3-area book-reservation">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-bg pt-130 pb-120">
                        <div class="reservation-tree">
                            <img class="lazy" data-src="<?php echo e($userBe->table_section_img ? Uploader::getImageUrl(Constant::WEBSITE_IMAGE,$userBe->table_section_img,$userBs) : asset('assets/user/img/pata.png')); ?>" alt="">
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="section-title text-center">
                                    <span><?php echo e(convertUtf8($userBe->table_section_title)); ?>

                                        <img class="lazy" data-src="<?php echo e(asset('assets/front/img/title-icon.png')); ?>" alt=""></span>
                                    <h3 class="title"><?php echo e(convertUtf8($userBe->table_section_subtitle)); ?></h3>
                                </div>
                                <form action="<?php echo e(route('user.front.table.book',getParam())); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-box mt-20">
                                                <label><?php echo e($keywords["Full Name"] ?? __('Full Name')); ?> <span>**</span></label>
                                                <input type="text" placeholder="<?php echo e($keywords["Full Name"] ?? __('Full Name')); ?>" name="name"
                                                       value="<?php echo e(old('name')); ?>">
                                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-danger"><?php echo e(convertUtf8($message)); ?></p>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-box mt-20">
                                                <label><?php echo e($keywords["Email Address"] ?? __('Email Address')); ?> <span>**</span></label>
                                                <input type="text" placeholder="<?php echo e($keywords["Email Address"] ?? __('Email Address')); ?>" name="email"
                                                       value="<?php echo e(old('email')); ?>">
                                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-danger"><?php echo e(convertUtf8($message)); ?></p>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <?php $__currentLoopData = $inputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div
                                                class="<?php echo e($input->type == 4 || $input->type == 3 ? 'col-lg-12' : 'col-lg-6'); ?>">
                                                <div class="input-box mt-20">
                                                    <?php if($input->type == 1): ?>
                                                        <label><?php echo e(convertUtf8($input->label)); ?> <?php if($input->required == 1): ?>
                                                                <span>**</span>
                                                            <?php endif; ?>
                                                        </label>
                                                        <input name="<?php echo e($input->name); ?>" type="text"
                                                               value="<?php echo e(old("$input->name")); ?>"
                                                               placeholder="<?php echo e(convertUtf8($input->placeholder)); ?>">
                                                    <?php endif; ?>

                                                    <?php if($input->type == 2): ?>
                                                  
                                                        <label><?php echo e(convertUtf8($input->label)); ?> <?php if($input->required == 1): ?>
                                                                <span>**</span>
                                                            <?php endif; ?>
                                                        </label>
                                                        <select class="form-control" name="<?php echo e($input->name); ?>">
                                                            <option value="" selected disabled>
                                                                <?php echo e(convertUtf8($input->placeholder)); ?>

                                                            </option>
                                                            <?php $__currentLoopData = $input->reservation_input_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e(convertUtf8($option->name)); ?>"
                                                                    <?php echo e(old("$input->name") == convertUtf8($option->name) ? 'selected' : ''); ?>>
                                                                    <?php echo e(convertUtf8($option->name)); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    <?php endif; ?>

                                                    <?php if($input->type == 3): ?>
                                                        <label><?php echo e(convertUtf8($input->label)); ?> <?php if($input->required == 1): ?>
                                                                <span>**</span>
                                                            <?php endif; ?>
                                                        </label> <br>
                                                        <?php $__currentLoopData = $input->reservation_input_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div
                                                                class="custom-control custom-checkbox custom-control-inline">
                                                                <input type="checkbox"
                                                                       id="customCheckboxInline<?php echo e($option->id); ?>"
                                                                       name="<?php echo e($input->name); ?>[]"
                                                                       class="custom-control-input"
                                                                       value="<?php echo e(convertUtf8($option->name)); ?>"
                                                                    <?php echo e(is_array(old("$input->name")) && in_array(convertUtf8($option->name), old("$input->name")) ? 'checked' : ''); ?>>
                                                                <label class="custom-control-label"
                                                                       for="customCheckboxInline<?php echo e($option->id); ?>"><?php echo e(convertUtf8($option->name)); ?></label>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>

                                                    <?php if($input->type == 4): ?>
                                                        <label><?php echo e(convertUtf8($input->label)); ?> <?php if($input->required == 1): ?>
                                                                <span>**</span>
                                                            <?php endif; ?>
                                                        </label>
                                                        <textarea  name="<?php echo e($input->name); ?>" id="" cols="5" rows="3"
                                                                  placeholder="<?php echo e(convertUtf8($input->placeholder)); ?>"><?php echo e(old("$input->name")); ?></textarea>
                                                    <?php endif; ?>

                                                    <?php if($input->type == 5): ?>
                                                        <label><?php echo e(convertUtf8($input->label)); ?> <?php if($input->required == 1): ?>
                                                                <span>**</span>
                                                            <?php endif; ?>
                                                        </label>
                                                        <input class="datepicker" name="<?php echo e($input->name); ?>"
                                                               type="text" value="<?php echo e(old("$input->name")); ?>"
                                                               placeholder="<?php echo e(convertUtf8($input->placeholder)); ?>"
                                                               autocomplete="off">
                                                    <?php endif; ?>

                                                    <?php if($input->type == 6): ?>
                                                        <label><?php echo e(convertUtf8($input->label)); ?> <?php if($input->required == 1): ?>
                                                                <span>**</span>
                                                            <?php endif; ?>
                                                        </label>
                                                        <input class="timepicker" name="<?php echo e($input->name); ?>"
                                                               type="text" value="<?php echo e(old("$input->name")); ?>"
                                                               placeholder="<?php echo e(convertUtf8($input->placeholder)); ?>"
                                                               autocomplete="off">
                                                    <?php endif; ?>

                                                    <?php if($input->type == 7): ?>
                                                        <label><?php echo e(convertUtf8($input->label)); ?> <?php if($input->required == 1): ?>
                                                                <span>**</span>
                                                            <?php endif; ?>
                                                        </label>
                                                        <input name="<?php echo e($input->name); ?>" type="number"
                                                               value="<?php echo e(old("$input->name")); ?>"
                                                               placeholder="<?php echo e(convertUtf8($input->placeholder)); ?>"
                                                               autocomplete="off">
                                                    <?php endif; ?>

                                                    <?php if($errors->has("$input->name")): ?>
                                                        <p class="text-danger mb-0"><?php echo e($errors->first("$input->name")); ?>

                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                        <?php if($userBs->is_recaptcha == 1): ?>
                                            <div class="col-lg-12 mt-20 text-center">
                                                <div id="g-recaptcha" class="g-recaptcha d-inline-block"></div>
                                                <?php if($errors->has('g-recaptcha-response')): ?>
                                                    <?php
                                                        $errmsg = $errors->first('g-recaptcha-response');
                                                    ?>
                                                    <p class="text-danger mb-0"><?php echo e(__("$errmsg")); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="col-lg-12">
                                            <div class="book-btn text-center mt-20">
                                                <button class="main-btn main-btn-2"
                                                        type="submit"><?php echo e($keywords['Book Table'] ?? __('Book Table')); ?>

                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user-front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/user-front/fastfood/reservation.blade.php ENDPATH**/ ?>