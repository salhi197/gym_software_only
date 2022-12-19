@extends('layouts.master')
@section('header')
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-white"> {{trans('main.Liste de Inscriptions')}} ,  Total {{count($inscriptions)}}  </h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection
@section('styles')
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
                    <div class="card">
                            <div class="card-body table1">
                                    <div class="row">
                                        <form method="post" action="{{route('inscription.filter')}}">                                                    
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-3" >
                                                        <label class="control-label">{{ trans('main.debut') }}: </label>
                                                        <input class="form-control" value="{{$date_debut ?? ''}}" name="date_debut" type="date" />
                                                    </div>

                                                    <div class="col-md-3" >
                                                        <label class="control-label">{{ trans('main.fin') }}: </label>
                                                        <input class="form-control" value="{{$date_fin ?? ''}}" name="date_fin" type="date" />
                                                    </div>

                                                    



                                                    <div class="col-md-3" >
                                                        <label class="m-0 text-white" style="font-size:30px;">{{trans('main.Abonnement')}}:</label><br>
                                                        <select class="customselect" id="abonnement" name="abonnement">
                                                            <option value="" >{{trans('main.Séléctionner un Abonnement')}}:</option>
                                                                @foreach($abonnements as $abonnement)
                                                                    <option
                                                                        @if($_abonnement==$abonnement->id) selected @endif
                                                                     value="{{$abonnement->id}}">{{$abonnement->label}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>

                                                   <!--  <div class="col-md-3" >
                                                        <label class="m-0 text-white" style="font-size:30px;">Coach:</label><br>
                                                        <select class="customselect" id="coach" name="coach">
                                                            <option value="" >Séléctionner un Coach:</option>
                                                                @foreach($coachs as $coach)
                                                                    <option
                                                                        @if($_coach==$coach->id) selected @endif
                                                                     value="{{$coach->id}}">{{$coach->name}}</option>
                                                                @endforeach
                                                        </select>

                                                    </div> -->
                                                    <div class="col-md-2" style="padding:16px">
                                                        <button type="submit" class="row btn bubbly-button" >
                                                        {{ trans('main.Filtrer') }}
                                                        </button>              
                                                    </div>


                                        </form>

                                    </div>
                                
                                <div class="table-responsive">
                                    <table id="example1"  class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>{{trans('main.Membre')}}</th>
                                                <th>{{trans('main.debut')}}</th>
                                                <th>{{trans('main.fin')}}</th>
                                                <th>{{trans('main.Nombre seance reste')}} </th>
                                                <th>{{trans('main.nbr seances')}} </th>
                                                <th>{{trans('main.abonnement')}}</th>
                                                <th>{{trans('main.etat')}}</th>
                                                <th>{{trans('main.total')}}</th>
                                                <th>{{trans('main.remise')}}</th>
                                                <th>{{trans('main.nbrmois')}}</th>
                                                <th>{{trans('main.versement')}}</th>
                                                <th>{{trans('main.actions')}}</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark">
                                            @foreach($inscriptions as $inscription)
                                            <tr class="
                                                @if($inscription->etat == 1)
                                                td-success
                                                @else
                                                td-error
                                                @endif
                                            ">
                                                <td>
                                                    {{$inscription->getMembre()['nom'] ?? ''}}
                                                    {{$inscription->getMembre()['prenom'] ?? ''}}
                                                </td>
                                                <td>{{$inscription->debut ?? ''}}</td>
                                                <td>{{$inscription->fin ?? ''}}</td>
                                                <td>{{$inscription->reste ?? ''}}</td>
                                                <td style="text-align:center;">{{$inscription->nbsseance ?? ''}}</td>
                                                <td>{{$inscription->getAbonnement()['label'] ?? ''}}</td>
                                                <td>
                                                    <span class="badge badge-info"> 

                                                    @if($inscription->etat == 1)
                                                        {{trans('main.active')}}
                                                    @else
                                                        {{trans('main.non_active')}}
                                                    @endif

                                                    </span>
                                                </td>
                                                <td>{{$inscription->total ?? ''}}DA</td>
                                                <td>{{$inscription->remise ?? ''}}</td>

                                                <td style="text-align:center;">
                                                    {{$inscription->nbrmois ?? ''}}
                                                </td>                                            
                                                <td>{{$inscription->versement ?? ''}} DA</td>

                                                <td>
                                                    <a class="btn bubbly-button text-white" href="{{route('inscription.presence',['inscription'=>$inscription->id])}}">
                                                        <i class="fa fa-list"></i>
                                                        {{trans('main.Présences')}}
                                                    </a>
                                                    @if(Auth::user()->isadmin == 1)
                                                    <a class="btn bubbly-button text-white" href="{{route('inscription.destroy',['inscription'=>$inscription->id])}}">
                                                        <i class="fa fa-trash"></i>
                                                        Supprimer
                                                    </a>
                                                    @endif



                                                </td>
                                            </tr>
                                            @endforeach                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter Inscription</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form role="form" action="{{route('inscription.store')}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="hidden" value="{{$membre->id ?? ''}}" name="membre" />
                                                <div class="form-group">
                                                    <label>Abonnement</label>
                                                    <select class="form-control" id="abonnement" name="abonnement">
                                                        <option value="">séléctionner un abonnement</option>
                                                        @foreach($abonnements as $abonnement)
                                                        <option value="{{$abonnement}}">{{$abonnement->label}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Date début</label>
                                                    <input type="date" id="debut"  value="{{Date('Y-m-d')}}" name="debut" class="form-control">
                                                </div>

                                            </div>

                                            <div class ="col-sm-4">
                                                <div class="form-group">
                                                    <label>Tarification:</label>
                                                    <input type="number"  name="tarif" value="0" id="tarif" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>date fin</label>
                                                    <input id="fin" type="date" value="{{old('fin')}}" name="fin" class="form-control">
                                                </div>
                                            </div>

                                            <div class ="col-sm-4">
                                                <div class="form-group">
                                                    <label>Nombre de mois</label>
                                                    <input type="number"  value="{{old('nbrmois') ?? 1}}" min="1" id="nbrmois" name="nbrmois" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Total</label>
                                                    <input type="number" id="total" value="{{old('total')}}" name="total" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Remise</label>
                                                    <input type="number" value="{{old('remise') ?? 0}}" id="remise" name="remise" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Versement</label>
                                                    <input type="number" value="{{old('versement') ?? 0}}" id="versement" name="versement" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>T.T.C : </label>
                                                    <input type="number" value="{{old('ttc') ?? 0}}" id="ttc" name="ttc" class="form-control">
                                                </div>
                                                

                                            </div>

                                        </div>


                                    <div class="col-sm-12">
                                        <button type="submit" id="valider"  class="btn btn-info btn-block">Valider</button>
                                    </div>


                                    </form>
                                </div>
                            </div>
                </div>
                </div>

@endsection

@section('scripts')
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>



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
@endsection