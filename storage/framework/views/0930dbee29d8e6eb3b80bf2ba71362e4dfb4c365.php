<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h4 class="page-title">Customers</h4>
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
            <a href="#">Customers</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Customers</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card-title d-inline-block">Customers</div>
                    </div>
                    <div class="col-lg-3">
                        <form action="<?php echo e(url()->full()); ?>">
                            <input type="text" class="form-control" name="term" placeholder="Search by Phone / Name" value="<?php echo e(request()->input('term')); ?>">
                        </form>
                    </div>
                    <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
                        <a href="#" class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i> Add Customer</a>
                        <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete" data-href="<?php echo e(route('user.customer.bulk.delete')); ?>"><i class="flaticon-interface-5"></i> Delete</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php if(count($customers) == 0): ?>
                        <h3 class="text-center">NO CUSTOMER FOUND</h3>
                        <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <input type="checkbox" class="bulk-check" data-val="all">
                                        </th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($customer->id); ?>">
                                        </td>
                                        <td><?php echo e(strlen($customer->name) > 30 ? mb_substr($customer->name,0,30,'utf-8') . '...' : $customer->name); ?></td>
                                        <td><?php echo e($customer->phone); ?></td>
                                        <td>  <?php echo e(!empty($customer->email) ? $customer->email : '-'); ?></td>
                                        <td>
                                            <a class="btn btn-secondary my-2 btn-sm editbtn" href="#editModal" data-toggle="modal" data-customer_id="<?php echo e($customer->id); ?>" data-name="<?php echo e($customer->name); ?>" data-phone="<?php echo e($customer->phone); ?>" data-email="<?php echo e($customer->email); ?>" data-address="<?php echo e($customer->address); ?>">
                                                <span class="btn-label">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                                
                                            </a>
                                            <form class="deleteform d-inline-block" action="<?php echo e(route('user.customer.delete')); ?>" method="post">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="customer_id" value="<?php echo e($customer->id); ?>">
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
            <div class="card-footer">
              <div class="row">
                <div class="d-inline-block mx-auto">
                  <?php echo e($customers->appends(['term' => request()->input('term')])->links()); ?>

                </div>
              </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ajaxForm" class="modal-form create" action="<?php echo e(route('user.customer.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="">Name **</label>
                        <input type="text" class="form-control" name="name" value="" placeholder="Enter name">
                        <p id="errname" class="mb-0 text-danger em"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Phone **</label>
                        <input type="text" class="form-control" name="phone" value="" placeholder="Enter phone">
                        <p id="errphone" class="mb-0 text-danger em"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Email </label>
                        <input type="text" class="form-control" name="email" value="" placeholder="Enter email">
                        <p id="erremail" class="mb-0 text-danger em"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Address </label>
                        <textarea name="address" class="form-control" rows="2"></textarea>
                        <p id="erraddress" class="mb-0 text-danger em"></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="submitBtn" type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ajaxEditForm" class="" action="<?php echo e(route('user.customer.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input id="incustomer_id" type="hidden" name="customer_id" value="">

                    <div class="form-group">
                        <label for="">Name **</label>
                        <input id="inname" type="text" class="form-control" name="name" value="" placeholder="Enter name">
                        <p id="eerrname" class="mb-0 text-danger em"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Phone **</label>
                        <input id="inphone" type="text" class="form-control" name="phone" value="" placeholder="Enter phone">
                        <p id="eerrphone" class="mb-0 text-danger em"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Email </label>
                        <input id="inemail" type="text" class="form-control" name="email" value="" placeholder="Enter email">
                        <p id="eerremail" class="mb-0 text-danger em"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Address </label>
                        <textarea id="inaddress" name="Address" class="form-control" rows="2"></textarea>
                        <p id="eerraddress" class="mb-0 text-danger em"></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="updateBtn" type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\BritBite-Company-England\britbite-git\britbite\resources\views/user/customers/index.blade.php ENDPATH**/ ?>