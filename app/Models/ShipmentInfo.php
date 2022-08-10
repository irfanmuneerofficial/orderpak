<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentInfo extends Model
{
    use HasFactory;

    protected $table='shipment_info';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'user_id',
        'is_success',
        'message',
        'consignment_number',
        'courier_type',
        'label',
        'status'
    ];

    public function save_shipment($data){
        self::create($data);
    }
    
}
