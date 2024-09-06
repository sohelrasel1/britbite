<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h4 class="page-title"><?php echo e(__('Edit package')); ?></h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#"><?php echo e(__('Packages')); ?></a>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-inline-block"><?php echo e(__('Edit package')); ?></div>
                    <a class="btn btn-info btn-sm float-right d-inline-block" href="<?php echo e(route('admin.package.index')); ?>">
                        <span class="btn-label">
                            <i class="fas fa-backward"></i>
                        </span>
                        <?php echo e(__('Back')); ?>

                    </a>
                </div>
                <div class="card-body pt-5 pb-5">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <form id="ajaxForm" class="" action="<?php echo e(route('admin.package.update')); ?>" method="post"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="package_id" value="<?php echo e($package->id); ?>">
                                <div class="form-group">
                                    <label for="title"><?php echo e(__('Package title')); ?>*</label>
                                    <input id="title" type="text" class="form-control" name="title"
                                        value="<?php echo e($package->title); ?>" placeholder="<?php echo e(__('Enter name')); ?>">
                                    <p id="errtitle" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="price"><?php echo e(__('Main Price')); ?> (<?php echo e($bex->base_currency_text); ?>)*</label>
                                    <input id="price" type="number" class="form-control" name="price"
                                        placeholder="<?php echo e(__('Enter Package price')); ?>" value="<?php echo e($package->price); ?>">
                                    <p class="text-warning mb-0">
                                        <small><?php echo e(__('If price is 0 , then it will appear as free')); ?></small></p>
                                    <p id="errprice" class="mb-0 text-danger em"></p>
                                </div>
                                
                                <div class="form-group">
                                    <label for="price"><?php echo e(__('Discount Price')); ?> (<?php echo e($bex->base_currency_text); ?>)*</label>
                                    <input id="package_discount" type="number" class="form-control" name="package_discount"
                                        placeholder="<?php echo e(__('Enter Package Discount price')); ?>" value="<?php echo e($package->package_discount); ?>">
                                    <p class="text-warning mb-0">
                                        <small><?php echo e(__('If you give a discount, then give the discount price here')); ?></small></p>
                                    <p id="errprice" class="mb-0 text-danger em"></p>
                                </div>

                                <div class="form-group">
                                    <label for="plan_term"><?php echo e(__('Package term')); ?>*</label>
                                    <select id="plan_term" name="term" class="form-control">
                                        <option value="" selected disabled><?php echo e(__('Select a Term')); ?></option>
                                        <option value="month" <?php echo e($package->term == 'month' ? 'selected' : ''); ?>>
                                            <?php echo e(__('month')); ?></option>
                                        <option value="year" <?php echo e($package->term == 'year' ? 'selected' : ''); ?>>
                                            <?php echo e(__('year')); ?></option>
                                        <option value="lifetime" <?php echo e($package->term == 'lifetime' ? 'selected' : ''); ?>>
                                            <?php echo e('lifetime'); ?></option>
                                    </select>
                                    <p id="errterm" class="mb-0 text-danger em"></p>
                                </div>
                                <?php
                                    $permissions = $package->features;
                                    if (!empty($package->features)) {
                                        $permissions = json_decode($permissions, true);
                                    }
                                ?>

                                <div class="form-group">
                                    <label class="form-label"><?php echo e(__('Package Features')); ?></label>
                                    <div class="selectgroup selectgroup-pills">
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="features[]" value="Custom Domain"
                                                class="selectgroup-input" <?php if(is_array($permissions) && in_array('Custom Domain', $permissions)): ?> checked <?php endif; ?>>
                                            <span class="selectgroup-button"><?php echo e(__('Custom Domain')); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="features[]" value="Subdomain"
                                                class="selectgroup-input" <?php if(is_array($permissions) && in_array('Subdomain', $permissions)): ?> checked <?php endif; ?>>
                                            <span class="selectgroup-button"><?php echo e(__('Subdomain')); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="features[]" value="POS"
                                                class="selectgroup-input" <?php if(is_array($permissions) && in_array('POS', $permissions)): ?> checked <?php endif; ?>>
                                            <span class="selectgroup-button"><?php echo e(__('POS')); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="features[]" value="Coupon"
                                                class="selectgroup-input" <?php if(is_array($permissions) && in_array('Coupon', $permissions)): ?> checked <?php endif; ?>>
                                            <span class="selectgroup-button"><?php echo e(__('Coupon')); ?></span>
                                        </label>
                                        <label class="selectgroup-item awsBtn">
                                            <input type="checkbox" name="features[]" value="Amazon AWS s3"
                                                class="selectgroup-input awsInput"
                                                <?php if(is_array($permissions) && in_array('Amazon AWS s3', $permissions)): ?> checked <?php endif; ?>>
                                            <span class="selectgroup-button"><?php echo e(__('Amazon AWS s3')); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input id="storage" type="checkbox" name="features[]"
                                                value="Storage Limit" class="selectgroup-input"
                                                <?php if(is_array($permissions) && in_array('Storage Limit', $permissions)): ?> checked <?php endif; ?>>
                                            <span class="selectgroup-button"><?php echo e(__('Storage Limit')); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="features[]" value="Live Orders"
                                                class="selectgroup-input" <?php if(is_array($permissions) && in_array('Live Orders', $permissions)): ?> checked <?php endif; ?>>
                                            <span class="selectgroup-button"><?php echo e(__('Realtime Order Refresh & Notification')); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="features[]"
                                                value="Whatsapp Order & Notification" class="selectgroup-input"
                                                <?php if(is_array($permissions) && in_array('Whatsapp Order & Notification', $permissions)): ?> checked <?php endif; ?>>
                                            <span
                                                class="selectgroup-button"><?php echo e(__('Whatsapp Order & Notification')); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="features[]" value="QR Menu"
                                                class="selectgroup-input" <?php if(is_array($permissions) && in_array('QR Menu', $permissions)): ?> checked <?php endif; ?>>
                                            <span class="selectgroup-button"><?php echo e(__('QR Menu')); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="features[]" value="Table Reservation"
                                                class="selectgroup-input" <?php if(is_array($permissions) && in_array('Table Reservation', $permissions)): ?> checked <?php endif; ?>
                                                id="table-reservations">
                                            <span class="selectgroup-button"><?php echo e(__('Table Reservation')); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="features[]" value="Table QR Builder"
                                                class="selectgroup-input"
                                                <?php if(is_array($permissions) && in_array('Table QR Builder', $permissions)): ?> checked <?php endif; ?>>
                                            <span class="selectgroup-button"><?php echo e(__('Table QR Builder')); ?></span>
                                        </label>
                                        <label class="selectgroup-item" id="callWaiter">
                                            <input type="checkbox" name="features[]" value="Call Waiter"
                                                class="selectgroup-input"
                                                <?php if(is_array($permissions) && in_array('Call Waiter', $permissions)): ?> checked <?php endif; ?>>
                                            <span class="selectgroup-button"><?php echo e(__('Call Waiter')); ?></span>
                                        </label>

                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="features[]" value="Staffs"
                                                class="selectgroup-input"
                                                <?php if(is_array($permissions) && in_array('Staffs', $permissions)): ?> checked <?php endif; ?> id="staffs">
                                            <span class="selectgroup-button"><?php echo e(__('Staffs')); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="features[]" value="Blog"
                                                class="selectgroup-input"
                                                <?php if(is_array($permissions) && in_array('Blog', $permissions)): ?> checked <?php endif; ?>>
                                            <span class="selectgroup-button"><?php echo e(__('Blog')); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="features[]" value="Custom Page"
                                                class="selectgroup-input"
                                                <?php if(is_array($permissions) && in_array('Custom Page', $permissions)): ?> checked <?php endif; ?>>
                                            <span class="selectgroup-button"><?php echo e(__('Custom Page')); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="features[]" value="Online Order"
                                                class="selectgroup-input"
                                                <?php if(is_array($permissions) && in_array('Online Order', $permissions)): ?> checked <?php endif; ?> id="orders">
                                            <span class="selectgroup-button"><?php echo e(__('Online Order')); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="features[]" value="On Table" id="onTable"
                                                class="selectgroup-input"
                                                <?php if(is_array($permissions) && in_array('On Table', $permissions)): ?> checked <?php endif; ?>>
                                            <span class="selectgroup-button"><?php echo e(__('On Table')); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="features[]" value="Pick Up"
                                                class="selectgroup-input"
                                                <?php if(is_array($permissions) && in_array('Pick Up', $permissions)): ?> checked <?php endif; ?>>
                                            <span class="selectgroup-button"><?php echo e(__('Pick Up')); ?></span>
                                        </label>

                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="features[]" value="Home Delivery"
                                                id="home_deliveryEdit" class="selectgroup-input"
                                                <?php if(is_array($permissions) && in_array('Home Delivery', $permissions)): ?> checked <?php endif; ?>>
                                            <span class="selectgroup-button"><?php echo e(__('Home Delivery')); ?></span>
                                        </label>
                                        <label class="selectgroup-item" id="postalCodeEdit">
                                            <input type="checkbox" name="features[]"
                                                value="Postal Code Based Delivery Charge" class="selectgroup-input"
                                                <?php if(is_array($permissions) && in_array('Postal Code Based Delivery Charge', $permissions)): ?> checked <?php endif; ?>>
                                            <span
                                                class="selectgroup-button"><?php echo e(__('Postal Code Based Delivery Charge')); ?></span>
                                        </label>

                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="features[]" value="PWA Installability"
                                                class="selectgroup-input"
                                                <?php if(is_array($permissions) && in_array('PWA Installability', $permissions)): ?> checked <?php endif; ?>>
                                            <span class="selectgroup-button"><?php echo e(__('PWA Installability')); ?></span>
                                        </label>
                                    </div>
                                </div>
                                <p id="erronline_order" class="mb-0 text-danger em"></p>
                                <p id="errpos_order" class="mb-0 text-danger em"></p>
                                <p id="errfeatures" class="mb-0 text-danger em"></p>

                                <div class="form-group" id="storage_input">
                                    <label for="storage_limit"><?php echo e(__('Storage Limit')); ?>*</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="storage_limit"
                                            placeholder="<?php echo e(__('Enter Storage Limit')); ?>"
                                            value="<?php echo e($package->storage_limit); ?>">
                                        <span class="input-group-text" id="basic-addon2">MB</span>
                                    </div>
                                    <p id="errstorage_limit" class="mb-0 text-danger em"></p>
                                    <p class="text-warning mb-0">
                                        <small><?php echo e(__('Enter 999999 , then it will appear as unlimited')); ?></small>
                                    </p>
                                </div>
                                <div class="form-group" id="staff_input">
                                    <label for="staff_limit"><?php echo e(__('Staff Limit')); ?>*</label>
                                    <input id="staff_limit" type="number" class="form-control" name="staff_limit"
                                        placeholder="<?php echo e(__('Enter staff limit')); ?>" value="<?php echo e($package->staff_limit); ?>">
                                    <p class="text-warning mb-0">
                                        <small><?php echo e(__('Enter 999999 , then it will appear as unlimited')); ?></small></p>
                                    <p id="errstaff_limit" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group" id="order_input">
                                    <label for="order_limit"><?php echo e(__('Number Of Orders Limit')); ?>*</label>
                                    <input id="order_limit" type="number" class="form-control" name="order_limit"
                                        placeholder="<?php echo e(__('Enter order limit')); ?>" value="<?php echo e($package->order_limit); ?>">
                                    <p class="text-warning mb-0">
                                        <small><?php echo e(__('Enter 999999 , then it will appear as unlimited')); ?></small></p>
                                    <p id="errorder_limit" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="categories_limit"><?php echo e(__('Number Of Categories Limit')); ?>*</label>
                                    <input id="categories_limit" type="number" class="form-control"
                                        name="categories_limit" placeholder="<?php echo e(__('Enter categories limit')); ?>"
                                        value="<?php echo e($package->categories_limit); ?>">
                                    <p class="text-warning mb-0">
                                        <small><?php echo e(__('Enter 999999 , then it will appear as unlimited')); ?></small></p>
                                    <p id="errcategories_limit" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="subcategories_limit"><?php echo e(__('Number Of Subcategories Limit')); ?>*</label>
                                    <input id="subcategories_limit" type="number" class="form-control"
                                        name="subcategories_limit" placeholder="<?php echo e(__('Enter subcategories limit')); ?>"
                                        value="<?php echo e($package->subcategories_limit); ?>">
                                    <p class="text-warning mb-0">
                                        <small><?php echo e(__('Enter 999999 , then it will appear as unlimited')); ?></small></p>
                                    <p id="errsubcategories_limit" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="items_limit"><?php echo e(__('Number Of Items Limit')); ?>*</label>
                                    <input id="items_limit" type="number" class="form-control" name="items_limit"
                                        placeholder="<?php echo e(__('Enter items limit')); ?>" value="<?php echo e($package->items_limit); ?>">
                                    <p class="text-warning mb-0">
                                        <small><?php echo e(__('Enter 999999 , then it will appear as unlimited')); ?></small></p>
                                    <p id="erritems_limit" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group" id="table_reservation_input">
                                    <label
                                        for="table_reservation_limit"><?php echo e(__('Number Of Table Reservations Limit')); ?>*</label>
                                    <input id="table_reservation_limit" type="number" class="form-control"
                                        name="table_reservation_limit"
                                        placeholder="<?php echo e(__('Enter table reservation limit')); ?>"
                                        value="<?php echo e($package->table_reservation_limit); ?>">
                                    <p class="text-warning mb-0">
                                        <small><?php echo e(__('Enter 999999 , then it will appear as unlimited')); ?></small></p>
                                    <p id="errtable_reservation_limit" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="language_limit"><?php echo e(__('Number Of Languages Limit')); ?>*</label>
                                    <input id="language_limit" type="number" class="form-control" name="language_limit"
                                        placeholder="<?php echo e(__('Enter language limit')); ?>"
                                        value="<?php echo e($package->language_limit); ?>">
                                    <p class="text-warning mb-0">
                                        <small><?php echo e(__('Enter 999999 , then it will appear as unlimited')); ?></small></p>
                                    <p id="errlanguage_limit" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(__('Featured')); ?> *</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="featured" value="1"
                                                class="selectgroup-input" <?php echo e($package->featured == 1 ? 'checked' : ''); ?>>
                                            <span class="selectgroup-button"><?php echo e(__('Yes')); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="featured" value="0"
                                                class="selectgroup-input" <?php echo e($package->featured == 0 ? 'checked' : ''); ?>>
                                            <span class="selectgroup-button"><?php echo e(__('No')); ?></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label"><?php echo e(__('Trial')); ?> *</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="is_trial" value="1"
                                                class="selectgroup-input" <?php echo e($package->is_trial == 1 ? 'checked' : ''); ?>>
                                            <span class="selectgroup-button"><?php echo e(__('Yes')); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="is_trial" value="0"
                                                class="selectgroup-input" <?php echo e($package->is_trial == 0 ? 'checked' : ''); ?>>
                                            <span class="selectgroup-button"><?php echo e(__('No')); ?></span>
                                        </label>
                                    </div>
                                </div>
                                <p id="erronline_order" class="mb-0 text-danger em"></p>
                                <div class="form-group">
                                    <label class="form-label">Recommended *</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="recommended" value="1"
                                                class="selectgroup-input"<?php echo e($package->recommended == 1 ? 'checked' : ''); ?>>
                                            <span class="selectgroup-button">Yes</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="recommended" value="0"
                                                class="selectgroup-input"
                                                <?php echo e($package->recommended == 0 ? 'checked' : ''); ?>>
                                            <span class="selectgroup-button">No</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Icon **</label>
                                    <div class="btn-group d-block">
                                        <button type="button" class="btn btn-primary iconpicker-component"><i
                                                class="<?php echo e($package->icon); ?>"></i></button>
                                        <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                            data-selected="fa-car" data-toggle="dropdown">
                                        </button>
                                        <div class="dropdown-menu"></div>
                                    </div>
                                    <input id="inputIcon" type="hidden" name="icon" value="<?php echo e($package->icon); ?>">
                                    <?php if($errors->has('icon')): ?>
                                        <p class="mb-0 text-danger"><?php echo e($errors->first('icon')); ?></p>
                                    <?php endif; ?>
                                    <div class="mt-2">
                                        <small>NB: click on the dropdown sign to select an icon.</small>
                                    </div>
                                </div>
                                <?php if($package->is_trial == 1): ?>
                                    <div class="form-group d-none" id="trial_day" >
                                        <label for="trial_days_2"><?php echo e(__('Trial days')); ?>*</label>
                                        <input id="trial_days_2" type="number" class="form-control" name="trial_days"
                                            placeholder="<?php echo e(__('Enter trial days')); ?>"
                                            value="<?php echo e($package->trial_days); ?>">
                                            <p id="errtrial_days" class="mb-0 text-danger em"></p> 
                                    </div>
                                <?php else: ?>
                                    <div class="form-group d-none" id="trial_day" >
                                        <label for="trial_days_1"><?php echo e(__('Trial days')); ?>*</label>
                                        <input id="trial_days_1" type="number" class="form-control" name="trial_days"
                                            placeholder="<?php echo e(__('Enter trial days')); ?>"
                                            value="<?php echo e($package->trial_days); ?>">
                                            <p id="errtrial_days" class="mb-0 text-danger em"></p>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="status"><?php echo e(__('Status')); ?>*</label>
                                    <select id="status" class="form-control ltr" name="status">
                                        <option value="" selected disabled><?php echo e(__('Select a status')); ?></option>
                                        <option value="1" <?php echo e($package->status == '1' ? 'selected' : ''); ?>>
                                            <?php echo e(__('Active')); ?></option>
                                        <option value="0" <?php echo e($package->status == '0' ? 'selected' : ''); ?>>
                                            <?php echo e(__('Deactive')); ?></option>
                                    </select>
                                    <p id="errstatus" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="meta_keywords"><?php echo e(__('Meta Keywords')); ?></label>
                                    <input id="meta_keywords" type="text" class="form-control" name="meta_keywords"
                                        value="<?php echo e($package->meta_keywords); ?>" data-role="tagsinput">
                                </div>
                                <div class="form-group">
                                    <label for="meta_description"><?php echo e(__('Meta Description')); ?></label>
                                    <textarea id="meta_description" type="text" class="form-control" name="meta_description" rows="5"><?php echo e($package->meta_description); ?></textarea>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form">
                        <div class="form-group from-show-notify row">
                            <div class="col-12 text-center">
                                <button type="submit" id="submitBtn"
                                    class="btn btn-success"><?php echo e(__('Update')); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        const permission = <?php echo json_encode($permissions) ?>;
        const trialVal = <?php echo e($package->is_trial); ?>;
    </script>
    <script src="<?php echo e(asset('assets/admin/js/edit-package.js')); ?>"></script>
  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\BritBite-Company-England\britbite-git\britbite\resources\views/admin/packages/edit.blade.php ENDPATH**/ ?>