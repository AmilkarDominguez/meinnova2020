<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable =[
        'catalog_zone_id','nit',
        'name','contact','description','phone','address','state'
    ];
    // un cliente pertenece a un solo tipo de cliente (belongsTo)
    public function zoneclient()
    {
        return $this->belongsTo(Catalogue::class);
    }
    public function typeclient()
    {
        return $this->belongsTo(Catalogue::class);
    }
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
  
}

