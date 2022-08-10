<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderUserDetail extends Model
{
    use HasFactory;
    protected $table='order_user_detail';
    protected $guarded=['id'];

    public function shipment_info(){
        return $this->hasOne(ShipmentInfo::class,'order_id','order_id')->where('consignment_number', '>', '0');
    }
}
