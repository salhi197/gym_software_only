<?php $__env->startSection('content'); ?>

<div class="container-fluid">

    <h1 class="mt-4"> Utilisateurs:</h1>

    <div class="card mb-4">

        <div class="card-header">
            <button data-toggle="modal" data-target="#exampleModal" class="btn bubbly-button"><i class="fa fa-plus"></i>Ajouter
                user</button>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table " id="example1" width="100%" >
                    <thead>
                        <tr>
                            <th>ID user</th>
                            <th>email</th>
                            <th>Passwor </th>
                            <th>Grade</th>
                            <th>actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>

                            <td><?php echo e($user->id ?? ''); ?></td>

                            <td>
                                <?php echo e($user->email ?? ''); ?>

                            </td>


                            <td><?php echo e($user->password_text ?? ''); ?></td>
                            <td>
                                <?php if($user->isadmin == 1): ?>
                                    Admin
                                <?php else: ?>
                                    Caissier
                                <?php endif; ?>    
                            </td>



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
                        <?php echo $__env->make('includes.modals.edituser',['user'=>$user], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>



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
                <h3 class="modal-title" id="lineModalLabel">Ajouter user</h3>
            </div>

            <div class="modal-body">
                <form action="<?php echo e(route('user.create')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Grade : </label>
                        <select name="grade" class="customselect">
                            <option value="1">
                                Admin
                            </option>
                            <option value="2">
                                Caisse 
                            </option>
                            
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Login : </label>
                        <input type="text" class="form-control" value="<?php echo e(old('name')); ?>" name="name" id="nom"
                            placeholder="Login ">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Password : </label>
                        <input type="text" class="form-control" value="<?php echo e(old('password')); ?>" name="password" id="password"
                            placeholder="Mot de passe">
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
<script src="<?php echo e(asset('adminlte/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/jszip/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/pdfmake/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/pdfmake/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')); ?>"></script>

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