<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use  App\Review; 
use  App\Category; 
use  App\Commande; 

class ClientController extends Controller
{
    //
    public function Dashboard(){
        return view('Client.Dashboard' );
    }



    public function profile()
    {
        return view('client.profile' );
    }
    public function profileupdate(Request $request)
    {
        Auth::user()->name=$request->name;
        Auth::user()->email=$request->email;
        if($request->password)
        { Auth::user()->password= Hash::make($request->password) ;}

        Auth::user()->update();
        return redirect('/client/profile')->with('succes','client modifier');
    }



    public function addReview(Request $request)

    {
     //dd( $request);
     $review=new Review();
     $review->rate=$request->rate;
     $review->product_id=$request->product_id;
     $review->content=$request->content;
     $review->user_id=Auth::user()->id;
     $review->save();
     return redirect()->back();
    } 
    
    
    public function cart(){
        $categories=Category::all();
        $commande=Commande::where('client_id',Auth::user()->id)->where('etat','en cours')->first();
        return view('guest.cart' )->with('categories',$categories)->with('commande',$commande);
    }


public function checkout(Request $request)
{//dd($request);
    $commande=Commande::find($request->commande);
   // dd($commande);
    $commande->etat="payee";
    $commande->update();

     return redirect('/Client/dashboard')->with('success','commande payee avec success');
}
public function commandes()
{
    return view('client.commandes');
    
}
public function messagedebloque()
{
    return view('client.bloquer');
}

}
