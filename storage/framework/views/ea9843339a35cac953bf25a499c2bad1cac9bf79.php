<?php $__env->startSection('content'); ?>
<?php 
use App\Setting;
?>
        <div class="container emp-profile  table2 membreProfile "
            style="margin-top:-4%;"
        >
            <form method="post">
                <div class="row " >
                    <div class="col-md-4" style="text-align:center;">
                        
                    </div>
                    <div class="col-md-12 pad-20">
                        <div class="profile-head">
                                    <h5 style="text-align:center;">
                                        Bienveznue Chez <?php echo e(Setting::getSetting('titre')); ?>

                                    </h5>

                                    <h5 style="text-align:center;">
                                    تفتح القاعة من 6:00 الي 00:00 كل ايام الاسبوع
                                    </h5>
                                    <h5 style="text-align:center;">
                                    الاحد الثلاثاء الجمعة من 2 الي 4 مساء نساء
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