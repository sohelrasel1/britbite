<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h4 class="page-title"><?php echo e(__('Packages')); ?></h4>
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
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-title d-inline-block"><?php echo e(__('Package Page')); ?></div>
                        </div>
                        <div class="col-lg-4 offset-lg-4 mt-2 mt-lg-0">
                            <a href="#" class="btn btn-primary float-right btn-sm" data-toggle="modal"
                                data-target="#createModal"><i class="fas fa-plus"></i>
                                <?php echo e(__('Add Package')); ?></a>
                            <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete"
                                data-href="<?php echo e(route('admin.package.bulk.delete')); ?>"><i class="flaticon-interface-5"></i>
                                <?php echo e(__('Delete')); ?>

                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(count($packages) == 0): ?>
                                <h3 class="text-center"><?php echo e(__('NO PACKAGE FOUND YET')); ?></h3>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-striped mt-3" id="basic-datatables">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <input type="checkbox" class="bulk-check" data-val="all">
                                                </th>
                                                <th scope="col" width="35%"><?php echo e(__('Title')); ?></th>
                                                <th scope="col"><?php echo e(__('Discount Value')); ?></th>
                                                <th scope="col"><?php echo e(__('Cost')); ?></th>
                                                <th scope="col"><?php echo e(__('Status')); ?></th>
                                                <th scope="col"><?php echo e(__('Actions')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="bulk-check"
                                                            data-val="<?php echo e($package->id); ?>">
                                                    </td>
                                                    <td>
                                                         <?php echo e(strlen($package->title) > 120 ? mb_substr($package->title, 0, 120, 'UTF-8') . '...' : $package->title); ?>

                                                        <span class="badge badge-primary"><?php echo e($package->term); ?></span>
                                                    </td>
                                                  
                                                    <td>
                                                        <?php if($package->package_discount == 0): ?>
                                                            <?php echo e(__('No Discount')); ?>

                                                        <?php else: ?>
                                                            <?php echo e(format_price($package->package_discount)); ?>

                                                        <?php endif; ?>

                                                    </td>
                                                    <td>
                                                        <?php if($package->price == 0): ?>
                                                            <?php echo e(__('Free')); ?>

                                                        <?php else: ?>
                                                            <?php echo e(format_price($package->price)); ?>

                                                        <?php endif; ?>

                                                    </td>
                                                    <td>
                                                        <?php if($package->status == 1): ?>
                                                            <h2 class="d-inline-block">
                                                                <span
                                                                    class="badge badge-success"><?php echo e(__('Active')); ?></span>
                                                            </h2>
                                                        <?php else: ?>
                                                            <h2 class="d-inline-block">
                                                                <span
                                                                    class="badge badge-danger"><?php echo e(__('Deactive')); ?></span>
                                                            </h2>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-secondary btn-sm my-2"
                                                            href="<?php echo e(route('admin.package.edit', $package->id) . '?language=' . request()->input('language')); ?>">
                                                            <span class="btn-label">
                                                                <i class="fas fa-edit"></i>
                                                            </span>
                                                            
                                                        </a>
                                                        <form class="deleteform d-inline-block"
                                                            action="<?php echo e(route('admin.package.delete')); ?>" method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="package_id"
                                                                value="<?php echo e($package->id); ?>">
                                                            <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                                                <span class="btn-label">
                                                                    <i class="fas fa-trash"></i>
                                                                </span>
                                                                
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Add Package')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="ajaxForm" enctype="multipart/form-data" class="modal-form"
                        action="<?php echo e(route('admin.package.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="title"><?php echo e(__('Package title')); ?>*</label>
                            <input id="title" type="text" class="form-control" name="title"
                                placeholder="<?php echo e(__('Enter Package title')); ?>" value="">
                            <p id="errtitle" class="mb-0 text-danger em"></p>
                        </div>
                        <div class="form-group">
                            <label for="price"><?php echo e(__('Main Price')); ?> (<?php echo e($bex->base_currency_text); ?>)*</label>
                            <input id="price" type="number" class="form-control" name="price"
                                placeholder="<?php echo e(__('Enter Package main price')); ?>" value="">
                            <p class="text-warning mb-0">
                                <small><?php echo e(__('If price is 0 , then it will appear as free')); ?></small>
                            </p>
                            <p id="errprice" class="mb-0 text-danger em"></p>
                        </div>
                        <div class="form-group">
                            <label for="price"><?php echo e(__('Discount Price')); ?> (<?php echo e($bex->base_currency_text); ?>)</label>
                            <input id="package_discount" type="text" class="form-control" name="package_discount"
                                placeholder="<?php echo e(__('Enter Package discount price')); ?>" value="">
                            <p class="text-warning mb-0">
                                <small><?php echo e(__('If you give a discount, then give the discount price here')); ?></small>
                            </p>
                            <p id="errprice" class="mb-0 text-danger em"></p>
                        </div>
                        <div class="form-group">
                            <label for="term"><?php echo e(__('Package term')); ?>*</label>
                            <select id="term" name="term" class="form-control" required>
                                <option value="" selected disabled><?php echo e(__('Choose a Package term')); ?></option>
                                <option value="month"><?php echo e(__('month')); ?></option>
                                <option value="year"><?php echo e(__('year')); ?></option>
                                <option value="lifetime"><?php echo e(__('lifetime')); ?></option>
                            </select>
                            <p id="errterm" class="mb-0 text-danger em"></p>
                        </div>


                        <div class="form-group">
                             
                            <label class="form-label"><?php echo e(__('Package Features')); ?></label>
                            <div class="selectgroup selectgroup-pills">
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Custom Domain"
                                        class="selectgroup-input">
                                    <span class="selectgroup-button"><?php echo e(__('Custom Domain')); ?></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Subdomain"
                                        class="selectgroup-input">
                                    <span class="selectgroup-button"><?php echo e(__('Subdomain')); ?></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="POS" class="selectgroup-input">
                                    <span class="selectgroup-button"><?php echo e(__('POS')); ?></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Coupon" class="selectgroup-input">
                                    <span class="selectgroup-button"><?php echo e(__('Coupon')); ?></span>
                                </label>
                                <label class="selectgroup-item awsBtn">
                                    <input type="checkbox" name="features[]" value="Amazon AWS s3"
                                        class="selectgroup-input awsInput">
                                    <span class="selectgroup-button"><?php echo e(__('Amazon AWS s3')); ?></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Storage Limit"
                                        class="selectgroup-input storageLabel" id="storage">
                                    <span class="selectgroup-button"><?php echo e(__('Storage Limit')); ?></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Live Orders"
                                        class="selectgroup-input">
                                    <span class="selectgroup-button"><?php echo e(__('Realtime Order Refresh & Notification')); ?></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Whatsapp Order & Notification"
                                        class="selectgroup-input">
                                    <span class="selectgroup-button"><?php echo e(__('Whatsapp Order & Notification')); ?></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="QR Menu" class="selectgroup-input">
                                    <span class="selectgroup-button"><?php echo e(__('QR Menu')); ?></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Table Reservation"
                                        class="selectgroup-input" id="table-reservations">
                                    <span class="selectgroup-button"><?php echo e(__('Table Reservation')); ?></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Table QR Builder"
                                        class="selectgroup-input">
                                    <span class="selectgroup-button"><?php echo e(__('Table QR Builder')); ?></span>
                                </label>
                                <label class="selectgroup-item" id="call_waiter">
                                    <input type="checkbox" name="features[]" value="Call Waiter"
                                        class="selectgroup-input">
                                    <span class="selectgroup-button"><?php echo e(__('Call Waiter')); ?></span>
                                </label>

                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Staffs" class="selectgroup-input"
                                        id="staffs">
                                    <span class="selectgroup-button"><?php echo e(__('Staffs')); ?></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Blog" class="selectgroup-input">
                                    <span class="selectgroup-button"><?php echo e(__('Blog')); ?></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Custom Page"
                                        class="selectgroup-input">
                                    <span class="selectgroup-button"><?php echo e(__('Custom Page')); ?></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Online Order"
                                        class="selectgroup-input" id="orders">
                                    <span class="selectgroup-button"><?php echo e(__('Online Order')); ?></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="On Table" id="onTable"
                                        class="selectgroup-input">
                                    <span class="selectgroup-button"><?php echo e(__('On Table')); ?></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Pick Up" class="selectgroup-input">
                                    <span class="selectgroup-button"><?php echo e(__('Pick Up')); ?></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="Home Delivery" id="home_delivery"
                                        class="selectgroup-input">
                                    <span class="selectgroup-button"><?php echo e(__('Home Delivery')); ?></span>
                                </label>
                                <label class="selectgroup-item" id="postal_code">
                                    <input type="checkbox" name="features[]" value="Postal Code Based Delivery Charge"
                                        class="selectgroup-input">
                                    <span class="selectgroup-button"><?php echo e(__('Postal Code Based Delivery Charge')); ?></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="features[]" value="PWA Installability"
                                        class="selectgroup-input">
                                    <span class="selectgroup-button"><?php echo e(__('PWA Installability')); ?></span>
                                </label>
                            </div>
                          
                            <p id="erronline_order" class="mb-0 text-danger em"></p>
                            <p id="errpos_order" class="mb-0 text-danger em"></p>
                            <p id="errfeatures" class="mb-0 text-danger em"></p>
                        </div>

                        <div class="form-group" id="storage_input">
                            <label for="storage_limit"><?php echo e(__('Storage Limit')); ?>*</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="storage_limit"
                                    placeholder="<?php echo e(__('Enter Storage Limit')); ?>" value="">
                                <span class="input-group-text" id="basic-addon2">MB</span>
                                
                            </div>
                            <p id="errstorage_limit" class="mb-0 text-danger em"></p>
                             <p class="text-warning mb-0">
                                <small><?php echo e(__('Enter 999999 , then it will appear as unlimited')); ?></small>
                            </p>
                        </div>

                        <div class="form-group" id="staff_input">
                            <label for="staff_limit"><?php echo e(__('Number Of Staffs Limit')); ?>*</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="staff_limit"
                                    placeholder="<?php echo e(__('Enter Staff Limit')); ?>" value="">
                            </div>
                            <p id="errstaff_limit" class="mb-0 text-danger em"></p>
                            <p class="text-warning mb-0">
                                <small><?php echo e(__('Enter 999999 , then it will appear as unlimited')); ?></small>
                            </p>
                        </div>
                        <div class="form-group" id="order_input">
                            <label for="order_limit"><?php echo e(__('Number Of Orders Limit')); ?>*</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="order_limit"
                                    placeholder="<?php echo e(__('Enter Order Limit')); ?>" value="">
                            </div>
                            <p id="errorder_limit" class="mb-0 text-danger em"></p>
                            <p class="text-warning mb-0">
                                <small><?php echo e(__('Enter 999999 , then it will appear as unlimited')); ?></small>
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="categories_limit"><?php echo e(__('Number Of Categories Limit')); ?>*</label>
                            <input id="categories_limit" type="number" class="form-control" name="categories_limit"
                                placeholder="<?php echo e(__('Enter categories limit')); ?>" value="">
                            <p class="text-warning mb-0">
                                <small><?php echo e(__('Enter 999999 , then it will appear as unlimited')); ?></small>
                            </p>
                            <p id="errcategories_limit" class="mb-0 text-danger em"></p>
                        </div>
                        <div class="form-group">
                            <label for="subcategories_limit"><?php echo e(__('Number Of Subcategories Limit')); ?>*</label>
                            <input id="subcategories_limit" type="number" class="form-control"
                                name="subcategories_limit" placeholder="<?php echo e(__('Enter subcategories limit')); ?>"
                                value="">
                            <p class="text-warning mb-0">
                                <small><?php echo e(__('Enter 999999 , then it will appear as unlimited')); ?></small>
                            </p>
                            <p id="errsubcategories_limit" class="mb-0 text-danger em"></p>
                        </div>
                        <div class="form-group">
                            <label for="items_limit"><?php echo e(__('Number Of Items Limit')); ?>*</label>
                            <input id="items_limit" type="number" class="form-control" name="items_limit"
                                placeholder="<?php echo e(__('Enter items limit')); ?>" value="">
                            <p class="text-warning mb-0">
                                <small><?php echo e(__('Enter 999999 , then it will appear as unlimited')); ?></small>
                            </p>
                            <p id="erritems_limit" class="mb-0 text-danger em"></p>
                        </div>
                        <div class="form-group" id="table_reservation_input">
                            <label for="table_reservation_limit"><?php echo e(__('Number Of Table Reservations Limit')); ?>*</label>
                            <input id="table_reservation_limit" type="number" class="form-control"
                                name="table_reservation_limit" placeholder="<?php echo e(__('Enter table reservation limit')); ?>"
                                value="">
                            <p class="text-warning mb-0">
                                <small><?php echo e(__('Enter 999999 , then it will appear as unlimited')); ?></small>
                            </p>
                            <p id="errtable_reservation_limit" class="mb-0 text-danger em"></p>
                        </div>
                        <div class="form-group">
                            <label for="language_limit"><?php echo e(__('Number Of Languages Limit')); ?>*</label>
                            <input id="language_limit" type="number" class="form-control" name="language_limit"
                                placeholder="<?php echo e(__('Enter language limit')); ?>" value="">
                            <p class="text-warning mb-0">
                                <small><?php echo e(__('Enter 999999 , then it will appear as unlimited')); ?></small>
                            </p>
                            <p id="errlanguage_limit" class="mb-0 text-danger em"></p>
                        </div>
                        <div class="form-group">
                            <label class="form-label"><?php echo e(__('Featured')); ?> *</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="featured" value="1" class="selectgroup-input">
                                    <span class="selectgroup-button"><?php echo e(__('Yes')); ?></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="featured" value="0" class="selectgroup-input"
                                        checked>
                                    <span class="selectgroup-button"><?php echo e(__('No')); ?></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Recommended *</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="recommended" value="1" class="selectgroup-input">
                                    <span class="selectgroup-button">Yes</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="recommended" value="0" class="selectgroup-input"
                                        checked>
                                    <span class="selectgroup-button">No</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Icon **</label>
                            <div class="btn-group d-block">
                                <button type="button" class="btn btn-primary iconpicker-component"><i
                                        class="fa fa-fw fa-heart"></i></button>
                                <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                    data-selected="fa-car" data-toggle="dropdown">
                                </button>
                                <div class="dropdown-menu"></div>
                            </div>
                            <input id="inputIcon" type="hidden" name="icon" value="fas fa-heart">
                            <?php if($errors->has('icon')): ?>
                                <p class="mb-0 text-danger"><?php echo e($errors->first('icon')); ?></p>
                            <?php endif; ?>
                            <div class="mt-2">
                                <small>NB: click on the dropdown sign to select a icon.</small>
                            </div>
                            <p id="erricon" class="mb-0 text-danger em"></p>
                        </div>


                        <div class="form-group">
                            <label class="form-label"><?php echo e(__('Trial')); ?> *</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="is_trial" value="1" class="selectgroup-input">
                                    <span class="selectgroup-button"><?php echo e(__('Yes')); ?></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="is_trial" value="0" class="selectgroup-input"
                                        checked>
                                    <span class="selectgroup-button"><?php echo e(__('No')); ?></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group d-none" id="trial_day">
                            <label for="trial_days"><?php echo e(__('Trial days')); ?>*</label>
                            <input id="trial_days" type="number" class="form-control" name="trial_days"
                                placeholder="<?php echo e(__('Enter trial days')); ?>" value="">
                            <p id="errtrial_days" class="mb-0 text-danger em"></p>
                        </div>
                        <div class="form-group">
                            <label for="status"><?php echo e(__('Status')); ?>*</label>
                            <select id="status" class="form-control ltr" name="status">
                                <option value="" selected disabled><?php echo e(__('Select a status')); ?></option>
                                <option value="1"><?php echo e(__('Active')); ?></option>
                                <option value="0"><?php echo e(__('Deactive')); ?></option>
                            </select>
                            <p id="errstatus" class="mb-0 text-danger em"></p>
                        </div>
                        <div class="form-group">
                            <label for=""><?php echo e(__('Meta Keywords')); ?></label>
                            <input type="text" class="form-control" name="meta_keywords" value=""
                                data-role="tagsinput">
                        </div>
                        <div class="form-group">
                            <label for="meta_description"><?php echo e(__('Meta Description')); ?></label>
                            <textarea id="meta_description" type="text" class="form-control" name="meta_description" rows="5">
                            </textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                    <button id="submitBtn" type="button" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/admin/js/packages.js')); ?>"></script>
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\BritBite-Company-England\britbite-git\britbite\resources\views/admin/packages/index.blade.php ENDPATH**/ ?>