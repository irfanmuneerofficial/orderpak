<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderBook extends Model
{
    use HasFactory;
    protected $table='orderbook';
    protected $guarded=['id'];
    
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function shipment_info(){
        return $this->hasOne(ShipmentInfo::class,'order_id','order_id')->where('consignment_number', '>', '0');
    }
}
