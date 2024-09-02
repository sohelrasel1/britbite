<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
    use App\Models\User\OrderItem;
    use App\Models\User\ProductReview;
?>

<?php $__env->startSection('pageHeading'); ?>
    <?php echo e($keywords['Product Details'] ?? __('Product Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-keywords', "$product?->meta_keywords"); ?>
<?php $__env->startSection('meta-description', "$product?->meta_description"); ?>
<?php $__env->startSection('content'); ?>

    <section class="page-title-area d-flex align-items-center"
        style="background-image: url('<?php echo e($userBs->breadcrumb ? Uploader::getImageUrl(Constant::WEBSITE_BREADCRUMB, $userBs->breadcrumb, $userBs) : asset('assets/restaurant/images/breadcrum.jpg')); ?>');background-size:cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-item text-center">
                        <h2 class="title"><?php echo e($upageHeading?->items_details_page_title); ?></h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('user.front.index', getParam())); ?>"><i
                                            class="flaticon-home"></i><?php echo e($keywords['Home'] ?? __('Home')); ?></a></li>
                                <?php if($upageHeading?->items_details_page_title): ?>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <?php echo e($upageHeading?->items_details_page_title); ?>

                                    </li>
                                <?php endif; ?>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shop-details-area pt-95 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6">
                    <div class="shop-item mr-70">
                        <div class="shop-thumb">
                            <?php $__currentLoopData = $product->product_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item">
                                    <img class="lazy wow fadeIn"
                                        data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_SLIDER_IMAGE, $image->image, $userBs)); ?>"
                                        alt="shop" data-wow-delay=".5s">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="shop-list">
                            <ul class="shop-thumb-active">
                                <?php $__currentLoopData = $product->product_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <img class="lazy wow fadeIn"
                                            data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_SLIDER_IMAGE, $img->image, $userBs)); ?>"
                                            alt="shop" data-wow-delay=".5s">
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="shop-content pt-60">
                        <div class="shop-top-content">
                            <h3 class="title"><?php echo e(convertUtf8($product->title)); ?></h3>
                            <?php if(in_array('Online Order', $packagePermissions)): ?>
                                <ul class="d-flex justify-content-between">
                                    <li>

                                        <div class="rate">
                                            <div class="rating"
                                                style="width:<?php echo e(!empty($product->product_reviews)? ProductReview::where('user_id', $user->id)->where('product_id', $product->product_id)->avg('review') * 20: 0); ?>%">
                                            </div>
                                        </div>
                                    </li>

                                    <li><span>
                                            <?php echo e(count($reviews)); ?>

                                            <?php if(count($reviews) <= 1): ?>
                                                <?php echo e($keywords['Review'] ?? __('Review')); ?>

                                            <?php else: ?>
                                                <?php echo e($keywords['Reviews'] ?? __('Reviews')); ?>

                                            <?php endif; ?>
                                        </span>
                                    </li>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <div class="shop-price pt-15">
                            <ul>
                                <li><?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->current_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                </li>
                                <?php if(convertUtf8($product->previous_price)): ?>
                                    <li><?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->previous_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <?php if(empty($product->variations) && empty($product->addons) && in_array('Online Order', $packagePermissions)): ?>
                            <div class="shop-qty d-flex align-items-center pt-25">
                                <div class="product-quantity d-flex align-items-center" id="quantity">
                                    <span><?php echo e(__('Qty')); ?></span>
                                    <button type="button" id="sub" class="sub subclick">-</button>
                                    <input type="text" id="detailsQuantity" id="1" value="1" />
                                    <button type="button" id="add" class="add addclick">+</button>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="shop-text">
                            <p><?php echo e($product->summary); ?></p>
                        </div>
                        <?php if($product->category): ?>
                            <p class="mt-2">
                                <span><?php echo e($keywords['Category'] ?? __('Category')); ?> :</span>
                                <a class=""
                                    href="<?php echo e(route('user.front.items', [getParam(), 'category_id' => $product->category_id])); ?>"
                                    class="cursor-pointer"><?php echo e(convertUtf8($product->category->name)); ?>

                                </a> <br>
                                <?php
                                    $subcategory = App\Models\User\PsubCategory::where('category_id', $product->category_id)
                                        ->where('id', $product->subcategory_id)
                                        ->where('status', 1)
                                        ->first();
                                ?>
                                <?php if($subcategory): ?>
                                    <span><?php echo e($keywords['Subcategory'] ?? __('Subcategory')); ?> :</span>
                                    <a href="<?php echo e(route('user.front.items', [getParam(), 'category_id' => $product->category->id, 'subcategory_id' => $subcategory->id])); ?>"
                                        class="cursor-pointer"><?php echo e(convertUtf8($subcategory->name)); ?>

                                    </a>
                                <?php endif; ?>
                            </p>
                        <?php endif; ?>
                        <div class="shop-social product-social-icon social-link a2a_kit a2a_kit_size_32">
                            <span><?php echo e($keywords['Share'] ?? __('Share')); ?> :</span>
                            <ul class="social-share">
                                <li>
                                    <a class="facebook a2a_button_facebook" href="">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="twitter a2a_button_twitter" href="">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="linkedin a2a_button_linkedin" href="">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="pinterest a2a_button_pinterest" href="">
                                        <i class="fab fa-pinterest"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="a2a_dd plus" href="https://www.addtoany.com/share">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="shop-btns pt-45">
                            <?php if(in_array('Online Order', $packagePermissions)): ?>
                                <a data-href="<?php echo e(route('user.front.add.cart', [getParam(), $product->product_id])); ?>"
                                    data-product="<?php echo e($product); ?>" class="main-btn-2 main-btn cart-link ">
                                    <?php echo e($keywords['Add to Cart'] ?? __('Add To Cart')); ?>

                                    <i class="fa fa-shopping-basket"></i>
                                </a>
                            <?php else: ?>
                                <?php if($product->variations != '[]'): ?>
                                    <a class="main-btn-2 main-btn cart-link" data-product="<?php echo e($product); ?>"
                                        data-href="<?php echo e(route('user.front.add.cart', [getParam(), $product->product_id])); ?>"><?php echo e($keywords['Extras'] ?? __('Extras')); ?>

                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="shop-menu-content pb-130">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="menu-contents">
                        <div class="menu-tabs">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                        role="tab" aria-controls="pills-home"
                                        aria-selected="true"><?php echo e($keywords['Description'] ?? __('Description')); ?></a>
                                </li>
                                <?php if(!is_null($packagePermissions) && in_array('Online Order', $packagePermissions)): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill"
                                            href="#pills-contact" role="tab" aria-controls="pills-contact"
                                            aria-selected="false"><?php echo e($keywords['Reviews'] ?? __('Reviews')); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <?php echo nl2br(replaceBaseUrl(convertUtf8($product->description))); ?>

                                </div>
                                <?php if(!is_null($packagePermissions) && in_array('Online Order', $packagePermissions)): ?>
                                    <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                        aria-labelledby="pills-contact-tab">
                                        <div class="shop-review-area">
                                            <div class="shop-review-title">
                                                <h3 class="title"><?php echo e(count($reviews)); ?>

                                                    <?php echo e($keywords['Reviews For'] ?? __('Reviews For')); ?>

                                                    <?php echo e(convertUtf8($product->title)); ?></h3>
                                            </div>

                                            <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="shop-review-user">
                                                    <?php if(
                                                        !is_null($review->client) &&
                                                            (strpos($review->client->photo, 'facebook') || strpos($review->client->photo, 'google'))): ?>
                                                        <img src="<?php echo e($review->client->photo ?? asset('assets/tenant/image/user.jpg')); ?>"
                                                            alt="user image" width="50">
                                                    <?php else: ?>
                                                        <img src="<?php echo e($review->client ? Uploader::getImageUrl(Constant::WEBSITE_CUSTOMER_IMAGE, $review->client?->photo, $userBs) : asset('assets/tenant/image/user.jpg')); ?>"
                                                            alt="user image" width="50">
                                                    <?php endif; ?>
                                                    <ul>

                                                        <div class="rate">
                                                            <div class="rating"
                                                                style="width:<?php echo e($review->review * 20); ?>%"></div>
                                                        </div>
                                                    </ul>
                                                    <span>
                                                        <span><?php echo e(!empty(convertUtf8($review->client)) ? convertUtf8($review->client->username) : ''); ?>

                                                        </span>
                                                        – <?php echo e($review->created_at->format('F j, Y')); ?>

                                                    </span>
                                                    <p><?php echo e(convertUtf8($review->comment)); ?></p>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php if(Auth::guard('client')->user()): ?>
                                                <?php if(OrderItem::query()->where('customer_id', Auth::guard('client')->user()->id)->where('product_id', $product->product_id)->exists()): ?>
                                                    <div class="shop-review-form">
                                                        <?php $__errorArgs = ['error'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <p class="text-danger my-2">
                                                                <?php echo e(Session::get('error')); ?>

                                                            </p>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        <form
                                                            action="<?php echo e(route('user.product.review.submit', getParam())); ?>"
                                                            method="POST">
                                                            <?php echo csrf_field(); ?>

                                                            <input type="hidden" value="" id="reviewValue"
                                                                name="review">
                                                            <input type="hidden" value="<?php echo e($product->product_id); ?>"
                                                                name="product_id">
                                                            <div class="input-box">
                                                                <span><?php echo e($keywords['Rating'] ?? __('Rating')); ?> *</span>
                                                                <div class="review-content ">
                                                                    <ul class="review-value review-1">
                                                                        <li>
                                                                            <a class="cursor-pointer" data-href="1">
                                                                                <i class="far fa-star"></i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                    <ul class="review-value review-2">
                                                                        <li><a class="cursor-pointer" data-href="2"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                        <li><a class="cursor-pointer" data-href="2"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                    </ul>
                                                                    <ul class="review-value review-3">
                                                                        <li><a class="cursor-pointer" data-href="3"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                        <li><a class="cursor-pointer" data-href="3"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                        <li><a class="cursor-pointer" data-href="3"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                    </ul>
                                                                    <ul class="review-value review-4">
                                                                        <li><a class="cursor-pointer" data-href="4"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                        <li><a class="cursor-pointer" data-href="4"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                        <li><a class="cursor-pointer" data-href="4"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                        <li><a class="cursor-pointer" data-href="4"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                    </ul>
                                                                    <ul class="review-value review-5">
                                                                        <li><a class="cursor-pointer" data-href="5"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                        <li><a class="cursor-pointer" data-href="5"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                        <li><a class="cursor-pointer" data-href="5"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                        <li><a class="cursor-pointer" data-href="5"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                        <li><a class="cursor-pointer" data-href="5"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="input-box">
                                                                <span><?php echo e($keywords['Comment'] ?? __('Comment')); ?> </span>
                                                                <textarea name="comment" cols="30" rows="10" placeholder="<?php echo e($keywords['Comment'] ?? __('Comment')); ?> "></textarea>
                                                            </div>
                                                            <div class="input-btn mt-3">
                                                                <button type="submit" class="main-btn">
                                                                    <?php echo e($keywords['Submit'] ?? __('Submit')); ?>

                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <div class="review-login mt-5">
                                                    <a class="boxed-btn d-inline-block mr-2"
                                                        href="<?php echo e(route('user.client.login', getParam())); ?>">
                                                        <?php echo e($keywords['Login'] ?? __('Login')); ?>

                                                    </a>
                                                    <?php echo e($keywords['to leave a rating'] ?? __('to leave a rating')); ?>

                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


  
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/front/js/page.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user-front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/user-front/product/details.blade.php ENDPATH**/ ?>