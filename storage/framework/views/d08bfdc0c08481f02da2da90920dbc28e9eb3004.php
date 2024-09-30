<?php
use App\Constants\Constant;
use App\Http\Helpers\Uploader;
?>



<?php $__env->startSection('styles'); ?>
<style>
    @media only screen and (max-width: 1500px) {
        .card-title {
            font-size: 15px;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h4 class="page-title"><?php echo e(__('Order Edit')); ?></h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="<?php echo e(route('user.dashboard')); ?>">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(url()->previous()); ?>"><?php echo e(__('Order Management')); ?></a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(url()->previous()); ?>"><?php echo e(__('Orders')); ?></a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#"><?php echo e(__('Edit')); ?></a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title d-flex justify-content-between">
                    <span><?php echo e(__('Order')); ?> [ <?php echo e($order->order_number); ?> ]</span>
                    <?php if(!empty($order->token_no)): ?>
                    <span>Token No. <?php echo e($order->token_no); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <form id="productOrder" class="" action="<?php echo e(route('user.product.orders.update')); ?>" method="post"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="order_id" value="<?php echo e($order->id); ?>">

                <div class="card-body pt-5 pb-5 m-3">
                    <div class="payment-information">

                        <?php if(!empty($order->type)): ?>
                        <div class="row mb-2">
                            <label for="order_type"><strong><?php echo e(__('Ordered From')); ?></strong></label>
                            <select name="order_type" class="form-control" id="order_type">
                                <option disabled><?php echo e(__('Select Order Source')); ?></option>
                                <option value="website" <?php echo e(strtolower($order->type) == 'website' ? 'selected' : ''); ?>>
                                    <?php echo e(__('Website Menu')); ?>

                                </option>
                                <option value="qr" <?php echo e(strtolower($order->type) == 'qr' ? 'selected' : ''); ?>>
                                    <?php echo e(__('QR Menu')); ?>

                                </option>
                                <option value="pos" <?php echo e(strtolower($order->type) == 'pos' ? 'selected' : ''); ?>>
                                    <?php echo e(__('POS')); ?>

                                </option>
                            </select>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($order->serving_method)): ?>
                        <div class="row mb-2">
                            <label for="serving_method"><strong><?php echo e(__('Serving Method')); ?>:</strong></label>
                            <select name="serving_method" class="form-control" id="serving_method">
                                <option disabled><?php echo e(__('Select Serving Method')); ?></option>
                                <option value="on_table" <?php echo e(strtolower($order->serving_method) == 'on_table' ? 'selected' : ''); ?>>
                                    <?php echo e(__('On Table')); ?>

                                </option>
                                <option value="home_delivery" <?php echo e(strtolower($order->serving_method) == 'home_delivery' ? 'selected' : ''); ?>>
                                    <?php echo e(__('Home Delivery')); ?>

                                </option>
                                <option value="pick_up" <?php echo e(strtolower($order->serving_method) == 'pick_up' ? 'selected' : ''); ?>>
                                    <?php echo e(__('Pick Up')); ?>

                                </option>
                            </select>
                        </div>
                        <?php endif; ?>

                        <div class="row mb-2">
                            <label><strong><?php echo e(__('Postal Code')); ?> (Delivery Area) </strong></label>
                            <input type="text" class="form-control"
                                name="postal_code"
                                placeholder="Enter Postal Code"
                                value="<?php echo e($order->postal_code ?? '-'); ?>">
                        </div>

                        <div class="row mb-2">
                            <label><strong>
                                    <?php echo e(__('Cart Total')); ?>

                                    (
                                    <?php echo e($order->currency_symbol_position == 'left' ? $order->currency_symbol : ''); ?>

                                    <?php echo e($order->currency_symbol_position == 'right' ? $order->currency_symbol : ''); ?>

                                    )
                                </strong></label>
                            <input type="text" class="form-control"
                                name="total"
                                placeholder="Enter Currency"
                                value="<?php echo e($order->coupon - $order->tax - $order->shipping_charge + $order->total); ?>">
                        </div>

                        <div class="row mb-2">
                            <label><strong><?php echo e(__('Discount')); ?>

                                    (
                                    <?php echo e($order->currency_symbol_position == 'left' ? $order->currency_symbol : ''); ?>

                                    <?php echo e($order->currency_symbol_position == 'right' ? $order->currency_symbol : ''); ?>

                                    )
                                </strong></label>
                            <input type="text" class="form-control"
                                name="discount"
                                placeholder="Enter Discount"
                                value="<?php echo e($order->coupon); ?>">
                        </div>

                        <div class="row mb-2">
                            <label><strong><?php echo e(__('Tax')); ?>

                                    (
                                    <?php echo e($order->currency_symbol_position == 'left' ? $order->currency_symbol : ''); ?>

                                    <?php echo e($order->currency_symbol_position == 'right' ? $order->currency_symbol : ''); ?>

                                    )
                                </strong></label>
                            <input type="text" class="form-control"
                                name="tax"
                                placeholder="Enter Tax"
                                value="<?php echo e($order->tax); ?>">
                        </div>

                        <div class="row mb-2">
                            <label><strong><?php echo e(__('Shipping Charge')); ?>

                                    (
                                    <?php echo e($order->currency_symbol_position == 'left' ? $order->currency_symbol : ''); ?>

                                    <?php echo e($order->currency_symbol_position == 'right' ? $order->currency_symbol : ''); ?>

                                    )
                                </strong></label>
                            <input type="text" class="form-control"
                                name="shipping_charge"
                                placeholder="Enter Shipping Charge"
                                value="<?php echo e(!empty($order->shipping_charge) ? $order->shipping_charge : 0); ?>">

                        </div>

                        <div class="row mb-2">
                            <label><strong><?php echo e(__('Total')); ?>

                                    (
                                    <?php echo e($order->currency_symbol_position == 'left' ? $order->currency_symbol : ''); ?>

                                    <?php echo e($order->currency_symbol_position == 'right' ? $order->currency_symbol : ''); ?>

                                    )
                                </strong></label>
                            <input type="text" class="form-control"
                                name="total"
                                placeholder="Enter Total"
                                value="<?php echo e($order->total); ?>">
                        </div>

                        <div class="row mb-2">
                            <label><strong><?php echo e(__('Payment Gateway')); ?></strong></label>
                            <input type="text" class="form-control"
                                name="payment_method"
                                placeholder="Enter Payment Gateway"
                                value="<?php echo e(convertUtf8($order->method)); ?>">
                        </div>

                        <?php if(!empty($order->receipt)): ?>
                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <strong><?php echo e(__('Receipt')); ?> :</strong>
                            </div>
                            <div class="col-lg-6 text-capitalize">
                                <a href="#" data-toggle="modal" data-target="#receiptModal">Show</a>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="row mb-2">
                            <label><strong><?php echo e(__('Payment Status')); ?>:</strong></label>
                            <input type="text" class="form-control"
                                name="payment_status"
                                placeholder="Enter Payment Status"
                                value="<?php echo e(convertUtf8($order->payment_status)); ?>"
                                readonly>
                        </div>

                        <div class="row mb-2">
                            <label><strong><?php echo e(__('Order Status')); ?>:</strong></label>
                            <input type="text" class="form-control"
                                name="order_status"
                                placeholder="Enter Order Status"
                                value="<?php echo e(convertUtf8(str_replace('_', ' ', $order->order_status))); ?>"
                                readonly>
                        </div>

                        <div class="row mb-2">
                            <label><strong><?php echo e(__('Complete')); ?>:</strong></label>
                            <input type="text" class="form-control"
                                name="complete"
                                placeholder="Enter Completion Status"
                                value="<?php echo e(strtolower($order->completed) == 'yes' ? __('Yes') : __('No')); ?>"
                                readonly>
                        </div>

                        <?php if($order->serving_method == 'home_delivery'): ?>
                        <div class="row mb-2">
                            <label><strong><?php echo e(__('Preferred Delivery Date')); ?>:</strong></label>
                            <input type="text" class="form-control"
                                name="preferred_delivery_date"
                                value="<?php echo e($order->delivery_date ? $order->delivery_date : '-'); ?>"
                                readonly>
                        </div>


                        <div class="row mb-2">
                            <label><strong><?php echo e(__('Preferred Delivery Time Frame')); ?>:</strong></label>
                            <input type="text" class="form-control"
                                name="preferred_delivery_time_frame"
                                value="<?php echo e($order->delivery_time_start); ?> - <?php echo e($order->delivery_time_end); ?>"
                                readonly>
                        </div>
                        <?php endif; ?>


                        <div class="row mb-2">
                            <label><strong><?php echo e(__('Time')); ?>:</strong></label>
                            <input type="text" class="form-control"
                                name="order_time"
                                value="<?php echo e($order->created_at); ?>"
                                readonly>
                        </div>


                        <div class="row mb-0">
                            <label><strong><?php echo e(__('Order Notes')); ?>:</strong></label>
                            <input type="text" class="form-control"
                                name="order_notes"
                                value="<?php echo e(!empty($order->order_notes) ? __('Notes available') : '-'); ?>">
                            <?php if(!empty($order->order_notes)): ?>
                            <button class="btn btn-info btn-sm mt-2" data-toggle="modal" data-target="#modalNotes">
                                Show
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>


                    <div class="modal fade" id="modalNotes" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Order Notes</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php echo e($order->order_notes); ?>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="form">
                        <div class="form-group from-show-notify row">
                            <div class="col-12 text-center">
                                <button type="submit" form="productOrder" class="btn btn-success">
                                    <?php echo e(__('Update')); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if($order->serving_method == 'home_delivery' && $order->type != 'pos'): ?>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title d-inline-block">Shipping Details</div>

            </div>
            <form id="shippingDetails" class="" action="<?php echo e(route('user.product.orders.update.shipping.details')); ?>" method="post"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="order_id" value="<?php echo e($order->id); ?>">
                <div class="card-body pt-5 pb-5 m-3">
                    <div class="payment-information">
                        <?php if(!empty($order->shipping_fname)): ?>
                        <div class="row mb-2">
                            <label for="shipping_fname"><strong><?php echo e(__('Name')); ?>:</strong></label>
                            <input type="text" class="form-control" id="shipping_fname" name="shipping_fname"
                                value="<?php echo e(convertUtf8($order->shipping_fname)); ?>" placeholder="Enter Name">
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($order->shipping_email)): ?>
                        <div class="row mb-2">
                            <label for="shipping_email"><strong><?php echo e(__('Email')); ?>:</strong></label>
                            <input type="email" class="form-control" id="shipping_email" name="shipping_email"
                                value="<?php echo e(convertUtf8($order->shipping_email)); ?>" placeholder="Enter Email">
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($order->shipping_number)): ?>
                        <div class="row mb-2">
                            <label for="shipping_number"><strong><?php echo e(__('Phone Number')); ?>:</strong></label>
                            <input type="text" class="form-control" id="shipping_number" name="shipping_number"
                                value="<?php echo e($order->billing_country_code); ?><?php echo e($order->shipping_number); ?>" placeholder="Enter Phone Number">
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($order->shipping_city)): ?>
                        <div class="row mb-2">
                            <label for="shipping_city"><strong><?php echo e(__('City')); ?>:</strong></label>
                            <input type="text" class="form-control" id="shipping_city" name="shipping_city"
                                value="<?php echo e(convertUtf8($order->shipping_city)); ?>" placeholder="Enter City">
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($order->shipping_address)): ?>
                        <div class="row mb-2">
                            <label for="shipping_address"><strong><?php echo e(__('Address')); ?>:</strong></label>
                            <input type="text" class="form-control" id="shipping_address" name="shipping_address"
                                value="<?php echo e(convertUtf8($order->shipping_address)); ?>" placeholder="Enter Address">
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($order->shipping_country)): ?>
                        <div class="row mb-2">
                            <label for="shipping_country"><strong><?php echo e(__('Country')); ?>:</strong></label>
                            <input type="text" class="form-control" id="shipping_country" name="shipping_country"
                                value="<?php echo e(convertUtf8($order->shipping_country)); ?>" placeholder="Enter Country">
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="card-footer">
                    <div class="form">
                        <div class="form-group from-show-notify row">
                            <div class="col-12 text-center">
                                <button type="submit" form="shippingDetails" class="btn btn-success">
                                    <?php echo e(__('Update')); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <?php endif; ?>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title d-inline-block">
                    <?php if($order->serving_method == 'home_delivery'): ?>
                    Billing Details
                    <?php else: ?>
                    Information
                    <?php endif; ?>
                </div>
            </div>
            <form id="billingDetails" class="" action="<?php echo e(route('user.product.orders.update.billing.details')); ?>" method="post"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="order_id" value="<?php echo e($order->id); ?>">
                <div class="card-body pt-5 pb-5 m-3">
                    <div class="payment-information">
                        <?php if(!empty($order->billing_fname)): ?>
                        <div class="row mb-2">
                            <label for="billing_name"><strong><?php echo e(__('Name')); ?>:</strong></label>
                            <input type="text" class="form-control" id="billing_name" name="billing_fname"
                                value="<?php echo e(convertUtf8($order->billing_fname)); ?>" placeholder="Enter Name">
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($order->billing_email)): ?>
                        <div class="row mb-2">
                            <label for="billing_email"><strong><?php echo e(__('Email')); ?>:</strong></label>
                            <input type="email" class="form-control" id="billing_email" name="billing_email"
                                value="<?php echo e(convertUtf8($order->billing_email)); ?>" placeholder="Enter Email">
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($order->billing_number)): ?>
                        <div class="row mb-2">
                            <label for="billing_phone"><strong><?php echo e(__('Phone')); ?>:</strong></label>
                            <input type="text" class="form-control" id="billing_phone" name="billing_phone"
                                value="<?php echo e($order->billing_country_code); ?><?php echo e($order->billing_number); ?>"
                                placeholder="Enter Phone Number">
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($order->billing_city)): ?>
                        <div class="row mb-2">
                            <label for="billing_city"><strong><?php echo e(__('City')); ?>:</strong></label>
                            <input type="text" class="form-control" id="billing_city" name="billing_city"
                                value="<?php echo e(convertUtf8($order->billing_city)); ?>"
                                placeholder="Enter City">
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($order->billing_address)): ?>
                        <div class="row mb-2">
                            <label for="billing_address"><strong><?php echo e(__('Address')); ?>:</strong></label>
                            <input type="text" class="form-control" id="billing_address" name="billing_address"
                                value="<?php echo e(convertUtf8($order->billing_address)); ?>"
                                placeholder="Enter Address">
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($order->billing_country)): ?>
                        <div class="row mb-2">
                            <label for="billing_country"><strong><?php echo e(__('Country')); ?>:</strong></label>
                            <input type="text" class="form-control" id="billing_country" name="billing_country"
                                value="<?php echo e(convertUtf8($order->billing_country)); ?>"
                                placeholder="Enter Country">
                        </div>
                        <?php endif; ?>

                        <?php if($order->serving_method == 'on_table'): ?>
                        <?php if(!empty($order->table_number)): ?>
                        <div class="row mb-2">
                            <label for="table_number"><strong><?php echo e(__('Table Number')); ?>:</strong></label>
                            <input type="text" class="form-control" id="table_number" name="table_number"
                                value="<?php echo e(convertUtf8($order->table_number)); ?>"
                                placeholder="Enter Table Number">
                        </div>
                        <?php endif; ?>

                        <div class="row mb-2">
                            <label for="waiter_name"><strong><?php echo e(__('Waiter Name')); ?>:</strong></label>
                            <input type="text" class="form-control" id="waiter_name" name="waiter_name"
                                value="<?php echo e(!empty($order->waiter_name) ? convertUtf8($order->waiter_name) : ''); ?>"
                                placeholder="<?php echo e(__('Enter Waiter Name')); ?>">
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($order->serving_method == 'pick_up'): ?>
                    <?php if(!empty($order->pick_up_date)): ?>
                    <div class="row mb-2">
                        <label for="pick_up_date"><strong><?php echo e(__('Pick up Date')); ?>:</strong></label>
                        <input type="date" class="form-control" id="pick_up_date" name="pick_up_date"
                            value="<?php echo e(!empty($order->pick_up_date) ? date('Y-m-d', strtotime($order->pick_up_date)) : ''); ?>"
                            placeholder="<?php echo e(__('Select Pick Up Date')); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($order->pick_up_time)): ?>
                    <div class="row mb-2">
                        <label for="pick_up_time"><strong><?php echo e(__('Pick up Time')); ?>:</strong></label>
                        <input type="time" class="form-control" id="pick_up_time" name="pick_up_time"
                            value="<?php echo e(!empty($order->pick_up_time) ? $order->pick_up_time : ''); ?>"
                            placeholder="<?php echo e(__('Select Pick Up Time')); ?>">
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>

                </div>
                <div class="card-footer">
                    <div class="form">
                        <div class="form-group from-show-notify row">
                            <div class="col-12 text-center">
                                <button type="submit" form="billingDetails" class="btn btn-success">
                                    <?php echo e(__('Update')); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title"><?php echo e(__('Ordered Products')); ?></h4>
            <div class="">
                <a href="<?php echo e(route('user.pos', $order->id)); ?>" type="submit" class="btn btn-success">
                    <?php echo e(__('Add Items')); ?></a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive product-list">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo e(__('Product')); ?></th>
                            <th><?php echo e(__('Product Title')); ?></th>
                            <th><?php echo e(__('Price')); ?></th>
                            <th><?php echo e(__('Quantity')); ?></th>
                            <th><?php echo e(__('Total')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($key+1); ?></td>
                            <td><img
                                    src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_FEATURED_IMAGE,$item->product->feature_image,$userBs)); ?>"
                                    alt="product" width="100">
                            </td>
                            <td>
                                <strong class="mr-3"><?php echo e($item->productInfromation->title); ?></strong>
                                <br>
                                <?php
                                $variations = json_decode($item->variations, true);
                                ?>
                                <?php if(!empty($variations)): ?>
                                <strong class="mr-3"><?php echo e(__("Variation")); ?>:</strong>
                                <?php $__currentLoopData = $variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vKey => $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span
                                    class="text-capitalize"><?php echo e(str_replace("_"," ",$vKey)); ?>:</span> <?php echo e($variation["name"]); ?>

                                <?php if(!$loop->last): ?>
                                ,
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <br>
                                <?php endif; ?>
                                <?php
                                $addons = json_decode($item->addons, true);
                                ?>
                                <?php if(!empty($addons)): ?>
                                <strong class="mr-3">Addons:</strong>
                                <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($addon["name"]); ?>

                                <?php if(!$loop->last): ?>
                                ,
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong class="mr-2"><?php echo e(__("Product")); ?>:</strong>
                                <?php echo e($order->currency_code_position == 'left' ? $order->currency_code : ''); ?>

                                <span><?php echo e((float)$item->product_price); ?></span>
                                <?php echo e($order->currency_code_position == 'right' ? $order->currency_code : ''); ?>

                                <br>
                                <?php if(is_array($variations)): ?>
                                <strong class="mr-2"><?php echo e(__("Variation")); ?>: </strong>
                                <?php echo e($order->currency_code_position == 'left' ? $order->currency_code : ''); ?>

                                <span><?php echo e((float)$item->variations_price); ?></span>
                                <?php echo e($order->currency_code_position == 'right' ? $order->currency_code : ''); ?>

                                <br>
                                <?php endif; ?>
                                <?php if(is_array($addons)): ?>
                                <strong class="mr-2"><?php echo e(__("Addons")); ?>: </strong>
                                <?php echo e($order->currency_code_position == 'left' ? $order->currency_code : ''); ?>

                                <span><?php echo e((float)$item->addons_price); ?></span>
                                <?php echo e($order->currency_code_position == 'right' ? $order->currency_code : ''); ?>

                                <?php endif; ?>
                            </td>
                            <td><?php echo e($item->qty); ?></td>
                            <td>
                                <span><?php echo e($order->currency_code_position == 'left' ? $order->currency_code : ''); ?></span> <?php echo e($item->total); ?>

                                <span><?php echo e($order->currency_code_position == 'right' ? $order->currency_code : ''); ?></span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Receipt Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_RECEIPT,$order->receipt,$userBs)); ?>" alt="Receipt" width="200">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\BritBite-Company-England\britbite-git\britbite\resources\views/user/product/order/edit.blade.php ENDPATH**/ ?>