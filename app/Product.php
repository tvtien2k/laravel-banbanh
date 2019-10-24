<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function product_type()
    {
        return $this->belongsTo('App\Product', 'id_type', 'id');
    }

    public function bill_detail()
    {
        return $this->hasMany('BillDetail', 'id_product', 'id');
    }
}
