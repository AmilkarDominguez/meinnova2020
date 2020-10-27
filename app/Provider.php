<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable =[
        'catalog_zone_id', 'name', 'description','contact',
        'phone','address','state'
    ];

    // un proveedor pertenece a un sola zona
    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class);
    }
    public function batches()
    {
        return $this->belongsToMany(Batch::class);
    }
}
