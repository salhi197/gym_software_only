 

<?php 
$adress = $_SERVER['REMOTE_ADDR'];

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->

<html lang="en">
<head>
  <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestion Salle du sport</title>

  <!-- Google Font: Source Sans Pro -->
<!--   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
<link href="{{asset('fonts/css3.css')}}" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <link href="{{asset('adminlte/plugins/toastr/toastr.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.css')}}">
  <link rel="stylesheet" href="{{asset('css/ares.css')}}">
  <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
  <link href="{{asset('css/sweetalert.css')}}" rel="stylesheet" />

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
  @yield('styles')
</head>

<body class="hold-transition layout-navbar-fixed">


    <div id="global-loader">
			<img src="{{asset('img/gymA.svg')}}" class="loader-img" width="150px" alt="Loader">
		</div>

<div class="wrapper" id="all-body">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light">
    <div class="container"> 


      <a href="{{route('home')}}" class="navbar-brand">        
          <img src="{{asset('img/gymA.svg')}}" class="logo logo-display" alt="">
      </a>
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{route('membre.index')}}" class="nav-link" style="font-size:20px">
            <i class="fa fa-user"></i>
            {{trans('main.membres')}}
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('abonnement.index')}}" class="nav-link" style="font-size:20px">
            <i class="fa fa-calendar"></i>
              
              {{trans('main.abonnement')}}
              </a>
          </li>

          <li class="nav-item">
            <a href="{{route('inscription.index')}}" class="nav-link" style="font-size:20px">
            <i class="fa fa-calendar"></i>
            
            {{trans('main.inscriptions')}}
            
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="{{route('crenau.index')}}" class="nav-link" style="font-size:20px">
            <i class="fa fa-bicycle"></i>
            Planing
            </a>
          </li> -->

          <li class="nav-item dropdown">
            <a style="font-size:20px" id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
            {{trans('main.rapport')}}

          </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        @if(Auth::user()->isadmin == 1)

<li><a href="{{route('stats')}}" class="dropdown-item">{{trans('main.statistique')}} </a></li>
            <li><a href="{{route('setting.index')}}" class="dropdown-item">Paramètres </a></li>
            <li><a href="{{route('versement.index')}}" class="dropdown-item">Versement </a></li>
            
            <li><a href="{{route('rapport')}}" class="dropdown-item">{{trans('main.rapport_inscriptions')}} </a></li>
            <li><a href="{{route('libres')}}" class="dropdown-item"> {{trans('main.rapport_seance_libre')}}  </a></li>
            <li><a href="{{route('assurances')}}" class="dropdown-item">{{trans('main.rapport_assurance')}} </a></li>
            <li><a href="{{route('decharge.index')}}" class="dropdown-item">{{trans('main.charges')}}  </a></li>

                      
                        @endif
            <li><a href="{{route('presence.index')}}" class="dropdown-item">Présences </a></li>
            <!-- <li><a href="{{route('setting.index')}}" class="dropdown-item">Paramètres </a></li> -->




              <!-- Level two dropdown-->
             
              <!-- End Level two -->
            </ul>
          </li>
          @if(Auth::user()->isadmin == 1)

          <!-- <li class="nav-item">
            <a href="{{route('setting.index')}}" class="nav-link" style="font-size:20px">
            <i class="fa fa-checkout"></i>
            
            {{trans('main.paramètres')}}
            
            </a>
          </li> -->
          
          <li class="nav-item dropdown">
            <a style="font-size:20px" id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
            Personnels
          </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{route('user.index')}}" class="dropdown-item">Utilisateurs </a></li>
            </ul>
          </li>
          @endif

          <li class="nav-item">
            <a
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                             href="{{ route('logout') }}" class="nav-link" style="font-size:20px">
            <i class="fa fa-sliders"></i>
                               
 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                Déconnexion
            </a>
          </li>



          
          <!-- <li class="nav-item">
            <a href="{{route('setting.index')}}" class="nav-link" style="font-size:20px">
            <i class="fa fa-sliders"></i>
            Paramètres
            </a>
          </li> -->
        </ul>


      </div>
      
    </div>
    <div class="col-md-1">
        <a href="{{route('open')}}" class="btn bubbly-button">
        <i class="fa fa-door-open"></i> Ouvrir
        </a>
      </div>    

      <div class="col-md-1">
          <div class="row">
            <span id="check" class="badge badge-success"> Connecté</span>
          </div>
      </div>                         


    <div class="col-md-2">
        <input class="form-control" id="input_id" placeholder="{{trans('main.scanner')}}" autofocus/>
      </div>    
  </nav>

  <div class="content-wrapper" >
    @yield('header')
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            @yield('content')
          </div>
        </div>
      </div>
    </div>
    
  </div>  
</div>
<!-- ./wrapper -->

<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/select2.min.js')}}"></script>

<script src="{{asset('adminlte/plugins/toastr/toastr.min.js')}}"></script>

@yield('scripts')
@yield('modals')


<script>
$(window).on("load",function(){


  var addres = {!! json_encode($adress) !!};
  toastr.options.timeOut = 20
  $('.js-example-basic-single').select2();
  $("#global-loader").fadeOut("slow");
  $('#input_id').on('change',function(){
      console.log('saz')
      if($('#input_id').val().length >0){
          let number = parseInt($('#input_id').val(), 10);
          let matricules = {!! json_encode(Config::get('matricules')) !!};
          //console.log(matricules);
          var res = false;
          matricules.map(function (matricule) {
              res = res || matricule.matricule == number;
          });          
          console.log(res)
          if(res==false){
            toastr.error('Carte Non valide')
            $('#input_id').val("")
          }else{
            window.location.href = 'http://localhost/gymaccess/membre/compte/'+number;
          }
      }
  });



// on load abda diiiir kolch



var profile = 0;
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var host = window.location.host;
        var host = {!! json_encode(url('/')) !!}         
        var u = window.location.href   

       
        



        @if(session('success'))
            $(function(){
                toastr.success('{{Session::get("success")}}')
            })
        @endif
        @if ($errors->any())
            $(function(){
                @foreach ($errors->all() as $error)
                        toastr.error('{{$error}}')
                @endforeach
            })
        @endif
        @if(session('error'))
            $(function(){
                toastr.error('{{Session::get("error")}}')
            })
        @endif

           
        



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

</body>
</html>
