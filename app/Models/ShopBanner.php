<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopBanner extends Model
{
    use HasFactory;
    protected $table='shop_banner';
    protected $guarded=['id'];
}
