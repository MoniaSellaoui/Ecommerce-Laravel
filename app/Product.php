<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function category()
    { return $this->belongsTo(Category::class,'category_id','id');}


/**
 * Get all of the comments for the Product
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
public function reviews()
{
    return $this->hasMany(Review::class, 'product_id', 'id');
}

/**
 * Get the lignecommande that owns the Product
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function lignecommande()
{
    return $this->hasMany(LigneCommande::class, 'product_id', 'id');
}

}
