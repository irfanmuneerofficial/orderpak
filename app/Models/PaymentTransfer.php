<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransfer extends Model
{
    use HasFactory;
    protected $table='paymenttransfer';
    protected $guarded=['id'];
    protected $appends = ['image_url'];
    function vendor()
    {
    	return $this->belongsTo(Vendor::class,'vendor_id','id');
    }
    public function getImageUrlAttribute(){
        return '/uploads/admin/payment_transfer/';
    }
}