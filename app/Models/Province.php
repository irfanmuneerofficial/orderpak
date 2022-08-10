<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City; 

class Province extends Model
{
    use HasFactory;

    public function cities()
    {
        return $this->hasMany('\App\Model\City','province_id');
    }
}
