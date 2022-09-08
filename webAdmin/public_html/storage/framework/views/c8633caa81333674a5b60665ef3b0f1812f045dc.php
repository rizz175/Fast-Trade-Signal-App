

<?php $__env->startSection('title'); ?>
    Historical Forex Signals
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="card">
    <table class="table datatable-save-state">
        <thead>
            <tr>
                <th>#</th>
                <th>Symbol</th>
                <th>Type</th>
                <th>TP</th>
                <th>SL</th>
                <th>Profit</th>
                <th>Action</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = App\Models\Forex::onlyTrashed()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $forex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($key+1); ?></td>
                <td><?php echo strtoupper($forex->symbol);?></td>
                <td><?php echo e($forex->type); ?></td>
                <td><?php echo e($forex->tp); ?></td>
                <td><?php echo e($forex->sl); ?></td>
                <td>
                    
                    <?php
                    
                    if($forex->profit!='')
                    {
                
                        echo $forex->profit.' pips';
                    }
                    else
                    {
                    
                        echo '-';
                    
                    }
                    
                    ?>
                
                </td>
                <td>
                    <button data-toggle="modal" data-target="#edit_modal" symbol="<?php echo e($forex->symbol); ?>"
                    id="<?php echo e($forex->id); ?>" type="<?php echo e($forex->type); ?>" tp="<?php echo e($forex->tp); ?>" sl="<?php echo e($forex->sl); ?>" lot="<?php echo e($forex->lot); ?>" profit="<?php echo e($forex->profit); ?>"
                     class="edit-btn btn btn-primary">Edit</button>
                </td>
                <td>
                    <form action="<?php echo e(route("deleteHistoricalForex",$forex->id)); ?>" method="POST">
                        
                        <?php echo csrf_field(); ?>
                    <button type="submit"  class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
       
<div id="edit_modal" class="modal fade">
    <div class="modal-dialog">
        <form id="updateForm" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Update Forex</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="symbol">Symbol</label>
                        <input class="form-control" type="text" id="symbol" name="symbol"  placeholder="Enter symbol"  onkeyup="this.value = this.value.toUpperCase();" required>
                    </div> 
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" class='form-control select2 validate-hidden' id='type' required>
    
                                <option value="">Select...</option>
                                    
                                <option  value="Buy">Buy</option>
                                
                                <option value="Sell">Sell</option>
                                
                                <option value="BuyStop">BuyStop</option>
                                
                                <option value="SellStop">SellStop</option>
                                												
                                <option value="BuyLimit">BuyLimit</option>
                                
                                <option value="SellLimit">SellLimit</option>
                                												
                            </select>
                    </div>
                     <div class="form-group">
                        <label for="tp">TP</label>
                        <input class="form-control" type="text" id="tp" name="tp" placeholder="Enter tp" required>
                    </div> 
                    <div class="form-group">
                        <label for="tp">SL</label>
                        <input class="form-control" type="text" id="sl" name="sl" placeholder="Enter sl" required>
                    </div>  
                    
                    <div class="form-group">
                        <label for="profit">Profit</label>
                        <input class="form-control" type="text" id="profit" name="profit" placeholder="Enter profit"  required>
                    </div>
        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function(){
        $('.edit-btn').click(function(){

            let id = $(this).attr('id');
            let symbol = $(this).attr('symbol');
            let type = $(this).attr('type');
            let tp = $(this).attr('tp');
            let sl = $(this).attr('sl');
            let profit = $(this).attr('profit');
        
            $('#id').val(id);
            $('#symbol').val(symbol);
            $('#type').val(type);
            $('#tp').val(tp);
            $('#sl').val(sl);
            $('#profit').val(profit);

            $('#updateForm').attr('action','<?php echo e(route('updatehistoricalforex','')); ?>' +'/'+id);
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/lmd3tsijnint/public_html/resources/views/historicalForex/index.blade.php ENDPATH**/ ?>