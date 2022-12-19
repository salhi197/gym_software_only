<?php $__env->startSection('content'); ?>

        <div class="container-fluid">
            <div class="card-header">
                <div class="row card1-group">
                    <div class="col-md-1 text-center card1 blur">
                        <a style="padding:15px;" class="btn text-white"  href="<?php echo e(route('membre.create')); ?>" class="text-white"><i class="fa fa-user-plus" style="font-size:40px;"></i></a>
                        <label class="text-center text-white">Nouveau</label>
                    </div> 
                    <div class="col-md-1 text-center card1 blur">
                        <a style="padding:16px;" class="btn text-white" 
                        type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                        ><i class="fas fa-external-link-alt" style="font-size:40px;"></i></a>
                        <label class="text-center text-white">Séance Libre +</label>
                    </div>   

                    <div class="col-md-1 text-center card1 blur">
                        <a style="padding:15px;" class="btn text-white" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exemple"><i class="fa fa-user" style="font-size:40px;"></i></a>
                        <label class="text-center text-white">Assurance</label>
                    </div>    
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content model1">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">insérer une séance Libre</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form id="abonnementFform" action="<?php echo e(route('presence.create')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Genre: </label>
                                        <select class="customselect" name="genre" id="genre">
                                            <option value="homme">Homme</option>
                                            <option value="femme">Femme</option>

                                        </select>
                                    </div> 


                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Tarif: </label>
                                        <input type="text" name="prix" id="prix" value="150"  class="form-control"/>
                                    </div> 


                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Nom Prénom : </label>
                                        <input type="text" name="nom_prenom"  class="form-control"/>
                                    </div> 

                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Téléphone : </label>
                                        <input type="text" name="telephone"  class="form-control"/>
                                    </div> 
                                    <button class="btn bubbly-button btn-block" type="submit" id="ajax_abonnement">Confirmer</button>
                            </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
            <!-- Time -->
            <div class="align-items-center timePM">
                 <div>
                       <h1 style="font-size:90px;" class="text-white mb-1 font-weight-medium text-center" id="time-part"></h1><br>
                </div>                                    
                        <!-- <div class="ml-auto mt-md-3 mt-lg-0">
                            <h2 class="text-dark mb-1 font-weight-medium text-center" id="date-part"></h2>                                        
                        </div> -->
            </div>
                    <div class="card-group">
                        <div class="card-body text-white" >
                            <div class="row card1-group">
                                <div class="card1">
                                      <div class="inner">
                                      <img src="<?php echo e(asset('img/icons/member.png')); ?>"/>
                                        <h3><?php echo e(count($inscriptions) ?? ''); ?></h3>
                                        <p>
                                            Inscrit aujourd'hui
                                        </p>
                                      </div>
                                </div>
                                <div class="card1">
                                      <div class="inner">
                                      <img src="<?php echo e(asset('img/icons/member.png')); ?>"/>
                                        <h3><?php echo e(count($libres) ?? ''); ?></h3>
                                        <p>
                                            Séances Libre
                                        </p>
                                      </div>
                                </div>
                                <div class="card1">
                                      <div class="inner">
                                          <img src="<?php echo e(asset('img/icons/staff-member.png')); ?>"/>

                                        <h3><?php echo e($count_presences ?? ''); ?></h3>
                                        <p>
                                            Accés Aujourd'hui
                                        </p>
                                      </div>
                                      <div class="icon">
                                        <i class="ion ion-bag"></i>
                                      </div>
                                </div>    
                                <div class="card1">
                                      <div class="inner">
                                      <img src="<?php echo e(asset('img/icons/staff-member.png')); ?>"/>
                                        <h3><?php echo e($ouvertures ?? ''); ?></h3>
                                        <p>
                                            Ouvertures Manuelle
                                        </p>
                                      </div>
                                      <div class="icon">
                                        <i class="ion ion-bag"></i>
                                      </div>
                                </div> 
                            </div>
                            <!-- <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <canvas id="myChart" width="600" height="250"></canvas>                                
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                                </div>
                            </div> -->
                        </div>
               </div> 
        </div>

        


                    <div class="modal fade" id="exemple" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content model1">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">insérer une Assurance</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form id="abonnementFform" action="<?php echo e(route('assurance.create')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>

                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Tarif: </label>
                                        <input type="text" name="prix" value="1000"  class="form-control"/>
                                    </div> 


                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Nom Prénom : </label>
                                        <input type="text" name="nom_prenom"  class="form-control"/>
                                    </div> 

                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Téléphone : </label>
                                        <input type="text" name="telephone"  class="form-control"/>
                                    </div> 
                                    <button class="btn bubbly-button btn-block" type="submit" id="ajax_abonnement">Confirmer</button>
                            </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div> 


<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/moment.min.js')); ?>"></script>

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

          $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "order": [[ 0, "desc" ]],
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          $('#example2').DataTable({
            "paging": true,
            "pageLength": 5,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
          $('.dataTables_filter').addClass('pull-left');


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

        $('#genre').on('change',function () {
            var genre = this.value 
            if(genre=="femme"){
                $('#prix').val(200)
            }else{
                $('#prix').val(150)
            }
        })
});

</script>
<script>
$(document).ready(function() {
    var interval = setInterval(function() {
        var momentNow = moment();
        $('#date-part').html(momentNow.format('YYYY MMMM DD') + ' '
                            + momentNow.format('dddd')
                             .substring(0,3).toUpperCase());
        $('#time-part').html(momentNow.format('A hh:mm:ss'));
    }, 100);

});



</script>
<script type="text/javascript">
    var animateButton = function(e) {

  e.preventDefault;
  //reset animation
  e.target.classList.remove('animate');
  
  e.target.classList.add('animate');
  setTimeout(function(){
    e.target.classList.remove('animate');
  },700);
};

var bubblyButtons = document.getElementsByClassName("bubbly-button");

for (var i = 0; i < bubblyButtons.length; i++) {
  bubblyButtons[i].addEventListener('click', animateButton, false);
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>