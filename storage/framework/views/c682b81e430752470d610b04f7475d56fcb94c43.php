<?php $__env->startSection('content'); ?>
<?php 
use App\Setting;
?>
        <div class="container emp-profile  table2 membreProfile "
            style="margin-top:-4%;"
        >
            <form method="post">
                <div class="row " >
                    <div class="col-md-12" style="text-align:center;">
                        <img src="<?php echo e(asset('img/logogymtime.png')); ?>" width="500px">
                    </div>
                </div>
                <div class="row " >

                    <div class="col-md-12 pad-20">
                        <div class="profile-head">
                                    <h5 style="text-align:center;">
                                        Bienvenue Chez Gym Time
                                    </h5>

                                    

                        </div>
                    </div>
                   
                </div>
                <div class="row">
                   
                    
                </div>
            </form>           
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.profile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>