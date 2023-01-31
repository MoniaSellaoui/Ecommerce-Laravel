<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LigneCommande extends Model

{

    protected $table = '_ligne_commandes';
    //
    /**
     * Get the commande that owns the LigneCommande
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id', 'id');
    }
    /**
     * Get the product associated with the LigneCommande
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
