<?php $__env->startSection('content'); ?>

<div class="container-fluid">

    <h1 class="mt-4"> Coachs :</h1>

    <div class="card mb-4">

        <div class="card-header">
                <button data-toggle="modal" data-target="#exampleModal" class="btn bubbly-button"><i class="fa fa-plus"></i>Ajouter
                    
                </button>
        </div>

        <div class="card-body table1">
            <div class="table-responsive">
                <table class="table">
                    <thead class="color-brick">
                        <tr>
                            <th>ID user</th>
                            <th>email</th>
                            <th>Téléphone</th>
                            <th>actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>

                            <td><?php echo e($user->id ?? ''); ?></td>

                            <td>
                                <?php echo e($user->name ?? ''); ?>

                            </td>


                            <td><?php echo e($user->telephone ?? ''); ?></td>


                            <td>

                                <div class="table-action">

                                    <a href="<?php echo e(route('user.destroy',['id_user'=>$user->id])); ?>"
                                        onclick="return confirm('etes vous sure  ?')" class="text-white btn btn-danger">

                                        <i class="fas fa-trash"></i>

                                    </a>

                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal<?php echo e($user->id); ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                </div>

                            </td>



                        </tr>
                        <?php echo $__env->make('includes.modals.editcoach',['user'=>$user], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>



                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content model1">
            <div class="modal-header">
                <h3 class="modal-title" id="lineModalLabel">Ajouter Coach</h3>
            </div>

            <div class="modal-body">
                <form action="<?php echo e(route('user.store.coach')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>


                    <div class="form-group">
                        <label for="exampleInputEmail1"> Nom Prénom : </label>
                        <input type="text" class="form-control" value="<?php echo e(old('name')); ?>" name="name" id="nom"
                            placeholder="Nom Prénom ">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Téléphone : </label>
                        <input type="text" class="form-control" value="<?php echo e(old('telephone')); ?>" name="telephone" id="nom"
                            placeholder="Téléphone">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Activity : </label>
                        <input type="text" class="form-control" value="<?php echo e(old('acivity')); ?>" name="acivity" id="nom"
                            placeholder="Téléphone">
                    </div>

                    <button class="btn bubbly-button btn-block" type="submit"><?php echo e(trans('main.Ajouter')); ?></button>







                    <!-- <div class="form-group">

            <label for="exampleInputPassword1">date naissance</label>

            <input type="date" name="birth" class="form-control" id="birth" placeholder="">

        </div> -->

                </form>



            </div>


        </div>

    </div>

</div>










<?php $__env->stopSection(); ?>






<?php $__env->startSection('scripts'); ?>

<script>
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "order": [
            [0, "desc"]
        ],
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

    function watchWilayaChanges() {

        $('#wilaya_select').on('change', function (e) {

            e.preventDefault();

            var $communes = $('#commune_select');

            var $communesLoader = $('#commune_select_loading');

            var $iconLoader = $communes.parents('.input-group').find('.loader-spinner');

            var $iconDefault = $communes.parents('.input-group').find('.material-icons');

            $communes.hide().prop('disabled', 'disabled').find('option').not(':first').remove();

            $communesLoader.show();

            $iconDefault.hide();

            $iconLoader.show();

            $.ajax({

                    dataType: "json",

                    method: "GET",

                    url: "/api/static/communes/ " + $(this).val()

                })

                .done(function (response) {

                    $.each(response, function (key, commune) {

                        $communes.append($('<option>', {
                            value: commune.id
                        }).text(commune.name));

                    });

                    $communes.prop('disabled', '').show();

                    $communesLoader.hide();

                    $iconLoader.hide();

                    $iconDefault.show();

                });

        });

    }



    $(document).ready(function () {

        watchWilayaChanges();

    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>