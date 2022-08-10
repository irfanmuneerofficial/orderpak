<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{
    protected $table='sliders';
    protected $guarded=['id'];

    use HasFactory;
}
