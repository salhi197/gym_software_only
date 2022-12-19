@extends('layouts.master')

@section('content')
                    <div class="container-fluid">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-3 col-12">
                                    <!-- small box -->
                                    <div class="small-box bg-primary">
                                      <div class="inner">
                                        <h3>{{$benefice ?? ''}}</h3>
                                        <p>
                                            Chiffre D'affaire
 
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
                                        <h3>{{$nombreInscriptions ?? count($inscriptions)}}</h3>
                                        <p>
                                        {{ trans('main.Nombre Inscriptions') }} 
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
                        <form method="post" action="{{route('rapport.filter')}}">                                                    
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
                                    <label class="control-label" >Caissier :</label><br>
                                    <select class="customselect" id="coach" name="user">
                                        <option value="" >Séléctionner un Caissier:</option>
                                            @foreach($users as $user)
                                                <option
                                                 @if($_user==$user->id) selected @endif
                                                value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                    </select>

                                </div>
                                <div class="col-md-4" style="padding:16px;">
                                    <button type="submit" class="row btn bubbly-button" >
                                        {{ trans('main.Filtrer') }}
                                    </button>                                                                                                        
                                </div>
                            </div>
                        </form>
                    </div>
                    <table id="example1"  class="table table-striped table-bordered no-wrap text-dark">
                                        <thead>
                                            <tr class="text-white">
                                                <th>{{ trans('main.Membre') }}</th>
                                                <th>{{ trans('main.debut') }}</th>
                                                <th>{{ trans('main.fin') }}</th>
                                                <th>{{ trans('main.Nombre seance reste') }} </th>
                                                <th>{{ trans('main.nbr seances') }} </th>
                                                <th>{{ trans('main.abonnement') }}</th>
                                                <th>{{ trans('main.etat') }}</th>
                                                <th>{{ trans('main.total') }}</th>
                                                <th>{{ trans('main.remise') }}</th>
                                                <th>{{ trans('main.nbrmois') }}</th>
                                                <th>{{ trans('main.versement') }}</th>
                                                <th>{{ trans('main.actions') }}</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($inscriptions as $inscription)
                                            <tr 
                                            class="
                                            @if($inscription->etat == 1)
                                            td-success
                                            @else
                                            td-error
                                            @endif"
                                            >
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
                                                        Active
                                                    @else
                                                        Non Active
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
                                                        Présences
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach                                            
                                        </tbody>
                                    </table>

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
<script src="{{asset('adminlte/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>


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
        
});

</script>
@endsection