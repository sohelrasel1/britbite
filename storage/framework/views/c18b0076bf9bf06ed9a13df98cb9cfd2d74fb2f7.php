
<div class="modal fade" id="createModal" data-focus="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLongTitle">Add Gateway</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
             
             <form id="ajaxForm" class="modal-form" action="<?php echo e(route('user.gateway.offline.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                           <label for="">Name **</label>
                           <input type="text" class="form-control" name="name" placeholder="Enter name" value="">
                           <p id="errname" class="mb-0 text-danger em"></p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                   <label for="">Short Description</label>
                   <textarea class="form-control" name="short_description" rows="3" cols="80" placeholder="Enter short description"></textarea>
                   <p id="errshort_description" class="mb-0 text-danger em"></p>
                </div>

                <div class="form-group">
                   <label for="">Instructions</label>
                   <textarea class="form-control summernote" name="instructions" id="instructions" rows="3" cols="80" placeholder="Enter instructions" data-height="150"></textarea>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                          <label>Receipt Image **</label>
                          <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="is_receipt" value="1" class="selectgroup-input" checked>
                                    <span class="selectgroup-button">Active</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="is_receipt" value="0" class="selectgroup-input">
                                    <span class="selectgroup-button">Deactive</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                           <label for="">Serial Number **</label>
                           <input type="number" class="form-control ltr" name="serial_number" value="" placeholder="Enter Serial Number">
                           <p id="errserial_number" class="mb-0 text-danger em"></p>
                           <p class="text-warning"><small>The higher the serial number is, the later the package will be shown everywhere.</small></p>
                        </div>
                    </div>
                </div>
             </form>
          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             <button id="submitBtn3" type="button" class="btn btn-primary">Submit</button>
          </div>
       </div>
    </div>
 </div>
<?php /**PATH G:\BritBite-Company-England\britbite-git\britbite\resources\views/user/gateways/offline/create.blade.php ENDPATH**/ ?>