<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable =[
        
        'date','total', 'client_id','user_id','seller_id','payment_status_id','discount', 'receive','expiration_discount','total_discount','state'
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
    public function payment_status()
    {
        return $this->belongsTo(Catalogue::class);
    }
    public function details()
    {
        return $this->hasMany(DetailSaleProduct::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
