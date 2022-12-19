<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Wilaya;
use Carbon\Carbon;
use Hash;
use App\Produit;
use App\Setting;
use App\Categorie;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProduitController extends Controller
{


    public function index()
    {
        $produits = Produit::all();
        return view('produits.index',compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categorie::all();
        $settings = Setting::all();
        return view('produits.create',compact('categories','settings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produit = new Produit();   
        $produit->categorie = $request['categorie'];
        $produit->designation = $request['designation'];
        $produit->setting= json_encode($request->settings);
        $produit->save();
        return redirect()->route('produit.index')->with('success', 'reservation inséré avec succés ');        
    }

    
    public function show($id_produit)
    {
        $produit = Produit::find($id_produit);
        return view('produits.view',compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit($id_produit)
    {
        $categories = Categorie::all();

        $produit = Produit::find($id_produit);
        return view('produits.edit',compact('communes','categories','produit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$produit_id)
    {
        $produit = Produit::find($produit_id);  
        $produit->categorie = $request['categorie'];
        $produit->designation = $request['designation'];
        $produit->save();
        return redirect()->route('produit.index')->with('success', 'reservation inséré avec succés ');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_produit)
    {
        $produit = Produit::find($id_produit);
        $produit->delete();
        return redirect()->route('produit.index')->with('success', 'le Produit a été supprimé ');        
    }


}
