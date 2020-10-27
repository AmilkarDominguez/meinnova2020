<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collector extends Model
{
    protected $fillable = [
        'name', 'description','phone',
        'address','state'
    ];
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}
