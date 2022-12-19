<?php $__env->startSection('content'); ?>

<div class="container-fluid" >
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mt-2">
                                    <div class="card-header">
                                        <h3 class="font-weight-light my-4"> </h3>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <a href="<?php echo e(route('inscription.presence',['inscription'=>$inscription->id])); ?>" style="border-radius: 25% 10%;" class="btn bubbly-button btn-sm">
                                                    <i class="fa fa-list" style="font-size:40px;" ></i>
                                                </a>
                                                <label class="text-center">Présences</label>
                                            </div>
                                            



                                            
                                            <div class="col-md-1" >
                                                <button type="button" style="border-radius: 25% 10%;" class="btn bubbly-button btn-sm" data-toggle="modal" data-target="#renouvler" >
                                                    <i class="fa fa-redo" style="font-size:40px;" aria-hidden="true"></i>
                                                </button>
                                                <label class="text-center" >Renouvler </label>
                                            </div>
                                            
                                            <div class="col-md-1" >
                                                <a style="border-radius: 25% 10%;" class="btn bubbly-button btn-sm" href="<?php echo e(route('membre.inscriptions',['membre'=>$membre->id])); ?>" >
                                                    <i class="fa fa-list" style="font-size:40px;" aria-hidden="true"></i>
                                                </a>
                                                <label class="text-center" >Liste des Inscriptions </label>
                                            </div>

                                            <?php if($inscription->reste==0 or $inscription->fin<date('Y-m-d')) {?>
                                                <div class="col-md-1 offset-md-3">
                                                    <div class="row">
                                                        <span id="loading2" class="btn btn-danger"></span>
                                                        <h1 class="m-0 text-white text-center">Expiré</h1>
                                                    </div>
                                                </div>                         

                                            <?php }else { ?>
                                                <div class="col-md-1 offset-md-3">
                                                    <div class="row">
                                                        <span id="loading" class="btn btn-success"></span>
                                                        <h1 class="m-0 text-white text-center">Active</h1>
                                                    </div>
                                                </div>                         


                                            <?php } ?>
                                        </div>
                                    </div>





                                    <div class="card-header">
                                        <h1 class="m-0 text-white"> Modifier Membre : 
                                            <?php echo e($membre->nom ?? ''); ?> <?php echo e($membre->prenom ?? ''); ?>

                                        </h1>
                                        <?php if($inscription->abonnement == 1): ?>
                                        <h1 class="m-0 text-white">
                                            Accées Libre
                                        </h1>
                                        <?php else: ?>
                                        <h1 class="m-0 text-white">
                                            Séances Restantes : <?php echo e($inscription->reste ?? ''); ?>

                                        </h1>
                                        <?php endif; ?>
                                        <?php if($inscription->total-$inscription->versement!=0): ?>
                                            <h1 class="m-0 text-white">
                                                Reste à payé : <?php echo e($inscription->total-$inscription->versement ?? ''); ?> DA
                                            </h1>
                                        <?php endif; ?>
                                        <h1 class="m-0 text-white">
                                            Date Début : <?php echo e($inscription->debut ?? ''); ?>

                                        </h1>

                                        <h1 class="m-0 text-white">
                                            Date Fin : <?php echo e($inscription->fin ?? ''); ?>

                                        </h1>
                                        
                                        <!-- <div class="row"></div> -->
                                    </div>
                                    <div class="card-body table1" >
                                        <form role="form" action="<?php echo e(route('membre.update',['membre'=>$membre->id])); ?>" method="post" enctype="multipart/form-data">
                                        <input id="mydata" type="hidden" name="mydata" value=""/>
                                        <input id="inscription_id" type="hidden" name="inscription_id" value="<?php echo e($inscription->id ?? ''); ?>"/>
                                        

                                        <?php echo csrf_field(); ?>

                                           

                                        <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">

                                                        <img id="blah" 
                                                        <?php if(strlen($membre->photo)>0): ?>
                                                            src="<?php echo e(asset($membre->photo)); ?>" 
                                                        <?php else: ?>
                                                            src="<?php echo e(asset('img/profile.png')); ?>" 
                                                        <?php endif; ?>
                                                        
                                                        width="150px" alt="" />
                                                        <div id="my_camera" ></div>

                                                        <div id="results"></div>
                                                        <div class="browse-button">
                                                            <i class="fa fa-pencil-alt"></i>
                                                            <input type='file' id="imgInp" name="image" onchange="readURL(this);" />

                                                            <input type=button value="Prendre Photo" onClick="take_snapshot()">

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:30px;">Code de Matricule</label>
                                                        <input type="text" required value="<?php echo e($membre->matricule); ?>" name="matricule" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Numéro de la carte Nationale :</label>
                                                        <input type="text" value="<?php echo e(old('identite')); ?>" name="identite" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:30px;">Nom</label>
                                                        <input type="text" required value="<?php echo e($membre->nom); ?>" name="nom" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:30px;">Prénom</label>
                                                        <input type="text" required value="<?php echo e($membre->prenom); ?>" name="prenom" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:30px;">Téléphone</label>
                                                        <input type="text" value="<?php echo e($membre->telephone); ?>" name="telephone" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:30px;">Group Sanguin</label>
                                                        <select class="customselect" name="sang">
                                                            <option <?php if($membre->sang=="A+"): ?> selected <?php endif; ?> value="A+">A+</option>
                                                            <option <?php if($membre->sang=="A-"): ?> selected <?php endif; ?> value="A-">A-</option>
                                                            <option <?php if($membre->sang=="B+"): ?> selected <?php endif; ?> value="B+">B+</option>
                                                            <option <?php if($membre->sang=="B-"): ?> selected <?php endif; ?> value="B-">B-</option>
                                                            <option <?php if($membre->sang=="O+"): ?> selected <?php endif; ?> value="O+">O+</option>
                                                            <option <?php if($membre->sang=="O-"): ?> selected <?php endif; ?> value="O-">O-</option>
                                                            <option <?php if($membre->sang=="AB+"): ?> selected <?php endif; ?> value="AB+">AB+</option>
                                                            <option <?php if($membre->sang=="AB-"): ?> selected <?php endif; ?> value="AB-">AB-</option>

                                                        </select>

                                                    </div>


                                                </div>


                                                <div class ="col-sm-1  ">
                                                    <div class="form-group">
                                                        <a style="border-radius: 25% 10%;" class="btn bubbly-button btn-sm" href="<?php echo e(route('membre.minus',['membre'=>$membre->id])); ?>">
                                                            <i class="fa fa-minus " style="padding:20px;font-size:40px;"></i>
                                                        </a>
                                                    </div>
                                                </div>


                                                <div class ="col-sm-1">
                                                    <div class="form-group">
                                                        <a style="border-radius: 25% 10%;" class="btn bubbly-button btn-sm" href="<?php echo e(route('membre.plus',['membre'=>$membre->id])); ?>">
                                                            <i class="fa fa-plus " style="padding:20px;font-size:40px;"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class ="col-sm-5">
                                                
                                                    <div class="form-group">
                                                        <label style="font-size:30px;">Nombre de mois</label>
                                                        <input type="number"  value="<?php echo e($inscription->nbrmois ?? 1); ?>" min="1" id="nbrmois" name="nbrmois" class="form-control">
                                                    </div>

                                                    


                                                    <div class="form-group">
                                                        <label style="font-size:30px;">Abonnement</label>
                                                        <select class="customselect" id="abonnement" name="abonnement">
                                                            <option >Séléctionner un Abonnement</option>
                                                                <?php $__currentLoopData = $abonnements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abonnement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option 
                                                                    <?php if($inscription->abonnement==$abonnement->id): ?> selected <?php endif; ?>
                                                                    value="<?php echo e($abonnement); ?>"><?php echo e($abonnement->label); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label style="font-size:30px;">Date début</label>
                                                        <input type="date" id="debut"  value="<?php echo e($inscription->debut); ?>" name="debut" class="form-control">
                                                    </div>

                                                    

                                                    <!-- <div class="form-group">
                                                        <label style="font-size:30px;">Remarque</label>
                                                        <input id="remarque" type="text" value="<?php echo e($membre->remarque); ?>" name="remarque" class="form-control">
                                                    </div> -->



                                                    <div class="form-group">
                                                        <label style="font-size:30px;">Tarification:</label>
                                                        <input type="number"  onkeydown="return false;" name="tarif"  value="0" id="tarif" class="form-control">
                                                    </div>



                                                    <!-- <div class="form-group">
                                                        <label style="font-size:30px;">Total</label>
                                                        <input type="number" id="total" value="<?php echo e($membre->total); ?>" name="total" class="form-control" readonly>
                                                    </div> -->

                                                    <div class="form-group">
                                                        <label style="font-size:30px;">Remise</label>
                                                        <input type="number" value="<?php echo e($inscription->remise ?? 0); ?>" id="remise" name="remise" class="form-control">
                                                    </div>


                                                    <div class="form-group">
                                                        <label style="font-size:30px;">Total Final : </label>
                                                        <input type="number" value="<?php echo e($inscription->total ?? 0); ?>" onkeydown="return false;" id="total" name="total" class="form-control">
                                                    </div>


                                                    <div class="form-group">
                                                        <label style="font-size:30px;">Versement</label>
                                                        <input type="number"  value="<?php echo e($inscription->versement ?? 0); ?>" id="versement" name="versement" class="form-control">
                                                    </div>

                                                    

                                                    <div class="form-group">
                                                        <label style="font-size:30px;">Reste</label>
                                                        <input type="number"  value="<?php echo e($inscription->total-$inscription->versement ?? 0); ?>" onkeydown="return false;" id="reste" name="reste" class="form-control">
                                                    </div>


                                                </div>


                                            </div>


                                                    





                                                

                                          

                                            <div class="row">
                                                <div class="col-md-2" style="padding:30px;">
                                                    <button style="padding:30px;font-size:30px;border-radius: 25% 10%;" type="submit" id="valider" class="btn bubbly-button btn-sm">Valider</button>
                                                </div>
                                                <div class="col-md-2" style="padding:30px;">
                                                    <button style="padding:30px;font-size:30px;border-radius: 25% 10%;" 
                                                    onclick="window.history.go(-1); return false;"

                                                     class="btn bubbly-button btn-sm">Annuler</button>
                                                </div>

                                            </div>
                                        </form>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                        <?php echo $__env->make('includes.modals.renouvler',['membre'=>$membre], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/webcam.min.js')); ?>"></script>

<script>


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                console.log(e.target.result)
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }


    function take_snapshot() {
            // take snapshot and get image data
            Webcam.snap( function(data_uri) {
                var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
                 
                document.getElementById('mydata').value = raw_image_data;
                // document.getElementById('myform').submit();
                document.getElementById('blah').src = data_uri

            } );
        }
