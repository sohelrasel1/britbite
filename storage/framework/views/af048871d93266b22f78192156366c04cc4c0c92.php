<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>

<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($keywords['Contact'] ??  __('Contact')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-keywords', !empty($userSeo) ? $userSeo->contact_meta_keywords : ''); ?>
<?php $__env->startSection('meta-description', !empty($userSeo) ? $userSeo->contact_meta_description : ''); ?>
<?php $__env->startSection('content'); ?>
  

    <?php echo $__env->make('user-front.breadcrum',['title' => $upageHeading?->contact_page_title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <section class="contact-area pt-60 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-form pt-75">
                        <h4 class="comment-title"><?php echo e(convertUtf8($contact->contact_form_title)); ?></h4>
                        <form action="<?php echo e(route('user.front.sendmail',getParam())); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-form">
                                        <label><?php echo e($keywords["Your Name"] ?? __('Your Name')); ?> *</label>
                                        <input name="name" type="text">
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
                                <div class="col-md-6">
                                    <div class="single-form">
                                        <label><?php echo e($keywords["Email Address"] ?? __('Email Address')); ?> *</label>
                                        <input name="email" type="email">
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
                                <div class="col-md-12">
                                    <div class="single-form">
                                        <label><?php echo e($keywords["Subject"] ?? __('Subject')); ?> *</label>
                                        <input name="subject" type="text">
                                        <?php $__errorArgs = ['subject'];
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
                                <div class="col-md-12">

                                    <div class="single-form">
                                        <label><?php echo e($keywords["Write a message"] ?? __('Write a message')); ?> *</label>
                                        <textarea name="message"></textarea>
                                        <?php $__errorArgs = ['message'];
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

                                <?php if($userBs->is_recaptcha == 1): ?>
                                    <div class="col-lg-12">
                                        <div id="g-recaptcha" class="g-recaptcha d-inline-block"></div>
                                        <?php if($errors->has('g-recaptcha-response')): ?>
                                            <?php
                                                $errmsg = $errors->first('g-recaptcha-response');
                                            ?>
                                            <p class="text-danger mb-0"><?php echo e(__("$errmsg")); ?></p>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="col-md-12">
                                    <div class="single-form">
                                        <button type="submit"><?php echo e($keywords["Submit Now"] ?? __('Submit Now')); ?></button>
                                    </div> 
                                </div>
                            </div> 
                        </form>
                        <p class="form-message"></p>
                    </div> 
                </div>
                <div class="col-lg-3 col-sm-6 offset-lg-1">
                    <div class="contact-area-info">
                        <div class="title-area">
                            <h4 class="title"><?php echo e(convertUtf8($contact->contact_info_title)); ?></h4>
                            <p><?php echo e(convertUtf8($contact->contact_text)); ?></p>
                        </div>
                        <div class="contact-info-list">
                            <?php if(!empty($userBs->contact_address)): ?>
                                <div class="item mt-30">
                                    <i class="flaticon-placeholder"></i>
                                    <?php
                                        $addresses = explode(PHP_EOL, $userBs->contact_address);
                                    ?>
                                    <ul>
                                        <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="d-block mb-0"> <?php echo e(convertUtf8($address)); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <?php if(!empty($userBs->contact_mails)): ?>

                                <div class="item mt-30">
                                    <i class="flaticon-mail"></i>
                                    <ul>
                                        <?php
                                            $mails = explode(',', $userBs->contact_mails);
                                        ?>
                                        <?php $__currentLoopData = $mails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="d-block mb-0"><?php echo e($mail); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <?php if(!empty($userBs->contact_number)): ?>
                                <div class="item mt-30">
                                    <i class="flaticon-smartphone"></i>
                                    <ul>
                                        <?php
                                            $phones = explode(',', $userBs->contact_number);
                                        ?>
                                        <?php $__currentLoopData = $phones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="d-block mb-0"><?php echo e($phone); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user-front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/user-front/fastfood/contact.blade.php ENDPATH**/ ?>