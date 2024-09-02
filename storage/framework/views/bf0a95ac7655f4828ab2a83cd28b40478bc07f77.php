<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
    use App\Models\User\Product;
    $direction = 'direction:'
?>

<?php $__env->startSection('pageHeading'); ?>
    <?php echo e($keywords['Cart'] ?? __('Cart')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-keywords', !empty($userSeo) ? $userSeo->cart_meta_keywords : ''); ?>
<?php $__env->startSection('meta-description', !empty($userSeo) ? $userSeo->cart_meta_description : ''); ?>
<?php $__env->startSection('pagename'); ?>
    -
    <?php echo e($keywords['Product'] ?? __('Product')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/jquery-ui.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('user-front.breadcrum', ['title' => $upageHeading?->cart_page_title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <section class="cart-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div id="refreshDiv">
                        <?php if($cart != null): ?>
                            <ul class="total-item-info">
                                <?php
                                    $cartTotal = 0;
                                    $countitem = 0;
                                    if ($cart) {
                                        foreach ($cart as $p) {
                                            $cartTotal += $p['total'];
                                            $countitem += $p['qty'];
                                        }
                                    }
                                ?>
                                <li><span><?php echo e($keywords['Your Cart'] ?? __('Your Cart')); ?>:</span> <span
                                        class="cart-item-view"><?php echo e($cart ? $countitem : 0); ?></span>
                                    <?php echo e($keywords['Items'] ?? __('Items')); ?>

                                </li>
                                <li style="<?php echo e($direction); ?> ltr;">
                                    <span><?php echo e($keywords['Total'] ?? __('Total')); ?> :</span>
                                    <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?>

                                    <span class="cart-total-view"><?php echo e($cartTotal); ?></span>
                                    <?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                </li>
                            </ul>
                        <?php endif; ?>
                        <div class="table-outer">
                            <?php if($cart != null): ?>
                                <table class="cart-table">
                                    <thead class="cart-header">
                                        <tr>
                                            <th class="prod-column"><?php echo e($keywords['Product'] ?? __('Product')); ?></th>
                                            <th width="40%"><?php echo e($keywords['Product Title'] ?? __('Product Title')); ?></th>
                                            <th ><?php echo e($keywords['Quantity'] ?? __('Quantity')); ?></th>
                                            <th class="price"><?php echo e($keywords['Price'] ?? __('Price')); ?></th>
                                            <th><?php echo e($keywords['Total'] ?? __('Total')); ?></th>
                                            <th><?php echo e($keywords['Remove'] ?? __('Remove')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $id = $item['id'];
                                                if (session()->has('user_lang')) {
                                                    $lang = App\Models\User\Language::where('code', session()->get('user_lang'))
                                                        ->where('user_id', getUser()->id)
                                                        ->first();
                                                } else {
                                                    $lang = App\Models\User\Language::where('is_default', 1)
                                                        ->where('user_id', getUser()->id)
                                                        ->first();
                                                }
                                                $product = Product::query()
                                                    ->join('product_informations', 'product_informations.product_id', 'products.id')
                                                    ->where('products.user_id', $user->id)
                                                    ->where('product_informations.language_id', $lang->id)
                                                    ->where('products.id', $id)
                                                    ->first();
                                            ?>

                                            <tr class="remove<?php echo e($id); ?>">
                                                <td class="prod-column">
                                                    <div class="column-box">
                                                        <div class="prod-thumb">
                                                            <a href="<?php echo e(route('user.front.product.details', [getParam(), $product->slug, $product->product_id])); ?>"
                                                                target="_blank">
                                                                <img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_FEATURED_IMAGE, $item['photo'], $userBs)); ?>"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="title">
                                                        <a target="_blank"
                                                            href="<?php echo e(route('user.front.product.details', [getParam(), $product->slug, $product->product_id])); ?>">
                                                            <h5 class="prod-title">
                                                                <?php echo e(strlen($product->title) > 27 ? mb_substr($product->title, 0, 27, 'UTF-8') . '...' : $product->title); ?>


                                                            </h5>
                                                        </a>

                                                        <?php if(!empty($item['variations'])): ?>
                                                            <p><strong><?php echo e($keywords['Variation'] ?? __('Variation')); ?>:</strong>
                                                                <br>
                                                                <?php
                                                                    $variations = $item['variations'];
                                                                    $prokeywords = json_decode($product->keywords, true);
                                                                    $addonkeywords = json_decode($product->addon_keywords, true);

                                                                ?>
                                                                <?php $__currentLoopData = $variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vKey => $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php
                                                                        $vname = $userCurrentLang->code . '_' . str_replace('_', ' ', $vKey);

                                                                        $voption = $userCurrentLang->code . '_' . $variation['name'];

                                                                        $variationName = isset($prokeywords['variation_name'][$vname]) ? $prokeywords['variation_name'][$vname] : '';
                                                                        $optionName = isset($prokeywords['option_name'][$voption]) ? $prokeywords['option_name'][$voption] : '';
                                                                    ?>
                                                                    <?php if(!empty($variationName)): ?>
                                                                        <span
                                                                            class="text-capitalize font-weight-bold <?php echo e($userCurrentLang->rtl == 1 ? 'd-inline-block' : ''); ?>"><?php echo e($variationName); ?> :</span>
                                                                        <span
                                                                            class="text-capitalize <?php echo e($userCurrentLang->rtl == 1 ? 'd-inline-block' : ''); ?>"><?php echo e($optionName); ?></span>
                                                                        <?php if(!$loop->last): ?>
                                                                            <span
                                                                                class=" <?php echo e($userCurrentLang->rtl == 1 ? 'd-inline-block' : ''); ?>">,</span>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </p>
                                                        <?php endif; ?>
                                                        <?php if(!empty($item['addons'])): ?>
                                                            <p>
                                                                <strong><?php echo e($keywords['Addons'] ?? __('Addons')); ?>:</strong><br>
                                                                <?php
                                                                    $addons = $item['addons'];
                                                                ?>
                                                                <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php
                                                                        $addonkeywords = json_decode($product->addon_keywords, true);

                                                                        $aname = $userCurrentLang->code . '_' . $addon['name'];

                                                                    ?>

                                                                    <span   class=" <?php echo e($userCurrentLang->rtl == 1 ? 'd-inline-block' : ''); ?>"><?php echo e($addonkeywords['addon_name'][$aname]); ?></span>
                                                                    <?php if(!$loop->last): ?>
                                                                       <span class=" <?php echo e($userCurrentLang->rtl == 1 ? 'd-inline-block' : ''); ?>">,</span>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </p>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td class="qty">
                                                    <div class="product-quantity d-flex" id="quantity">
                                                        <button type="button" id="sub" class="sub quantity"
                                                            data-href="<?php echo e(route('user.front.cart.item.less.quantity', [getParam(), $key])); ?>">-</button>
                                                        <input type="text" class="cart_qty" id="1"
                                                            value="<?php echo e($item['qty']); ?>" />
                                                        <button type="button" id="add" class="add quantity"
                                                            data-href="<?php echo e(route('user.front.cart.item.add.quantity', [getParam(), $key])); ?>">+</button>
                                                    </div>
                                                </td>
                                                <input type="hidden" value="<?php echo e($id); ?>" class="product_id">
                                                <td class="price cart_price">
                                                    <p>
                                                        <strong><?php echo e($keywords['Product'] ?? __('Product')); ?>:</strong>
                                                        <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?>

                                                        <span><?php echo e($item['product_price'] * $item['qty']); ?></span><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                    </p>
                                                    <?php if(!empty($item['variations'])): ?>
                                                        <p>
                                                            <strong><?php echo e($keywords['Variation'] ?? __('Variation')); ?>:
                                                            </strong>
                                                            <?php
                                                                $variations = $item['variations'];
                                                                $price = 0;
                                                                foreach ($variations as $vKey => $variation) {
                                                                    if (is_array($variation) && array_key_exists('price', $variation)) {
                                                                        $price += $variation['price'];
                                                                    }
                                                                }
                                                            ?>
                                                            <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?>

                                                            <span><?php echo e($price * $item['qty']); ?></span><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                        </p>
                                                    <?php endif; ?>
                                                    <?php if(!empty($item['addons'])): ?>
                                                        <p>
                                                            <strong><?php echo e($keywords['Addons'] ?? __('Addons')); ?>:
                                                            </strong>
                                                            <?php
                                                                $addons = $item['addons'];
                                                                $addonTotal = 0;
                                                                foreach ($addons as $addon) {
                                                                    $addonTotal += $addon['price'];
                                                                }
                                                            ?>
                                                            <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?>

                                                            <span><?php echo e($addonTotal * $item['qty']); ?></span><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                        </p>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="sub-total">
                                                    <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?>

                                                    <?php echo e($item['total']); ?>

                                                    <?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                </td>
                                                <td>
                                                    <div class="remove">
                                                        <div class="checkbox">
                                                            <span class="fas fa-times item-remove"
                                                                data-href="<?php echo e(route('user.front.cart.item.remove', [getParam(), $key])); ?>"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="bg-light py-5 text-center">
                                    <h3 class="text-uppercase"><?php echo e($keywords['Cart is empty'] ?? __('Cart is empty')); ?></h3>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if($cart != null): ?>
                            <div class="row cart-middle">
                                <div class="col-lg-6 offset-lg-6 col-sm-12">
                                    <div class="update-cart float-right d-inline-block ml-4">
                                        <a class="main-btn main-btn-2 proceed-checkout-btn"
                                            href="<?php echo e(route('user.product.front.checkout', getParam())); ?>">
                                            <span><?php echo e($keywords['Checkout'] ?? __('Checkout')); ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('user-front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/user-front/product/cart.blade.php ENDPATH**/ ?>