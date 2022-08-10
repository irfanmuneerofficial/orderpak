<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redirect301 extends Model
{
    use HasFactory;
    protected $table = '301_redirects';

}
