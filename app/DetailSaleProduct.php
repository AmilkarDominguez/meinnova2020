<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailSaleProduct extends Model
{
    protected $fillable =[
        'name_product','amount', 'subtotal','state','sale_id', 'batch_id'
    ];
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
