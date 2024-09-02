<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>


<?php $__env->startSection('pageHeading'); ?>
<?php echo e($keywords['FAQ'] ?? __('FAQ')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-keywords', !empty($userSeo) ? $userSeo->faqs_meta_keywords : ''); ?>
<?php $__env->startSection('meta-description', !empty($userSeo) ? $userSeo->faqs_meta_description : ''); ?>
<?php $__env->startSection('content'); ?>
   
  <?php echo $__env->make('user-front.breadcrum',['title' => $upageHeading?->faq_page_title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 
    <div class="faq-section">
        <?php if($faqs->count() > 0): ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="accordion" id="accordionExample1">
                        <?php for($i=0; $i < ceil(count($faqs)/2); $i++): ?>
                            <div class="card">
                                <div class="card-header" id="heading<?php echo e($faqs[$i]->id); ?>">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link collapsed btn-block text-left" type="button"
                                                data-toggle="collapse" data-target="#collapse<?php echo e($faqs[$i]->id); ?>"
                                                aria-expanded="false" aria-controls="collapse<?php echo e($faqs[$i]->id); ?>">
                                            <?php echo e(convertUtf8($faqs[$i]->question)); ?>

                                        </button>
                                    </h2>
                                </div>
                                <div id="collapse<?php echo e($faqs[$i]->id); ?>" class="collapse"
                                     aria-labelledby="heading<?php echo e($faqs[$i]->id); ?>" data-parent="#accordionExample1">
                                    <div class="card-body">
                                        <?php echo e(convertUtf8($faqs[$i]->answer)); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="accordion" id="accordionExample2">
                        <?php for($i=ceil(count($faqs)/2); $i < count($faqs); $i++): ?>
                            <div class="card">
                                <div class="card-header" id="heading<?php echo e($faqs[$i]->id); ?>">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link collapsed btn-block text-left" type="button"
                                                data-toggle="collapse" data-target="#collapse<?php echo e($faqs[$i]->id); ?>"
                                                aria-expanded="false" aria-controls="collapse<?php echo e($faqs[$i]->id); ?>">
                                            <?php echo e(convertUtf8($faqs[$i]->question)); ?>

                                        </button>
                                    </h2>
                                </div>
                                <div id="collapse<?php echo e($faqs[$i]->id); ?>" class="collapse"
                                     aria-labelledby="heading<?php echo e($faqs[$i]->id); ?>" data-parent="#accordionExample2">
                                    <div class="card-body">
                                        <?php echo e(convertUtf8($faqs[$i]->answer)); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center text-center bg-light py-5">
                    <h3><?php echo e($keywords['NO FAQ FOUND!'] ?? __('NO FAQ FOUND!')); ?></h3>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("user-front.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/user-front/fastfood/faq.blade.php ENDPATH**/ ?>