<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

use App\Models\TattooShop;
use App\Models\Picture;
use App\Models\FlashTattoo;
use App\Models\ArtStyle;


class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'role_id',
        'email',
        'password',
        'pseudo_user',
        'email_contact',
        'tel',
        'description',
        'instagram',
        'img_profil',
        'city',
        'departement',
        'coordonnes',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed', // A commenter ou supprimer
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return ['role_id'=>$this->role_id];
    }

    public function tattooshop()
    {
        return $this->hasMany(TattooShop::class, 'user_id');
    }

    public function pictures()
    {
        return $this->hasMany(Picture::class, 'user_id');
    }

    public function flashtattoos()
    {
        return $this->hasMany(FlashTattoo::class, 'user_id');
    }

    public function artstyles()
    {
        return $this->belongsToMany(ArtStyle::class, 'users_art_styles', 'user_id', 'artstyle_id');
    }
}
