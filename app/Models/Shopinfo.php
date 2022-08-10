<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopinfo extends Model
{
	protected $table='shop_info';
    protected $guarded=['id'];
    use HasFactory;
}
