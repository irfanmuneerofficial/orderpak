<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomerResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class Vendor extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    
    protected $guard = 'vendor';
	protected $table='vendors';
	protected $guarded =['id'];

    /**
     * Get the phone associated with the user.
     */
    public function blocked_ip()
    {
        return $this->hasOne(BlockedIp::class, 'user_id');
    }
}
