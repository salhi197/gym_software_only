<?php $__env->startSection('content'); ?>
<?php 
use App\Setting;
?>
<div class="container">

    <div class="row">

        <div class="col-lg-12 table1">
            <div class="card mt-2 ">
                <div class="card-header">
                    <h3 class="font-weight-light my-4"> <?php echo e(trans('main.Paramètre de application')); ?></h3>
                </div>
                <div class="card-body">
                    <form role="form" action="<?php echo e(route('setting.store')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
                                        <?php echo e(trans('main.Communication Port Com')); ?>:
                                    </label>
                                    <?php if($connexion == 1): ?>
                                    <span class="badge badge-success">
                                        <?php echo e(trans('main.Connecté')); ?>

                                    </span>
                                    <?php else: ?>
                                    <span class="badge badge-danger">
                                        <?php echo e(trans('main.Non Connecté')); ?>

                                    </span>

                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Langue :
                                    </label>
                                    <a class="badge badge-success" href="/lang/en">
                                        Anglais
                                    </a>
                                    <a class="badge badge-success" href="/lang/ar">
                                        Arabe
                                    </a>
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(trans('main.Titre Général')); ?> :</label>
                                    <input type="text" required value="<?php echo e(Setting::getSetting('titre')); ?>" name="titre"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(trans('main.Titre Général')); ?></label>
                                    <input type="text" value="<?php echo e(Setting::getSetting('telephone')); ?>" name="telephone"
                                        class="form-control">
                                </div>




                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <img src="<?php echo e(Setting::getSetting('logo')); ?>" with="20px" />

                                </div>

                                <div class="form-group">
                                    <label>
                                        Logo :
                                    </label>
                                    <input type="file" name="logo" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <a href="<?php echo e(route('clear.records')); ?>" class="btn  bubbly-button">
                                        Vider La Liste des Entrés
                                    </a>
                                </div>




                            </div>


                        </div>



                        <div clas="row">
                            <div class="col-sm-4">
                                <button type="submit" class="btn  bubbly-button">
                                    Valider
                                </button>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>