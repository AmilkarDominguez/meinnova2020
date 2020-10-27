<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeCatalog extends Model
{
    protected $fillable =[
        'name', 'description', 'state',
    ];

    public function catalogues()
    {
        return $this->hasMany(Catalogue::class);
    }
}
