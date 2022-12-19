<?php $__env->startSection('content'); ?>
        <div class="container emp-profile  table2 membreProfile "
            style="margin-top:-4%;"
        >
            <form method="post">
                <div class="row " >
                    <div class="col-md-4" style="text-align:center;">
                        <div class="profile-img">
                            <?php if(strlen($membre->photo)>0): ?>
                            <img src="<?php echo e(asset($membre->photo)); ?>" width="400px" alt=""/>
                            <?php else: ?>
                            <img src="<?php echo e(asset('profile.png')); ?>" width="400px" alt=""/>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6 pad-20">
                        <div class="profile-head">
                                    <div class='corner2'></div>
                                    <div class='corner2'></div>
                                    <div class='corner2'></div>
                                    <div class='corner2'></div>
                                    <h5 style="text-align:center;">
                                        <?php echo e($membre->nom); ?> 
                                    </h5>
                                    <h5 style="text-align:center;">

                                        <?php echo e($membre->prenom); ?> 
                                    </h5>
                                    <p style="text-align:center;">


                                            <?php if($inscription->reste==0 or $inscription->fin<date('Y-m-d')) {?>
                                                <span id="loading2" class="btn btn-danger">
                                                    Expiré
                                                </span>

                                            <?php }else { ?>
                                                <span id="loading" class="btn btn-success">
                                                    Active
                                                </span>


                                            <?php } ?>


                                    </p>

                                    <div class="">
                                    <!-- <p class="proile-rating"> Poids : <span>70kg</span></p>
                                    <p class="proile-rating">Taille  : <span>188cm</span></p> -->
                                    </div>
<!--                             <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                                </li>
                            </ul> -->
                        </div>
                    </div>
                    <!-- <div class="col-md-2 editbutton">
                        <a href="<?php echo e(route('membre.edit',['membre'=>$membre->matricule])); ?>"  class="bubbly-button">
                            Modifier 
                        </a>
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="profile-work">
                        </div>
                    </div>
                    <div class="col-md-10 profileTab pad-50 marg-50">
                                <div class='corner'></div>
                                <div class='corner'></div>
                                <div class='corner'></div>
                                <div class='corner'></div>
                        <div class="tab-content profile-tab " id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <?php if($inscription->abonnement != 1): ?>                                               
                                            <div class="col-md-6">
                                                <label>Il Vous Reste: </label>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="font-size:40px;
                                                font-family:'Orbitron', sans-serif !important;" class="text-white mb-1 font-weight-medium text-center"> <?php echo e($inscription->reste ?? ''); ?> <label>Séances</label></p>
                                            </div>
                                            <?php else: ?>
                                            <div class="col-md-12">
                                                <p style="font-size:40px;
                                                font-family:'Orbitron', sans-serif !important;" class="text-white mb-1 font-weight-medium text-center"> Accées Libre </p>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Date Début : </label>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 style="font-size:40px;
                                                font-family:'Orbitron', sans-serif !important;" class="text-white mb-1 font-weight-medium text-center"><?php echo e($inscription->debut); ?></h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Date Fin : </label>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 style="font-size:40px;
                                                font-family:'Orbitron', sans-serif !important;" class="text-white mb-1 font-weight-medium text-center"><?php echo e($inscription->fin); ?></h5>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Restr à payer : </label>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 style="font-size:40px;
                                                font-family:'Orbitron', sans-serif !important;" class="text-white mb-1 font-weight-medium text-center">
                                                    <?php echo e($inscription->total-$inscription->versement); ?> DA                                                
                                                </h5>
                                            </div>
                                        </div>
                                        
                                        

                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
    setTimeout(() => {
    },10000);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.profile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>