$(document).ready(function() {
//        window.location.replace("http://localhost:8000/membre");
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach( '#my_camera'  );
    $('#today').on('click',function(){
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;
        var today = year+ "-" +month+ "-" +day;//+"-"+// + "-" +  +"T00:00";       
        $("#debut").attr("value", today);

    })
    $('#versement').on('keyup',function(event){
        var total =  $('#total').val()
        var versement =  $('#versement').val()
        var reste = total - versement
        $('#reste').val(reste)

    })


    $('#abonnement').on('change',function(event){
        var value = JSON.parse(this.value);
        var remise = $('#remise').val();
        console.log(ttc)
        var assurance = $('#tarif').val()
        $('#tarif').val(value.tarif)
        $('#total').val($('#nbrmois').val()*$('#tarif').val())
        $('#versement').val($('#nbrmois').val()*$('#tarif').val())
        $('#remise').val(0)


    
        var total =  $('#total').val()
        console.log(ttc)
        var ttc = total - remise 
        $('#ttc').val(ttc)


        var total =  $('#total').val()
        var versement =  $('#versement').val()
        var reste = total - versement
        $('#reste').val(reste)
        $('#versement').attr('max',total)



    })
    $('#remise').on('keyup',function(){
        var nbrmois = $('#nbrmois').val();
        var remise = this.value;
        var total =  $('#tarif').val()*nbrmois
        var ttc = total - remise 
        $('#total').val(ttc)
        $('#versement').val(ttc)
        $('#versement').attr('max',ttc)
        $('#reste').val(0)


    })

    $('#nbrmois').on('change',function(event){
    
        var value = this.value;
        var debut = new Date($('#debut').val());
        var fin  = debut.setMonth(debut.getMonth()+value); 
        var remise = $('#remise').val();
        $('#total').val(value*$('#tarif').val())
        $('#versement').val(value*$('#tarif').val())
        $('#remise').val(0)
        $('#reste').val(0)

        var total =  $('#total').val()
        console.log(ttc)
        var ttc = total - remise 
        $('#ttc').val(ttc)

    })


    // secnd part 2 

    $('#versement2').on('keyup',function(event){
        var total =  $('#total2').val()
        var versement =  $('#versement2').val()
        var reste = total - versement
        $('#reste2').val(reste)

    })


    $('#abonnement2').on('change',function(event){
        var value = JSON.parse(this.value);
        var remise = $('#remise2').val();
        console.log(ttc)
        var assurance = $('#tarif2').val()
        $('#tarif2').val(value.tarif)
        $('#total2').val($('#nbrmois2').val()*$('#tarif2').val())
        $('#versement2').val($('#nbrmois2').val()*$('#tarif2').val())
        $('#remise2').val(0)


    
        var total =  $('#total2').val()
        console.log(ttc)
        var ttc = total - remise 
        $('#ttc2').val(ttc)


        var total =  $('#total2').val()
        var versement =  $('#versement2').val()
        var reste = total - versement
        $('#reste2').val(reste)
        $('#versement2').attr('max',total)



    })
    $('#remise2').on('keyup',function(){
        var nbrmois = $('#nbrmois2').val();
        var remise = this.value;
        var total =  $('#tarif2').val()*nbrmois
        var ttc = total - remise 
        $('#total2').val(ttc)
        $('#versement2').val(ttc)
        $('#versement2').attr('max',ttc)
        $('#reste2').val(0)


    })

    $('#nbrmois2').on('change',function(event){
    
        var value = this.value;
        var debut = new Date($('#debut2').val());
        var fin  = debut.setMonth(debut.getMonth()+value); 
        var remise = $('#remise2').val();
        $('#total2').val(value*$('#tarif2').val())
        $('#versement2').val(value*$('#tarif2').val())
        $('#remise2').val(0)
        $('#reste2').val(0)

        var total =  $('#total2').val()
        console.log(ttc)
        var ttc = total - remise 
        $('#ttc2').val(ttc)

    })


});

</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>