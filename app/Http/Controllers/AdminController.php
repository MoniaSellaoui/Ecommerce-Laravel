<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Commande;

class AdminController extends Controller
{
    //
    public function Dashboard(){
        return view('Admin.Dashboard' );
    }

    public function profile()
    {
        return view('Admin.profile' );
    }

    public function profileupdate(Request $request)
    {
        Auth::user()->name=$request->name;
        Auth::user()->email=$request->email;
        if($request->password)
        { Auth::user()->password= Hash::make($request->password) ;}

        Auth::user()->update();
        return redirect('/Admin/profile')->with('succes','admin modifier');
    }
    public function client(){
        $clients=User ::where('role','user')->get();
        return view('Admin.clients.index' )->with('clients',$clients);
    }
    public function bloquee($idclient)
    {$client=User::find($idclient);
        $client->is_active=false;
        $client->update();
        return redirect()->back()->with('success','client bloquee');



    }
    public function activee($idclient)
    {$client=User::find($idclient);
        $client->is_active=true;
        $client->update();
        return redirect()->back()->with('success','client activee');



    }
    public function commandes()
    {
        $commandes=Commande::all();
        return view('Admin.commandes.index')->with('commandes',$commandes);
    }
}
