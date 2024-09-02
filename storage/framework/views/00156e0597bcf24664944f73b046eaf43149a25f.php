<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>

<?php $__env->startSection('pageHeading'); ?>
 <?php echo e($keywords['Teams'] ?? __('Teams')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-keywords', !empty($userSeo) ? $userSeo->team_meta_keywords : ''); ?>
<?php $__env->startSection('meta-description', !empty($userSeo) ? $userSeo->team_meta_description : ''); ?>
<?php $__env->startSection('content'); ?>
   
     <?php echo $__env->make('user-front.breadcrum',['title' => $upageHeading?->team_page_title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   
    <section class="team-area team-page">
        <div class="container">
          
            <div class="row justify-content-start">
                <?php if($members->count() > 0): ?>
                <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-7 col-sm-9">
                        <div class="single-team mt-30">
                            <div class="team-thumb">
                                <img class="lazy wow fadeIn"
                                     data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_MEMBER_IMAGES,$item->image,$userBs)); ?>" alt="team"
                                     data-wow-delay=".5s">
                                <div class="team-overlay">
                                    <div class="link">
                                        <a><i class="flaticon-add"></i></a>
                                    </div>
                                    <div class="social">
                                        <ul>
                                            <?php if($item->facebook): ?>
                                                <li>
                                                    <a href="<?php echo e($item->facebook); ?>">
                                                        <i class="flaticon-facebook"></i>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($item->twitter): ?>
                                                <li>
                                                    <a href="<?php echo e($item->twitter); ?>">
                                                        <i class="flaticon-twitter"></i>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($item->instagram): ?>
                                                <li>
                                                    <a href="<?php echo e($item->instagram); ?>">
                                                        <i class="flaticon-instagram"></i>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($item->linkedin): ?>
                                                <li>
                                                    <a href="<?php echo e($item->linkedin); ?>">
                                                        <i class="flaticon-linkedin"></i>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="team-content text-center">
                                <h4 class="title"><?php echo e(convertUtf8($item->name)); ?></h4>
                                <span><?php echo e(convertUtf8($item->rank)); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                 <div class="col-lg-12 text-center bg-light py-5">
                    <h3><?php echo e($keywords['NO TEAM FOUND!'] ?? __('NO TEAM FOUND!')); ?></h3>
                 </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user-front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/user-front/fastfood/teams.blade.php ENDPATH**/ ?>