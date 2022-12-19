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
              <a href="<?php echo e(route('membre.create')); ?>" class="btn bubbly-button btn-lg"><i class="fa fa-plus"></i> Ajouter</a>
          </div><!-- /.col -->
          <div class="col-sm-6">
              <h1 class="m-0 text-white">Nombre Total : <?php echo e(count($membres)); ?><h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
                        <div class="card ">
                            <div class="card-body table1">
                                <div class="table-responsive">
                                    <table id="MembersTable" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Matricule</th>
                                                <th>nom</th>
                                                <th>Prénom</th>
                                                <th>Téléphone</th>                                                
                                                <th>Action</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
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
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')); ?>"></script>


<script>
    $(document).ready(function() {

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $('#MembersTable').DataTable({
            language: {
                lengthMenu: "Display _MENU_ records per page",
                zeroRecords: "Pas de Résultat   ",
                info: "Showing page _PAGE_ of _PAGES_",
                infoEmpty: "No records available",
                infoFiltered: "(filtered from _MAX_ total records)"
            },
            processing: true,
            serverSide: true,
            ajax: "<?php echo e(route('members.getMembers')); ?>",
            columns: [
                { data:'id'},
                { data:'matricule'},
                { data:'nom'},
                { data:'prenom'},
                { data:'telephone'},
                {
                        className: 'action-buttons',
                        orderable: false,
                        mRender: function (data, type, row) {
                            var view = '<a href="/membre/membre/' + row.matricule + ' " class="btn bubbly-button text-white">Profile </a>';
                            view += ' <a href="/membre/edit/' + row.matricule + ' " class="btn bubbly-button text-white">Modifier <i class="fa fa-edit"></i></a>';
                            view += ' <a href="/membre/destroy/' + row.matricule + ' " class="btn bubbly-button text-white">Supprimer <i class="fa fa-trash"></i></a>';
                            return view
                        },
                }
                
                // {data: 'action', name: 'action', orderable: false, searchable: false},

            ]
      });
      var oldSearchValue = '';
            $('#table_search').keyup(function () {
                var newValue = $(this).val();
                if (newValue !== oldSearchValue) {
                    dataTable.search(newValue).draw();
                    oldSearchValue = newValue;
                }
            });

        // <?php $__currentLoopData = $membres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        //     <?php if($membre->matricule != 0): ?>
        //         <tr>
        //             <td><?php echo e($membre->matricule); ?></td>
        //             <td><?php echo e($membre->nom ?? ''); ?></td>
        //             <td><?php echo e($membre->prenom ?? ''); ?></td>
        //             <td><?php echo e($membre->telephone ?? ''); ?></td>                                            
        //             <td>
        //                 <span class="btn bubbly-button" >
        //                     <?php echo e($membre->getAbonnement()['label'] ?? ''); ?>

        //                 </span>
        //             </td>                                            
        //             <td>
        //                     <?php echo e($membre->getActiveInscription()['fin'] ?? ''); ?>

        //             </td>                                            

        //             <td>
        //                 <?php echo e($membre->created_at ?? ''); ?>

        //             </td>                                            
        //             <td>
        //                 <a class="btn bubbly-button text-white" href="<?php echo e(route('membre.edit',['membre'=>$membre->matricule])); ?>">Modifier <i class="fa fa-edit"></i></a>
        //                 <!-- <a href="<?php echo e(route('membre.destroy',['membre'=>$membre->matricule])); ?>" onclick="return confirm('Etes vous sure ?')"  class="btn btn-danger text-white"><i class="fa fa-window-close"></i></a> -->
        //                 <a class="btn bubbly-button text-white" onclick="return confirm('Etes vous sure ?')" href="<?php echo e(route('membre.destroy',['membre'=>$membre->matricule])); ?>"><i class="fa fa-trash"></i> Supprimer</a>
        //                 <a class="btn bubbly-button text-white" href="<?php echo e(route('membre.membre',['membre'=>$membre->matricule])); ?>">
        //                 Profile
        //                 </a>
        //             </td>
        //         </tr>

        //     <?php endif; ?>
        // <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                            

        
        // $('.state').on('change',function(e){
        //     var id = this.id
        //     console.log(id)

        //     $.ajax({
        //         type: 'GET', //THIS NEEDS TO BE GET
        //         url: '/membre/state/'+id,
        //         dataType: 'JSON',
        //         success: function (data) {
        //             console.log(data)
        //             toastr.success('état changé');
        //         },
        //         error: function(err) { 
        //             console.log(err)
        //             toastr.error(err)
        //         }
        //     });
        // })
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>