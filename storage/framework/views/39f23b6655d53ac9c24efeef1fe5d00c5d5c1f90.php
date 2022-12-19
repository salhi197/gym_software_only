 
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->

<html lang="en">
<head>
  <meta charset="utf-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestion Salle du sport</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="<?php echo e(asset('fonts/css3.css')); ?>" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/fontawesome-free/css/all.min.css')); ?>">
  <link href="<?php echo e(asset('adminlte/plugins/toastr/toastr.css')); ?>" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo e(asset('adminlte/dist/css/adminlte.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/ares.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/select2.min.css')); ?>">
  <style>
    table.dataTable td {
      font-size: 30px;
    }



#global-loader {
    position: fixed;
    z-index: 50000;
    background: #fff;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    height: 100%;
    width: 100%;
    margin: 0 auto;
    overflow: hidden;
}

.loader-img {
    position: absolute;
    left: 0;
    right: 0;
    text-align: center;
    top: 45%;
    margin: 0 auto;
}

  </style>
  <?php echo $__env->yieldContent('styles'); ?>
</head>

<body class="hold-transition layout-navbar-fixed">


    <div id="global-loader">
			<img src="<?php echo e(asset('img/gymA.svg')); ?>" class="loader-img" width="150px" alt="Loader">
		</div>

<div class="wrapper" id="all-body">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light">
    <div class="container">
      <a href="/home" class="navbar-brand">
          <img src="<?php echo e(asset('img/gymA.svg')); ?>" class="logo logo-display" alt="">
      </a>
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="<?php echo e(route('membre.index')); ?>" class="nav-link" style="font-size:20px">
            <i class="fa fa-user"></i>
            Membres
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo e(route('abonnement.index')); ?>" class="nav-link" style="font-size:20px">
            <i class="fa fa-calendar"></i>
              Abonnement
              </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo e(route('inscription.index')); ?>" class="nav-link" style="font-size:20px">
            <i class="fa fa-calendar"></i>
            Inscriptions
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="<?php echo e(route('crenau.index')); ?>" class="nav-link" style="font-size:20px">
            <i class="fa fa-bicycle"></i>
            Planing
            </a>
          </li> -->



          <li class="nav-item dropdown">
            <a style="font-size:20px" id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Rapport</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <li><a href="<?php echo e(route('stats')); ?>" class="dropdown-item">Statistique </a></li>
            <li><a href="<?php echo e(route('rapport')); ?>" class="dropdown-item">Rapport Inscriptions </a></li>
            <li><a href="<?php echo e(route('libres')); ?>" class="dropdown-item">Rapport Séance Libre </a></li>
            <li><a href="<?php echo e(route('assurances')); ?>" class="dropdown-item">Rapport Assurance </a></li>
            <li><a href="<?php echo e(route('setting.index')); ?>" class="dropdown-item">Paramètres </a></li>




              <!-- Level two dropdown-->
             
              <!-- End Level two -->
            </ul>
          </li>

          <li class="nav-item">
            <a href="<?php echo e(route('decharge.index')); ?>" class="nav-link" style="font-size:20px">
            <i class="fa fa-checkout"></i>
              Charges
            </a>
          </li>

<!--           <li class="nav-item">
            <a href="<?php echo e(route('user.index')); ?>" class="nav-link" style="font-size:20px">
            <i class="fa fa-sliders"></i>
              Utilisateurs
            </a>
          </li>
 -->
          <li class="nav-item">
            <a href="<?php echo e(route('presence.index')); ?>" class="nav-link" style="font-size:20px">
            <i class="fa fa-sliders"></i>
              Présences
            </a>
          </li>




          <!-- <li class="nav-item">
            <a href="<?php echo e(route('setting.index')); ?>" class="nav-link" style="font-size:20px">
            <i class="fa fa-sliders"></i>
            Paramètres
            </a>
          </li> -->
        </ul>
      </div>
    </div>
  </nav>

  <div class="content-wrapper" >
    <?php echo $__env->yieldContent('header'); ?>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <?php echo $__env->yieldContent('content'); ?>
          </div>
        </div>
      </div>
    </div>
    
  </div>  
</div>
<!-- ./wrapper -->

<script src="<?php echo e(asset('adminlte/plugins/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

<script src="<?php echo e(asset('adminlte/plugins/toastr/toastr.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/select2.min.js')); ?>"></script>

<?php echo $__env->yieldContent('scripts'); ?>
<?php echo $__env->yieldContent('modals'); ?>


<script>
$(window).on("load",function(){
  $('.js-example-basic-single').select2();
  $("#global-loader").fadeOut("slow");


});

        var profile = 0;
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var host = window.location.host;
        var host = <?php echo json_encode(url('/')); ?>         
        var u = window.location.href   

        if(host=="http://localhost:8000" && u!='http://localhost:8000/membre'){
          console.log("host")
          setInterval(function(){         
            myObject = {}; 
            $.get('/logs.txt', function(myContentFile) {
                var lines = myContentFile.split("\r\n");
                console.log(lines)
                for(var i  in lines){
                  if(lines[i] != '0'){                    
                    $.ajax({
                      type: 'POST',
                      data: {line: lines[i], _token: CSRF_TOKEN},
                      dataType: 'JSON', 
                      url: "/write",
                      success: function(success){
                        console.log("success")
                          var str = lines[i].substring(0, lines[i].length-2);
                          if(str.length>0){
                              //window.location.replace("http://localhost:8000/membre/edit/"+str);
                              toastr.success('Carte Scanné')

                              console.log("------------"+str)                            
                          }else{
                            toastr.success('Membre n\'existe pas')
                          }
                      },
                      error:function(err){
                        console.log(err)
                      }
                    });
                  }
                  console.log("line : " + i + " :" + lines[i]);
                }
            }, 'text');
          }, 500);
        }



        if(host=="http://localhost:8080"){
          console.log("host2")
          setInterval(function(){         
            myObject = {}; 
            $.get('/logs2.txt', function(myContentFile) {
                var lines = myContentFile.split("\r\n");
                console.log(lines)
                for(var i  in lines){
                  if(lines[i] != '0'){                    
                    $.ajax({
                      type: 'POST',
                      data: {line: lines[i], _token: CSRF_TOKEN},
                      dataType: 'JSON', 
                      url: "/write2",
                      success: function(success){
                        console.log("success")
                          var str = lines[i].substring(0, lines[i].length-2);
                          if(str.length>0){
                              window.location.replace("http://localhost:8080/membre/membre/"+str);
                              console.log("------------"+str)                            
                          }
                      },
                      error:function(err){
                        console.log(err)
                      }
                    });
                  }
                  console.log("line : " + i + " :" + lines[i]);
                }
            }, 'text');
          }, 500);
        }



        <?php if(session('success')): ?>
            $(function(){
                toastr.success('<?php echo e(Session::get("success")); ?>')
            })
        <?php endif; ?>
        <?php if($errors->any()): ?>
            $(function(){
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        toastr.error('<?php echo e($error); ?>')
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            })
        <?php endif; ?>
        <?php if(session('error')): ?>
            $(function(){
                toastr.error('<?php echo e(Session::get("error")); ?>')
            })
        <?php endif; ?>




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

</body>
</html>
