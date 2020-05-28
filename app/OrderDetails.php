<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $table='tbl_order_details';
    protected $fillable = [
        'order_id', 'product_id','product_name','product_price','product_sales_quantity'
    ];
}
