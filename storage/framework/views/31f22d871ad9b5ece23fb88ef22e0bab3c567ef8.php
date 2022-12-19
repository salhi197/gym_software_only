<?php $__env->startSection('content'); ?>

                    <div class="page-header">
						<h4 class="page-title">
                            Tables decharges
                        </h4>
					</div>
                    
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
                                    <button type="button" class="btn bubbly-button" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fa fa-plus"></i> Ajouter 
                                    </button>
								</div>

								<div class="card-body">
                                    <form method="post" action="<?php echo e(route('decharge.filter')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label><?php echo e(trans('main.debut')); ?></label>
                                                    <input type="date" name="date_debut" value="<?php echo e($date_debut ?? ''); ?>" class="form-control">
                                                </div>                                     
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label><?php echo e(trans('main.fin')); ?></label>
                                                    <input type="date" name="date_fin" value="<?php echo e($date_fin ?? ''); ?>" class="form-control">
                                                </div>                                     
                                            </div>
                                            <!-- <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Date Fin</label>
                                                    <select class='form-control stocks' name='_designation' id="_designation" >
                                                        <option value="" >Désignation</option>                    
                                                        <?php $__currentLoopData = $_designations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_designation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($_designation); ?>">
                                                            <?php echo e($_designation); ?>

                                                        </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                    </select>
                                                </div>                                     
                                            </div> -->
                                            <div class="col-sm-2">
                                                <label>&nbsp;</label>
                                                <button type="submit" id="valider" class="btn bubbly-button btn-block"><?php echo e(trans('main.filter')); ?></button>
                                            </div>
                                        </div>
                                    </form>
									<div class="table-responsive">
										<table id="example1" class="table table-bordered  text-nowrap" >
											<thead>
												<tr>
                                                    <th class="display-4 border-bottom-0"><?php echo e(trans('main.Id')); ?></th>
                                                    <th class="display-4 border-bottom-0"><?php echo e(trans('main.date_decharge')); ?></th>
                                                    <th class="display-4 border-bottom-0"><?php echo e(trans('main.designation')); ?></th>
                                                    <th class="display-4 border-bottom-0"><?php echo e(trans('main.Montant')); ?></th>
                                                    <th class="display-4 border-bottom-0"><?php echo e(trans('main.actions')); ?></th>

                                                
												</tr>
											</thead>
											<tbody>
                                            <?php $__currentLoopData = $decharges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$decharge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<tr>
                                                    <?php $index = $key+1; ?>
                                                    <td class="display-4"><?php echo e($index ?? ''); ?></td>
                                                    <td class="display-4">
                                                        <?php echo e(Carbon\Carbon::parse($decharge->date_decharge)->format('Y-m-d')); ?>

                                                    </td>
                                                    <td class="display-4"><?php echo e($decharge->designation ?? ''); ?></td>
                                                    <td class="display-4"><?php echo e($decharge->montant ?? ''); ?> DA</td>
                                                    <td class="display-4">
                                                        <a class="btn bubbly-button" href="<?php echo e(route('decharge.destroy',['decharge'=>$decharge->id])); ?>" 
                                                        onclick="return confirm('Are you sure?')"
                                                        >
                                                                <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
												</tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modals'); ?>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content model1">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter une décharge</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo e(route('decharge.create')); ?>" method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" class="form-control" 
                                                            name="facture"
                                                            value="<?php echo e($facture->id ?? ''); ?>" >

                                                        <div class="form-group">
                                                            <label class="form-label">Montant :  </label>
                                                            <input type="number" class="form-control" 
                                                            name="montant"
                                                            placeholder="Montant e.g : 230.000,00 DA" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">Date de décharge :  </label>
                                                            <input type="date" class="form-control" 
                                                            name="date_decharge"
                                                            value="<?php echo e(date('Y-m-d')); ?>"
                                                            placeholder="" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">Désignation:  </label>
                                                            <input type="text" class="form-control" 
                                                            name="designation"
                                                            placeholder="" >
                                                        </div>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                        <button type="submit" class="btn btn-primary">Sauvegarder</button>

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

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>