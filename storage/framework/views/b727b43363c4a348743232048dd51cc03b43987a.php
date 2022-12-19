<div class="modal fade" id="exampleModal<?php echo e($user->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content model1">
            <div class="modal-header">
                <h3 class="modal-title" id="lineModalLabel">Modifer Coach</h3>
            </div>

            <div class="modal-body">
                <form action="<?php echo e(route('user.update',['user'=>$user])); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Nom Prénom : </label>
                        <input type="text" class="form-control" value="<?php echo e($user->name ?? ''); ?>" name="name" id="nom"
                            placeholder="Nom Prénom ">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Téléphone : </label>
                        <input type="text" class="form-control" value="<?php echo e($user->telephone ?? ''); ?>" name="telephone" id="nom"
                            placeholder="Téléphone">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Activity : </label>
                        <input type="text" class="form-control" value="<?php echo e($user->acivity ?? ''); ?>" name="acivity" id="nom"
                            placeholder="Activity">
                    </div>




                    <button class="btn bubbly-button btn-block" type="submit"><?php echo e(trans('main.Ajouter')); ?></button>








                </form>



            </div>


        </div>

    </div>

</div>
