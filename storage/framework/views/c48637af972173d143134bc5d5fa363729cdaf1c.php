<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
    use App\Models\User\Product;
    use App\Models\User\ProductReview;
?>


<?php $__env->startSection('pageHeading'); ?>
    <?php echo e($keywords['Product'] ?? __('Product')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-keywords', !empty($userSeo) ? $userSeo->product_meta_keywords : ''); ?>
<?php $__env->startSection('meta-description', !empty($userSeo) ? $userSeo->product_meta_description : ''); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('user-front.breadcrum', ['title' => $upageHeading?->menu_page_title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <section class="food-menu-area food-menu-2-area food-menu-3-area pt-90">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <?php if($categories->count() > 0): ?>
                        <div class="tabs-btn pb-20">
                            <ul class="nav nav-pills d-flex justify-content-center" id="pills-tab" role="tablist">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $productCount = Product::query()
                                            ->join('product_informations', 'product_informations.product_id', 'products.id')
                                            ->where('product_informations.category_id', $category->id)
                                            ->where('products.user_id', $user->id)
                                            ->count();
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo e($keys == 0 ? 'active' : ''); ?>"
                                            id="<?php echo e(convertUtf8($category->slug)); ?>-tab" data-toggle="pill"
                                            href="#<?php echo e(convertUtf8($category->slug)); ?>" role="tab"
                                            aria-controls="<?php echo e(convertUtf8($category->slug)); ?>" aria-selected="true">
                                            <?php if(!empty($category?->image)): ?>
                                                <img class="lazy wow fadeIn"
                                                    data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_CATEGORY_IMAGE, $category?->image, $userBs)); ?>"
                                                    alt="menu" data-wow-delay=".5s">
                                            <?php endif; ?>
                                            <p <?php if(empty($category->image)): ?> style="padding-top: 0;" <?php endif; ?>>
                                                <?php echo e(convertUtf8($category->name)); ?>

                                                (<?php echo e($productCount); ?>)
                                            </p>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div class="row justify-content-center">
                            <h3> <?php echo e($keywords['No Menu Found!'] ?? __('No Menu Found!')); ?> </h3>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">

                    <div class="tab-content" id="pills-tabContent">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="tab-pane fade <?php echo e($key == 0 ? 'show active' : ''); ?>"
                                id="<?php echo e(convertUtf8($category->slug)); ?>" role="tabpanel"
                                aria-labelledby="<?php echo e(convertUtf8($category->slug)); ?>-tab">
                                <div class="button-group filters-button-group">
                                    <button class="button is-checked" data-filter="*"
                                        <?php if($category->subcategories()->where('language_id', $cLang->id)->where('user_id', $user->id)->count() == 0): ?> style="display: none;" <?php endif; ?>>
                                        <?php echo e($keywords['ALL'] ?? __('All')); ?>

                                    </button>

                                    <?php $__currentLoopData = $category->subcategories()->where('language_id', $cLang->id)->where('user_id', $user->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($subcat->status == 1): ?>
                                            <button class="button" data-filter=".sub<?php echo e($subcat->id); ?>">
                                                <?php echo e($subcat->name); ?>

                                            </button>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>

                                <div class="row justify-content-center">

                                    <div class="food-items-loader">
                                        <img src="<?php echo e(asset('assets/admin/img/loader.gif')); ?>" alt="">
                                    </div>

                                    <?php
                                        $activeProducts = Product::query()
                                            ->join('product_informations', 'product_informations.product_id', 'products.id')
                                            ->where('status', 1)
                                            ->where('product_informations.category_id', $category->id)
                                            ->where('products.user_id', $user->id)
                                            ->get();
                                    ?>
                                    <?php if(count($activeProducts) > 0): ?>
                                        <?php $__currentLoopData = $activeProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-lg-6">
                                                <div class="food-menu-items">
                                                    <div class="single-menu-item mt-30 sub<?php echo e($product->subcategory_id); ?>">
                                                        <div class="item-details">
                                                            <div class="menu-thumb">
                                                                <img class="lazy wow fadeIn"
                                                                    data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_FEATURED_IMAGE, $product->feature_image, $userBs)); ?>"
                                                                    alt="menu" data-wow-delay=".5s">
                                                                <div class="thumb-overlay">
                                                                    <a
                                                                        href="<?php echo e(route('user.front.product.details', [getParam(), $product->slug, $product->product_id])); ?>"><i
                                                                            class="flaticon-add"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="menu-content ml-30">
                                                                <a class="title"
                                                                    href="<?php echo e(route('user.front.product.details', [getParam(), $product->slug, $product->product_id])); ?>"><?php echo e(strlen($product->title) > 27 ? mb_substr($product->title, 0, 27, 'UTF-8') . '...' : $product->title); ?>

                                                                </a>

                                                                <?php if(in_array('Online Order', $packagePermissions)): ?>
                                                                    <div class="rate mt-1">
                                                                        <div class="rating"
                                                                            style="width:<?php echo e(!empty($product->product_reviews)? ProductReview::where('user_id', $user->id)->where('product_id', $product->product_id)->avg('review') * 20: 0); ?>%">
                                                                        </div>
                                                                    </div>
                                                                <?php endif; ?>

                                                                <p><?php echo e(convertUtf8(strlen($product->summary)) > 60 ? substr(convertUtf8($product->summary), 0, 60) . '...' : convertUtf8($product->summary)); ?>

                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="menu-price-btn">
                                                            <?php if(in_array('Online Order', $packagePermissions)): ?>
                                                                <a class="cart-link d-md-none d-block btn mobile"
                                                                    data-product="<?php echo e($product); ?>"
                                                                    data-href="<?php echo e(route('user.front.add.cart', [getParam(), $product->product_id])); ?>">+</a>
                                                                <a class="cart-link d-none d-md-block"
                                                                    data-product="<?php echo e($product); ?>"
                                                                    data-href="<?php echo e(route('user.front.add.cart', [getParam(), $product->product_id])); ?>"><?php echo e($keywords['Add to Cart'] ?? __('Add to Cart')); ?>

                                                                </a>
                                                                <span><?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->current_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                                </span>
                                                                <?php if(convertUtf8($product->previous_price)): ?>
                                                                    <del> <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->previous_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?></del>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <?php if(!empty(json_decode($product->addons, true)) || !empty(json_decode($product->variations, true))): ?>
                                                                    <a class="main-btn cart-link show"
                                                                        data-product="<?php echo e($product); ?>"
                                                                        data-href="<?php echo e(route('user.front.add.cart', [getParam(), $product->product_id])); ?>"><?php echo e($keywords['Extras'] ?? __('Extras')); ?>

                                                                    </a>
                                                                    <span class="hide"><?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->current_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                                    </span>
                                                                    <?php if(convertUtf8($product->previous_price)): ?>
                                                                        <del> <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->previous_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?></del>
                                                                    <?php endif; ?>
                                                                <?php else: ?>
                                                                    <a class="main-btn hide"><?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->current_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                                    </a>
                                                                    <span class="show"><?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->current_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                                    </span>
                                                                    <?php if(convertUtf8($product->previous_price)): ?>
                                                                        <del> <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->previous_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?></del>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <?php if($product->is_special == 1): ?>
                                                            <div class="flag flag-2">
                                                                <span><?php echo e($keywords['Special'] ?? __('Special')); ?></span>
                                                            </div>
                                                        <?php endif; ?>

                                                    </div>

                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <div class="col-lg-12 bg-light py-5 mt-4">
                                            <h4 class="text-center">
                                                <?php echo e($keywords['Product Not Found'] ?? __('Product Not Found')); ?></h4>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

   

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user-front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/user-front/product/product.blade.php ENDPATH**/ ?>