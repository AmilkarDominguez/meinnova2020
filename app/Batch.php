<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable =[
        'id',
        'product_id',
        'user_id',
        'provider_id',
        'line_id',
        'storage_id',
        'industry_id',
        'payment_status_id',
        'payment_type_id',
        'code',
        'sanitary_registration',
        'description',
        'initial_stock',
        'stock',
        'batch_price',
        'wholesaler_price',
        'entry_date',
        'expiration_date',
        'state'

    ];
    public function details()
    {
        return $this->belongsToMany(DetailSaleProduct::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function line()
    {
        return $this->belongsTo(Catalogue::class);
    }
    public function storage()
    {
        return $this->belongsTo(Catalogue::class);
    }
    public function industry()
    {
        return $this->belongsTo(Catalogue::class);
    }
    public function payment_status()
    {
        return $this->belongsTo(Catalogue::class);
    }
    public function payment_type()
    {
        return $this->belongsTo(Catalogue::class);
    }


}
