<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    protected $fillable = [
        'name', 'type_catalog_id', 'description', 'state'
    ];

    public function typeCatalog()
    {
        return $this->belongsTo(TypeCatalog::class);
    }
    // un tipo de cliente tiene muchos cliente (hasMany)
    public function clients()
    {
        return $this->hasMany(Client::class);
    }
    // un tipo de producto tiene muchos productos 
    public function products()
    {
        return $this->hasMany(Client::class);
    }
    // una zona puede contener muchos proveedores
    public function providers()
    {
        return $this->hasMany(Provider::class);
    }
    public function industrybatchs()
    {
        return $this->hasMany(Batch::class);
    }
    public function linebatchs()
    {
        return $this->hasMany(Batch::class);
    }
    public function storagebatch()
    {
        return $this->belongsTo(Batch::class);
    }
    public function paymentstatubatch()
    {
        return $this->belongsTo(Batch::class);
    }
    public function paymentstatusale()
    {
        return $this->belongsTo(Sale::class);
    }
    public function paymenttype()
    {
        return $this->belongsTo(Batch::class);
    }

}
