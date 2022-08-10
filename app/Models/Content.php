<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Content extends Model
{
    Use SoftDeletes;
    protected $table = "content";
    //


    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    public $fillable = [
        'title', 'description','meta_title', 'meta_description'
    ];
}
