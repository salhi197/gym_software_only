<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-4">
                <a href="<?php echo e(route('membre.create')); ?>" class="btn bubbly-button btn-lg"><i class="fa fa-plus"></i>
                    <?php echo e(trans('main.ajouter')); ?></a>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <h1 class="m-0 text-white"><?php echo e(trans('main.Nombre Total')); ?> : <?php echo e($total); ?><h1>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="card ">
    <div class="card-body table1">
        <div class="row text-right">
            <div class="col-md-3">
            </div>
        </div>
        <br>


        <div class="row">
                                    <div class="col-md-12">
                                        <form method="post" action="<?php echo e(route('membre.filter')); ?>">                                                    
                                                <?php echo csrf_field(); ?>
                                                <div class="row">
                                                    <div class="col-md-3" >
                                                        <label class="m-0 text-white" style="font-size:30px;"><?php echo e(trans('main.Abonnement')); ?>:</label><br>
                                                        <select class="customselect" id="abonnement" name="abonnement">
                                                            <option value="" ><?php echo e(trans('main.Séléctionner un Abonnement')); ?>:</option>
                                                                <?php $__currentLoopData = $abonnements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abonnement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option 
                                                                    <?php if($_abonnement==$abonnement->id): ?> selected <?php endif; ?>
                                                                    value="<?php echo e($abonnement->id); ?>"><?php echo e($abonnement->label); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-3" >
                                                        <label class="m-0 text-white" style="font-size:30px;">Coach:</label><br>
                                                        <select class="customselect" id="coach" name="coach">
                                                            <option value="" >Séléctionner un Coach:</option>
                                                                <?php $__currentLoopData = $coachs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coach): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option
                                                                     <?php if($_coach==$coach->id): ?> selected <?php endif; ?>
                                                                     value="<?php echo e($coach->id); ?>"><?php echo e($coach->name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>

                                                    </div>

                                                
                                                    <div class="col-md-4" style="padding: 20px;" >
                                                        <button type="submit" class="row btn bubbly-button" >
                                                            Filtrer
                                                        </button>                                                                                                        
                                                    </div>


                                                </form>
                                    </div>
        </div>


        <div class="table-responsive">
            <table id="example1" class="table table-striped table-bordered no-wrap">
                <thead>
                    <tr>
                        <th><?php echo e(trans('main.Matricule')); ?></th>
                        <th><?php echo e(trans('main.nom')); ?> <?php echo e(trans('main.Prénom')); ?></th>
                        <th>téléphone </th>
                        <th>Abonnement</th>
                        <th><?php echo e(trans('main.Action')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $membres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($membre->getAbonnement()['id'] == $_abonnement): ?>
                        <tr>
                            <th><?php echo e($membre->matricule); ?></th>
                            <th><?php echo e($membre->nom ?? ''); ?> <?php echo e($membre->prenom ?? ''); ?></th>
                            <th><?php echo e($membre->telephone ?? ''); ?></th>
                            <th>
                                <span class="badge badge-success">
                                    <?php echo e($membre->getAbonnement()['label'] ?? ''); ?>

                                </span>
                            </th>

                            <th>
                                <a class="btn bubbly-button text-white"
                                    href="<?php echo e(route('membre.edit',['membre'=>$membre->matricule])); ?>">Modifier <i class="fa fa-edit"></i></a>
                                <!-- <a href="<?php echo e(route('membre.destroy',['membre'=>$membre->matricule])); ?>" onclick="return confirm('Etes vous sure ?')"  class="btn btn-danger text-white"><i class="fa fa-window-close"></i></a> -->
                                <a class="btn bubbly-button text-white" onclick="return confirm('Etes vous sure ?')"
                                    href="<?php echo e(route('membre.destroy',['membre'=>$membre->matricule])); ?>"><i
                                        class="fa fa-trash"></i> Supprimer</a>
                                <a class="btn bubbly-button text-white"
                                    href="<?php echo e(route('membre.membre',['membre'=>$membre->matricule])); ?>">
                                    Profile
                                </a>
                            </th>
                        </tr>

                    <?php endif; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>
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
$(document).ready(function() {

        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "order": [[ 0, "desc" ]],
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



        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        
        $('.state').on('change',function(e){
            var id = this.id
            console.log(id)

            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: '/membre/state/'+id,
                dataType: 'JSON',
                success: function (data) {
                    console.log(data)
                    toastr.success('état changé');
                },
                error: function(err) { 
                    console.log(err)
                    toastr.error(err)
                }
            });
        })
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>