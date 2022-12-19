@extends('layouts.master')

@section('page_wrapper')
@endsection


@section('content')


<div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a class="btn btn-info" href="{{route('produit.create')}}"><i class="fa fa-plus"></i> Ajouter produit</a>
                                </h4>
                                
                                <div class="table-responsive">
                                    <table id="zero_config" id="DataTable" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Produit</th>
                                                <th>Famille</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($produits as $produit)
                                            <tr>
                                                <td>{{$produit->id }}</td>
                                                <td>{{$produit->designation}}</td>
                                                <td>{{$produit->getCategorie()['label'] ?? ''}}</td>
                                                <td>
                                                <a class="btn btn-info text-white" href="{{route('produit.edit',['produit'=>$produit->id])}}"><i class="fa fa-edit"></i></a>
                                                <a href="{{route('produit.destroy',['produit'=>$produit->id])}}" onclick="return confirm('Etes vous sure ?')"  class="btn btn-danger text-white"><i class="fa fa-window-close"></i></a>
                                                </td>
                                            </tr>

                                            @endforeach                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


@endsection