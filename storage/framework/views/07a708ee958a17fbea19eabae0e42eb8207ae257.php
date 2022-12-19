<?php $__env->startSection('content'); ?>

<div class="container-fluid">

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="card mt-2">
                                    <div class="card-header">
                                        <h1 class="m-0 text-white">
                                            Nouveau Membre :
                                        </h1>
                                        <div class="col-sm-4"></div>
                                    </div>
                                    <div class="card-body table1">
                                        <form role="form" action="<?php echo e(route('membre.store')); ?>" method="post" enctype="multipart/form-data">
                                        <input id="mydata" type="hidden" name="mydata" value=""/>

                                        <?php echo csrf_field(); ?>

                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <h1 class="m-0 text-white">Informations Personnels :</h1>

                                                    <div class="form-group text-center">
                                                        <img id="blah" src=""  width="150px" alt="" />
                                                        <br>   <br>
                                                        <div id="my_camera" ></div>

                                                        <div id="results"></div>
                                                        <div class="browse-button">
                                                            <i class="fa fa-pencil-alt"></i>
                                                            <input type='file' id="imgInp" name="photoMembre" onchange="readURL(this);" />

                                                            <input type=button value="Prendre Photo" onClick="take_snapshot()">

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Code de Matricule</label>
                                                        <input type="text" required value="<?php echo e(old('matricule')); ?>" name="matricule" class="form-control">

                                                    </div>

                                                    
                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Numéro de la carte Nationale :</label>
                                                        <input type="text" value="<?php echo e(old('identite')); ?>" name="identite" class="form-control">

                                                    </div>

                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Nom</label>
                                                        <input type="text" required value="<?php echo e(old('nom')); ?>" name="nom" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Prénom</label>
                                                        <input type="text" required value="<?php echo e(old('prenom')); ?>" name="prenom" class="form-control">
                                                    </div>

                                                    <!-- <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Adresse</label>
                                                        <input type="text" value="<?php echo e(old('adresse')); ?>" name="adresse" class="form-control">
                                                    </div> -->

                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Téléphone</label>
                                                        <input type="text" value="<?php echo e(old('telephone')); ?>" name="telephone" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Groupe Sanguin</label><br>
                                                        <select class="customselect" class="" name="sang">
                                                            <option value="A+">A+</option>
                                                            <option value="A-">A-</option>
                                                            <option value="B+">B+</option>
                                                            <option value="B-">B-</option>
                                                            <option value="O+">O+</option>
                                                            <option value="O-">O-</option>
                                                            <option value="AB+">AB+</option>
                                                            <option value="AB-">AB-</option>

                                                        </select>

                                                    </div>

                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Grade</label><br>
                                                        <input type="text" value="<?php echo e(old('grade')); ?>" name="grade" class="form-control">


                                                    </div>


                                                </div>

                                                <div class ="col-sm-5 offset-md-2">
                                                    <h1 class="m-0 text-white">Informations D'inscriptions :</h1>
                                                    <!-- <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Genre :</label>
                                                        <select class="" name="sexe">
                                                            <option value="femme">Femme</option>						 
                                                            <option value="homme">Homme</option>	
                                                            <option value="mixte">mixte</option>						                                                             
                                                        </select>
                                                    </div> -->
                                                
                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Nombre de mois</label>
                                                        <input type="number"  value="<?php echo e(old('nbrmois') ?? 1); ?>" min="1"  id="nbrmois" name="nbrmois" class="form-control">
                                                    </div>

                                                    


                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Abonnement:</label><br>
                                                        <select class="customselect" id="abonnement" name="abonnement">
                                                            <option value="" >Séléctionner un Abonnement</option>
                                                                <?php $__currentLoopData = $abonnements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abonnement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($abonnement); ?>"><?php echo e($abonnement->label); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Date début</label>
                                                        <input type="date" id="debut"  value="<?php echo e(Date('Y-m-d')); ?>" name="debut" class="form-control">
                                                    </div>

                                                    <!-- <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Date Fin</label>
                                                        <input type="date" id="fin"  value="" name="fin" class="form-control">
                                                    </div> -->
                                                    

                                                    <!-- <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Remarque</label>
                                                        <input id="remarque" type="text" value="<?php echo e(old('remarque')); ?>" name="remarque" class="form-control">
                                                    </div> -->



                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Tarification:</label>
                                                        <input type="number"  onkeydown="return false;" name="tarif"  value="0" id="tarif" class="form-control">
                                                    </div>

                                                    <!-- <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Assurance:</label>


                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="assurance" value="1" id="flexRadioDefault1" checked>
                                                                <label class="form-check-label" style="font-size:30px;" for="flexRadioDefault1">
                                                                    A Payé
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="assurance" value="0" id="flexRadioDefault0" >
                                                            <label class="form-check-label" style="font-size:30px;" for="flexRadioDefault0">
                                                                Non Payé
                                                            </label>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    


                                                    <!-- <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Total</label>
                                                        <input type="number" id="total" value="<?php echo e(old('total')); ?>" name="total" class="form-control" readonly>
                                                    </div> -->

                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Remise</label>
                                                        <input type="number" value="<?php echo e(old('remise') ?? 0); ?>" id="remise" name="remise" class="form-control">
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Total Final : </label>
                                                        <input type="number" value="<?php echo e(old('ttc') ?? 0); ?>" onkeydown="return false;" id="total" name="total" class="form-control">
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Versement</label>
                                                        <input type="number"  value="<?php echo e(old('versement') ?? 0); ?>" id="versement" name="versement" class="form-control">
                                                    </div>

                                                    

                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Reste</label>
                                                        <input type="number"  value="<?php echo e(old('reste') ?? 0); ?>" onkeydown="return false;" id="reste" name="reste" class="form-control">
                                                    </div>


                                                </div>


                                            </div>

                                            <div class="row">
                                                <div class="col-md-2 offset-md-4" style="padding:30px;">
                                                    <button style="padding:30px;font-size:30px;border-radius: 25% 10%;" type="submit" id="valider" class="btn bubbly-button btn-sm">Valider</button>
                                                </div>
                                                <div class="col-md-2" style="padding:30px;">
                                                    <a style="padding:30px;font-size:30px;border-radius: 25% 10%;" 
                                                    onclick="window.history.go(-1); return false;"
                                                     class="btn bubbly-button btn-sm">Annuler</a>
                                                </div>
                                            </div>
                                    </div>
                                </div>



                                <!-- <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Type d'abonnement  </h3></div>
                                    <div class="card-body">
                                            <div class="row">

                                            </div>

                                        </form>
                                    </div>
                                </div> -->



                            </div>

                        </div>

                    </div>
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

$(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });



    $('.basic-single').select2();
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
        $('#versement').attr('max',value*$('#tarif').val())


        var total =  $('#total').val()
        console.log(ttc)
        var ttc = total - remise 
        $('#ttc').val(ttc)

    })

});

</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>