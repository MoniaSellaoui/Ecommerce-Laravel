<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
   
    public function lignecommande()
    {
        return $this->hasMany(LigneCommande::class, 'commande_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function getTotal()
    {$Total=0;
        foreach($this->lignecommande as $lc)

        {$Total+=$lc->product->price * $lc->qte;
           

        }
        return $Total;
    }
}
