<?php $__env->startSection('content'); ?>
                    <div class="container-fluid">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-3 col-12">
                                    <!-- small box -->
                                    <div class="small-box bg-primary">
                                      <div class="inner">
                                        <h3><?php echo e($benefice ?? ''); ?></h3>
                                        <p>
                                        <?php echo e(trans('main.Bénéfice Total')); ?> 
 
                                        </p>
                                      </div>
                                      <div class="icon">
                                        <i class="ion ion-bag"></i>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <div class="small-box bg-info">
                                      <div class="inner">
                                        <h3><?php echo e($nombreInscriptions ?? count($inscriptions)); ?></h3>
                                        <p>
                                        <?php echo e(trans('main.Nombre Inscriptions')); ?> 
                                        </p>
                                      </div>
                                      <div class="icon">
                                        <i class="ion ion-bag"></i>
                                      </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                   <div class="card mb-4">
                        <form method="post" action="<?php echo e(route('rapport.filter')); ?>">                                                    
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-4" >
                                    <label class="control-label"><?php echo e(trans('main.debut')); ?>: </label>
                                    <input class="form-control" value="<?php echo e($date_debut ?? ''); ?>" name="date_debut" type="date" />
                                </div>

                                <div class="col-md-4" >
                                    <label class="control-label"><?php echo e(trans('main.fin')); ?>: </label>
                                    <input class="form-control" value="<?php echo e($date_fin ?? ''); ?>" name="date_fin" type="date" />
                                </div>

                                <div class="col-md-4" style="padding:16px;">
                                    <button type="submit" class="row btn bubbly-button" >
                                        <?php echo e(trans('main.Filtrer')); ?>

                                    </button>                                                                                                        
                                </div>
                            </div>
                        </form>
                    </div>
                    <table id="example1"  class="table table-striped table-bordered no-wrap text-dark">
                                        <thead>
                                            <tr class="text-white">
                                                <th><?php echo e(trans('main.Membre')); ?></th>
                                                <th><?php echo e(trans('main.debut')); ?></th>
                                                <th><?php echo e(trans('main.fin')); ?></th>
                                                <th><?php echo e(trans('main.Nombre seance reste')); ?> </th>
                                                <th><?php echo e(trans('main.nbr seances')); ?> </th>
                                                <th><?php echo e(trans('main.abonnement')); ?></th>
                                                <th><?php echo e(trans('main.etat')); ?></th>
                                                <th><?php echo e(trans('main.total')); ?></th>
                                                <th><?php echo e(trans('main.remise')); ?></th>
                                                <th><?php echo e(trans('main.nbrmois')); ?></th>
                                                <th><?php echo e(trans('main.versement')); ?></th>
                                                <th><?php echo e(trans('main.actions')); ?></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $inscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr 
                                            class="
                                            <?php if($inscription->etat == 1): ?>
                                            td-success
                                            <?php else: ?>
                                            td-error
                                            <?php endif; ?>"
                                            >
                                                <td>
                                                    <?php echo e($inscription->getMembre()['nom'] ?? ''); ?>

                                                    <?php echo e($inscription->getMembre()['prenom'] ?? ''); ?>

                                                </td>
                                                <td><?php echo e($inscription->debut ?? ''); ?></td>
                                                <td><?php echo e($inscription->fin ?? ''); ?></td>
                                                <td><?php echo e($inscription->reste ?? ''); ?></td>
                                                <td style="text-align:center;"><?php echo e($inscription->nbsseance ?? ''); ?></td>
                                                <td><?php echo e($inscription->getAbonnement()['label'] ?? ''); ?></td>
                                                <td>
                                                    <span class="badge badge-info"> 

                                                    <?php if($inscription->etat == 1): ?>
                                                        Active
                                                    <?php else: ?>
                                                        Non Active
                                                    <?php endif; ?>

                                                    </span>
                                                </td>
                                                <td><?php echo e($inscription->total ?? ''); ?>DA</td>
                                                <td><?php echo e($inscription->remise ?? ''); ?></td>

                                                <td style="text-align:center;">
                                                    <?php echo e($inscription->nbrmois ?? ''); ?>

                                                </td>                                            
                                                <td><?php echo e($inscription->versement ?? ''); ?> DA</td>

                                                <td>
                                                    <a class="btn bubbly-button text-white" href="<?php echo e(route('inscription.presence',['inscription'=>$inscription->id])); ?>">
                                                        <i class="fa fa-list"></i>
                                                        Présences
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                            
                                        </tbody>
                                    </table>

                </div> 
        </div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/chart.js')); ?>"></script>

<script>
$(document).ready(function() {
    var interval = setInterval(function() {
        var momentNow = moment();
        $('#date-part').html(momentNow.format('YYYY MMMM DD') + ' '
                            + momentNow.format('dddd')
                             .substring(0,3).toUpperCase());
        $('#time-part').html(momentNow.format('A hh:mm:ss'));
    }, 100);
aDatasets1 = [65,59,80,81,56,55,40,47];  
aDatasets2 = [20,30,40,50,60,20,25,47];
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Samedi", "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi","vendredi"],
        
        datasets: [ {
              label: 'Homme',
              fill:false,
            data: aDatasets1,

            backgroundColor: '#E91E63',
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
            ],
            borderWidth: 1
        },
        
        {
            label: 'Femme',
              fill:false,
            data: aDatasets2,
            backgroundColor: 
                '#3F51B5'
            ,
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
            ],
            borderWidth: 1
        }
        
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
        title: {
            display: true,
            text: 'Membre par semaine'
        },
        responsive: true,
        
       tooltips: {
            callbacks: {
                labelColor: function(tooltipItem, chart) {
                    return {
                        borderColor: 'rgb(255, 0, 20)',
                        backgroundColor: 'rgb(255,20, 0)'
                    }
                }
            }
        },
        legend: {
            labels: {
                // This more specific font property overrides the global property
                fontColor: 'red',
               
            }
        }
    }
});

});



</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>