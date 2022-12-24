@extends('layouts.master')
@section('styles')
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('header')
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-4">
              <a href="{{route('membre.create')}}" class="btn bubbly-button btn-lg"><i class="fa fa-plus"></i> {{trans('main.ajouter')}}</a>
          </div><!-- /.col -->
          <div class="col-sm-6">
          <h1 class="m-0 text-white">{{trans('main.Nombre Total')}} : {{count($membres)}}<h1>
          <h1 class="m-0 text-white">{{trans('main.Nombre Total')}} Homme : {{count($hommes)}}<h1>
          <h1 class="m-0 text-white">{{trans('main.Nombre Total')}} Femme: {{count($femmes)}}<h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
                        <div class="card ">
                            <div class="card-body table1">
                                <div class="row text-right">
                                    <div class="col-md-3">
                                    </div>
                                </div>
                                <br>


                                
                                

                                <div class="table-responsive">
                                    <table id="MembersTable" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>{{trans('main.id')}}</th>
                                                <th>{{trans('main.Matricule')}}</th>
                                                <th>{{trans('main.nom')}}</th>
                                                <th>{{trans('main.Prénom')}}</th>
                                                <th>{{trans('main.Téléphone')}}</th>                                                
                                                <th>{{trans('main.Action')}}</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
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
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>


<script>
    $(document).ready(function() {
        // $('#input_id').on('change',function(){
        //     if($('#input_id').val().length >0){
        //         let number = parseInt($('#input_id').val(), 10);
        //         console.log(number);
        //         window.location.href = 'http://localhost:8000/membre/compte/'+number;
        //     }
        // });

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $('#MembersTable').DataTable({
            searching: true,
            language: {
                lengthMenu: "Display _MENU_ records per page",
                zeroRecords: "Pas de Résultat   ",
                info: "Showing page _PAGE_ of _PAGES_",
                infoEmpty: "No records available",
                infoFiltered: "(filtered from _MAX_ total records)"
            },
            processing: true,
            serverSide: true,
            ajax: "{{route('members.getMembers')}}",
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
                            var view = '<a href="/gymaccess/membre/membre/' + row.matricule + ' " class="btn bubbly-button text-white">{{trans("main.Profile")}} </a>';
                            view += ' <a href="/gymaccess/membre/edit/' + row.matricule + ' " class="btn bubbly-button text-white">{{trans("main.Modifier")}} <i class="fa fa-edit"></i></a>';
                            @if(Auth::user()->isadmin==1)
                            view += ' <a href="/gymaccess/membre/destroy/' + row.matricule + ' " class="btn bubbly-button text-white">{{trans("main.Supprimer")}} <i class="fa fa-trash"></i></a>';

                            @endif
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

        // @foreach($membres as $membre)
        //     @if($membre->matricule != 0)
        //         <tr>
        //             <td>{{$membre->matricule }}</td>
        //             <td>{{$membre->nom ?? ''}}</td>
        //             <td>{{$membre->prenom ?? ''}}</td>
        //             <td>{{$membre->telephone ?? ''}}</td>                                            
        //             <td>
        //                 <span class="btn bubbly-button" >
        //                     {{$membre->getAbonnement()['label'] ?? '' }}
        //                 </span>
        //             </td>                                            
        //             <td>
        //                     {{$membre->getActiveInscription()['fin'] ?? '' }}
        //             </td>                                            

        //             <td>
        //                 {{$membre->created_at ?? ''}}
        //             </td>                                            
        //             <td>
        //                 <a class="btn bubbly-button text-white" href="{{route('membre.edit',['membre'=>$membre->matricule])}}">Modifier <i class="fa fa-edit"></i></a>
        //                 <!-- <a href="{{route('membre.destroy',['membre'=>$membre->matricule])}}" onclick="return confirm('Etes vous sure ?')"  class="btn btn-danger text-white"><i class="fa fa-window-close"></i></a> -->
        //                 <a class="btn bubbly-button text-white" onclick="return confirm('Etes vous sure ?')" href="{{route('membre.destroy',['membre'=>$membre->matricule])}}"><i class="fa fa-trash"></i> Supprimer</a>
        //                 <a class="btn bubbly-button text-white" href="{{route('membre.membre',['membre'=>$membre->matricule])}}">
        //                 Profile
        //                 </a>
        //             </td>
        //         </tr>

        //     @endif
        // @endforeach                                            

        
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
@endsection