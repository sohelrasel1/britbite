<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
    use App\Models\User\Product;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\DB;
    use App\Models\User\ProductReview;
?>

<?php $__env->startSection('pageHeading'); ?>
    <?php echo e($keywords['About Us'] ?? __('About Us')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('meta-keywords', !empty($userSeo) ? $userSeo->home_meta_keywords : ''); ?>
<?php $__env->startSection('meta-description', !empty($userSeo) ? $userSeo->home_meta_description : ''); ?>

<?php $__env->startSection('content'); ?>

     <?php echo $__env->make('user-front.breadcrum',['title' => $upageHeading?->about_page_title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

     <section class="pb-120"></section>
        <section class="experience-area ">
            <div class="container">
                <div class="row justify-content-center justify-content-lg-end">
                    <div class="col-lg-6 col-md-8">
                        <div class="experience-content">
                            <?php if($userBs->intro_section_title): ?>
                                <div class="flag"><span><?php echo e(convertUtf8($userBs->intro_section_title)); ?></span></div>
                            <?php endif; ?>
                            <h3 class="title wow fadeIn" data-wow-duration="2000ms" data-wow-delay="0ms">
                                <?php echo e(convertUtf8($userBs->intro_title)); ?></h3>
                            <p class=" wow fadeIns" data-wow-duration="2000ms" data-wow-delay="300ms">
                                <?php echo e(convertUtf8($userBs->intro_text)); ?></p>

                            <?php if(!empty($userBs->intro_signature)): ?>
                                <img class="lazy wow fadeIn" data-wow-duration="2000ms" data-wow-delay="600ms"
                                    data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBs->intro_signature, $userBs)); ?>"
                                    alt="autograph">
                            <?php else: ?>

                            <?php endif; ?>
                            <i class="flaticon-burger"></i>
                        </div>
                    </div>
                </div>
               
            </div>
            <?php if($userBs->intro_main_image): ?>
                <div class="experience-bg">
                    <img class="lazy wow fadeIn"
                        data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBs->intro_main_image, $userBs)); ?>"
                        alt="experience">
                </div>
            <?php else: ?>

            <?php endif; ?>

        </section>
   
        <section class="team-area" style="<?php echo e($members->count() == 0 ? 'background:#f1f1f1' : ''); ?>">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="section-title text-center">
                            <span><?php echo e(convertUtf8($sectionHeading?->team_title)); ?> <img
                                    src="<?php echo e(asset('assets/front/img/title-icon.png')); ?>" alt=""></span>
                            <h3 class="title"><?php echo e(convertUtf8($sectionHeading?->team_subtitle)); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <?php if($members->count() > 0): ?>
                        <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4 col-md-7 col-sm-9">
                                <div class="single-team mt-30">
                                    <div class="team-thumb">
                                        <?php if($member->image): ?>
                                            <img class="lazy wow fadeIn"
                                                data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_MEMBER_IMAGES, $member->image, $userBs)); ?>"
                                                data-wow-delay=".5s" data-wow-duration="1s" alt="team">
                                        <?php endif; ?>
                                        <div class="team-overlay">
                                            <div class="link">
                                                <a><i class="flaticon-add"></i></a>
                                            </div>
                                            <div class="social">
                                                <ul>
                                                    <?php if($member->facebook): ?>
                                                        <li><a href="<?php echo e($member->facebook); ?>"><i
                                                                    class="flaticon-facebook"></i></a></li>
                                                    <?php endif; ?>
                                                    <?php if($member->twitter): ?>
                                                        <li><a href="<?php echo e($member->twitter); ?>"><i
                                                                    class="flaticon-twitter"></i></a></li>
                                                    <?php endif; ?>
                                                    <?php if($member->instagram): ?>
                                                        <li><a href="<?php echo e($member->instagram); ?>"><i
                                                                    class="flaticon-instagram"></i></a></li>
                                                    <?php endif; ?>
                                                    <?php if($member->linkedin): ?>
                                                        <li><a href="<?php echo e($member->linkedin); ?>"><i
                                                                    class="flaticon-linkedin"></i></a></li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="team-content text-center">
                                        <h4 class="title"><?php echo e(convertUtf8($member->name)); ?></h4>
                                        <span><?php echo e(convertUtf8($member->rank)); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <h3><?php echo e($keywords['NO MEMBERS FOUND!'] ?? __('NO MEMBERS FOUND!')); ?></h3>
                    <?php endif; ?>
                </div>
            </div>
        </section>
   
        <section class="client-area bg_cover pt-105 pb-95 lazy"
            data-bg="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBe->testimonial_bg_img, $userBs)); ?>">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="client-title text-center">
                            <h3 class="title"><?php echo e(convertUtf8($sectionHeading?->testimonial_title)); ?></h3>

                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <?php if($testimonials->count() > 0): ?>
                            <div class="client-items client-active">

                                <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="single-client">
                                        <div class="text">
                                            <p><?php echo e(convertUtf8($testimonial->comment)); ?></p>
                                        </div>
                                        <div class="client-info d-block d-sm-flex justify-content-between">
                                            <div class="item-1">
                                                <?php if($testimonial->image): ?>
                                                    <img class="lazy wow fadeIn"
                                                        data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_TESTIMONIAL_IMAGES, $testimonial->image, $userBs)); ?>"
                                                        alt="clients">
                                                <?php endif; ?>
                                                <span><?php echo e(convertUtf8($testimonial->name)); ?></span>
                                                <p><?php echo e(convertUtf8($testimonial->rank)); ?></p>
                                            </div>
                                            <div class="item-2 text-sm-right text-left">
                                                <ul>
                                                    <?php
                                                        $i = 0;
                                                        for ($i == 1; $i < $testimonial->rating; $i++) {
                                                            echo '<li><i class="flaticon-star"></i></li>';
                                                        }
                                                    ?>
                                                </ul>
                                                <span>(<?php echo e($testimonial->rating); ?> <?php echo e(__('Stars')); ?>)</span>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        <?php else: ?>
                            <h3 class="text-center"><?php echo e($keywords['NO CLIEND FOUND!'] ?? __('NO CLIEND FOUND!')); ?></h3>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
   

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user-front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/user-front/fastfood/about_us.blade.php ENDPATH**/ ?>