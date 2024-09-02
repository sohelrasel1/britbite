<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>

<?php $__env->startSection('pageHeading'); ?>
    <?php echo e($keywords['Blog Details'] ?? __('Blog Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-keywords', "$blog->meta_keywords"); ?>
<?php $__env->startSection('meta-description', "$blog->meta_description"); ?>
<?php $__env->startSection('content'); ?>

    <section class="page-title-area d-flex align-items-center"
        style="background-image: url('<?php echo e($userBs->breadcrumb ? Uploader::getImageUrl(Constant::WEBSITE_BREADCRUMB, $userBs->breadcrumb, $userBs) : asset('assets/restaurant/images/breadcrum.jpg')); ?>');background-size:cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-item text-center">
                        <h2 class="title"><?php echo e($upageHeading?->blog_details_page_title); ?></h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('user.front.index', getParam())); ?>"><i
                                            class="flaticon-home"></i><?php echo e($keywords['Home'] ?? __('Home')); ?></a></li>
                                <?php if($upageHeading?->blog_details_page_title): ?>
                                    <li class="breadcrumb-item active" aria-current="page">

                                        <?php echo e($upageHeading?->blog_details_page_title); ?>

                                    </li>
                                <?php endif; ?>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="blog-details-area pt-70 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="blog-details-items mt-50">
                        <div class="blog-thumb">
                            <img class="lazy wow fadeIn w-100"
                                data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_BLOG_IMAGE, $blog->image, $userBs)); ?>"
                                alt="blog" data-wow-delay="1s">
                        </div>
                        <div class="blog-details-content">
                            <h2 class="title"><?php echo e(convertUtf8($blog->title)); ?></h2>
                        </div>
                        <div class="tinymce-content">
                            <p><?php echo $blog->content; ?></p>
                        </div>

                        <div class="blog-social">
                            <div class="shop-social d-flex align-items-center">
                                <span><?php echo e($keywords['Share'] ?? __('Share')); ?> :</span>
                                <ul>
                                    <li>
                                        <a
                                            href="//www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>"><i
                                                class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a
                                            href="//twitter.com/intent/tweet?text=my share text&amp;url=<?php echo e(urlencode(url()->current())); ?>"><i
                                                class="fab fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a
                                            href="//www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo e(urlencode(url()->current())); ?>&amp;title=<?php echo e(convertUtf8($blog->title)); ?>"><i
                                                class="fab fa-linkedin"></i></a>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div class="blog-details-comment">
                            <div class="comment-lists">
                                <div id="disqus_thread"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="blog-sidebar">
                        <div class="blog-box blog-border mt-50">
                            <div class="blog-title pl-45">
                                <h4 class="title"><i
                                        class="fa fa-list <?php echo e($rtl == 1 ? 'mr-20 ml-10' : 'mr-10'); ?>"></i><?php echo e($keywords['All Categories'] ?? __('All Categories')); ?>

                                </h4>
                            </div>
                            <div class="blog-cat-list pl-45 pr-45">
                                <ul>
                                    <?php $__currentLoopData = $bcats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="single-category <?php if(request()->input('category') == $bcat->id): ?> active <?php endif; ?>">
                                            <a
                                                href="<?php echo e(route('user.front.blogs', [getParam(), 'term' => request()->input('term'), 'category' => $bcat->id])); ?>"><?php echo e(convertUtf8(convertUtf8($bcat->name))); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('user-front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/user-front/fastfood/blog-details.blade.php ENDPATH**/ ?>