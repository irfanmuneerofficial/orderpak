<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
// use Spatie\MediaLibrary\HasMedia;
// use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\Models\Media;
use App\Notifications\AdminResetPasswordNotification;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $guard = 'admin';

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'profile_image',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Get the vendor's full name.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return preg_replace('/\s+/', ' ',$this->first_name.' '.$this->last_name);
    }

    // public function adminlte_image()
    // {
    //     return $this->getFirstMediaUrl('avatars', 'thumb');
    // }

    // public function adminlte_desc()
    // {
    //     return 'That\'s a nice guy';
    // }

    // public function adminlte_profile_url()
    // {
    //     return 'admin/username';
    // }

    // public function deleteMedia($mediaId)
    // {
    //     // echo $mediaId;die;
    //     if ($mediaId instanceof Media) {
    //         $mediaId = $mediaId->getKey();
    //     }
    //     $media = $this->media->find($mediaId);
    //     // if (! $media) {
    //     //     throw MediaCannotBeDeleted::doesNotBelongToModel($mediaId, $this);
    //     // }
    //     $media->delete();
    // }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }
}
