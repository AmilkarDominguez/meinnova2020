<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable =[
        'collector_id','sale_id','state','payment','entry_date','receipt_number'
    ];

    public function collector()
    {
        return $this->belongsToMany(Collector::class);
    }
    public function sale()
    {
        return $this->belongsToMany(Sale::class);
    }
    

}
