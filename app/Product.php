<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable =[
        'catalog_product_id','name', 'description','state'
    ];

    // un producto pertenece a un solo tipo de producto
    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class);
    }
    public function batches()
    {
        return $this->belongsToMany(Batch::class);
    }
}
