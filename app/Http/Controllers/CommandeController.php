<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Commande;
use  App\LigneCommande;
class CommandeController extends Controller
{
    //

    public function store(Request $request)
    {
       
       // dd($request);

       // verification s il ya commande en cours ou nn
        $commande=Commande::where('client_id',Auth::user()->id)->where('etat','en cours')->first();
       // dd($commande);

if($commande)
{// creation ligne de commande
    $existe=false;
foreach($commande-> lignecommande as $lignec)
{
  

    if($lignec->product_id==$request->idproduct)
    {   $existe=true;
        $lignec->qte+=$request->qte;
        $lignec->update();
    
    }
}


if(!$existe){ //existe false 
      $lc=new LigneCommande();
    $lc->qte=$request->qte;
   $lc->commande_id=$commande->id;
    $lc->product_id=$request->idproduct;
    $lc->save();
}
    //redirection au panier
    return redirect('/client/cart')->with('success','produit commandee') ;

}
else
{// creation commande
    $commande=new Commande();
    $commande->client_id=Auth::user()->id;
   if( $commande->save())
    {
        $lc=new LigneCommande();
        $lc->qte=$request->qte;
        $lc->commande_id=$commande->id;
        $lc->product_id=$request->idproduct;
        $lc->save();
        //redirection au panier
        return redirect('/client/cart')->with('success','produit commandee') ;
    }
    else{return redirect()->back()->with('error','impossible de commander ce produit') ;}
}


}
public function destroy($idlc)
{
    $lc=LigneCommande::find($idlc);
    $lc->delete();
    return redirect('/client/cart')->with('success','ligne de commande supprimer') ;

}      

    
}
