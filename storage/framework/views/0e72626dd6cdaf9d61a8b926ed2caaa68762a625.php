<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>

<?php $__env->startSection('pageHeading'); ?>
    <?php echo e($keywords['Forgot'] ?? __('Forgot')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-keywords', !empty($userSeo) ? $userSeo->forget_password_meta_keywords : ''); ?>
<?php $__env->startSection('meta-description', !empty($userSeo) ? $userSeo->forget_password_meta_description : ''); ?>
<?php $__env->startSection('content'); ?>
    <section class="page-title-area d-flex align-items-center"
        style="background-image: url('<?php echo e($userBs->breadcrumb ? Uploader::getImageUrl(Constant::WEBSITE_BREADCRUMB, $userBs->breadcrumb, $userBs) : asset('assets/restaurant/images/breadcrum.jpg')); ?>');background-size:cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-item text-center">
                        <h2 class="title"><?php echo e($upageHeading?->forget_password_page_title); ?></h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('user.client.dashboard', getParam())); ?>"><i
                                            class="flaticon-home"></i><?php echo e($keywords['Dashboard'] ?? __('Dashboard')); ?></a>
                                </li>
                                <?php if($upageHeading?->forget_password_page_title): ?>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <?php echo e($upageHeading?->forget_password_page_title); ?></li>
                                <?php endif; ?>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="login-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="login-content">
                        <div class="login-title">
                            <h3 class="title"><?php echo e($keywords['Forgot Password'] ?? __('Forgot Password')); ?></h3>
                        </div>
                        <form action="<?php echo e(route('user.client.forgot.submit', getParam())); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="input-box">
                                <span><?php echo e($keywords['Email Address'] ?? __('Email Address')); ?> *</span>
                                <input type="email" name="email" value="<?php echo e(Request::old('email')); ?>">
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-danger mb-2 mt-2"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <?php if(Session::has('err')): ?>
                                    <p class="text-danger mb-2 mt-2"><?php echo e(Session::get('err')); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="input-btn mt-4">
                                <div class="mt-2 d-flex justify-content-between">
                                    <button type="submit"
                                        class="main-btn"><?php echo e($keywords['Send Mail'] ?? __('Send Mail')); ?></button>
                                    <a href="<?php echo e(route('user.client.login', getParam())); ?>">
                                        <?php echo e($keywords['Login Now'] ?? __('Login Now')); ?>

                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user-front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/user-front/client/forgot.blade.php ENDPATH**/ ?>