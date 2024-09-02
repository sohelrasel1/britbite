<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
    use App\Models\User\Ulink;
    use App\Models\User\Table;
    use Illuminate\Support\Facades\Auth;

?>
<?php if($userBs->top_footer_section == 1): ?>
    <footer class="footer-area footer-area-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget-1">
                        <div class="header-times d-none d-md-inline-block">
                            <?php if(!is_null($userBs->office_time)): ?>
                                <i class="flaticon-time"></i>
                                <h5><?php echo e($keywords['Opening Time'] ?? __('Opening Time')); ?></h5>
                                <span><?php echo e(convertUtf8($userBs->office_time)); ?></span>
                            <?php endif; ?>
                        </div>
                        <p><?php echo e(convertUtf8($userBs->footer_text)); ?></p>


                        <ul>
                            <?php $__currentLoopData = $socialMediaInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social_link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e($social_link->url); ?>" target="_blank">
                                        <i class="<?php echo e($social_link->icon); ?>"></i>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 order-3 order-lg-2">
                    <div class="footer-widget-2 text-left text-sm-center">
                        <?php if($userBs->footer_logo): ?>
                            <a href="<?php echo e(route('user.front.index', getParam())); ?>">
                                <img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBs->footer_logo, $userBs)); ?>"
                                    alt="logo">
                            </a>
                        <?php endif; ?>
                        <ul class="pt-25">
                            <?php
                                $blinks = Ulink::query()
                                    ->where('language_id', $userCurrentLang->id)
                                    ->where('user_id', $user->id)
                                    ->orderby('id', 'desc')
                                    ->get();
                            ?>
                            <?php $__currentLoopData = $blinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e($blink->url); ?>" target="_blank"><?php echo e(convertUtf8($blink->name)); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php if(!empty($userBe->footer_bottom_img)): ?>
                            <a class="pt-30" href="javascript:void(0);">
                                <img class="lazy"
                                    data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBe->footer_bottom_img, $userBs)); ?>"
                                    alt="">
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 order-2 order-lg-3">
                    <h3 class="subscribe-title"><?php echo e($keywords['Subscribe Here'] ?? __('Subscribe Here')); ?></h3>
                    <form id="footerSubscribe" action="<?php echo e(route('user.front.subscribe', getParam())); ?>" method="post"
                        class="subscribe-form subscribeForm">
                        <?php echo csrf_field(); ?>
                        <div class="subscribe-inputs">
                            <input name="email" type="text"
                                placeholder="<?php echo e($keywords['Enter Your Email'] ?? __('Enter Your Email')); ?>">
                            <button type="submit"><i class="far fa-paper-plane"></i></button>
                        </div>
                        <p id="erremail" class="text-danger mb-0 err-email"></p>
                    </form>
                    <div class="footer-widget-3">
                        <ul>
                            <?php
                                $ulinks = Ulink::query()
                                    ->where('language_id', $userCurrentLang->id)
                                    ->where('user_id', $user->id)
                                    ->orderby('id', 'desc')
                                    ->get();
                            ?>

                            <?php $__currentLoopData = $ulinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ulink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e($ulink->url); ?>" target="_blank">+
                                        <?php echo e(convertUtf8($ulink->name)); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </footer>
<?php endif; ?>
<?php if($userBs->copyright_section == 1): ?>
    <div class="footer-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-copyright d-block justify-content-center d-md-flex">
                        <div class="tinymce-content">
                            <?php echo $userBs->copyright_text; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/saas/resources/views/user-front/fastfood/partials/footer.blade.php ENDPATH**/ ?>