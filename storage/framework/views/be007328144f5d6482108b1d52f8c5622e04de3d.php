<div class="modal fade" id="exampleModal<?php echo e($abonnement->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content model1">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier abonnement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="abonnementFform" action="<?php echo e(route('abonnement.update',['abonnement'=>$abonnement->id])); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

                <?php if($abonnement->id != 1): ?>

                <div class="form-group">
                    <label class="small mb-1" for="inputFirstName">Titre Abonnement: </label>
                    <input type="text" value="<?php echo e($abonnement->label); ?>" name="label"  class="form-control"/>
                </div>  
                <div class="form-group">
                    <label class="small mb-1" for="inputFirstName">Nombre de fois par semaine: </label>
                    <input type="number" value="<?php echo e($abonnement->nbrsemaine); ?>" name="nbrsemaine"  class="form-control"/>
                </div>  
                <?php endif; ?>
                <div class="form-group">
                    <label class="small mb-1" for="inputFirstName">Tarif: </label>
                    <input type="number" value="<?php echo e($abonnement->tarif); ?>" name="tarif"  class="form-control"/>
                </div>  
                <button class="btn bubbly-button btn-block" type="submit" id="ajax_abonnement">Modifier l'abonnement</button>
            </form>
      </div>
    </div>
  </div>
</div>
