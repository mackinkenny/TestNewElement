<?php

namespace App;

use ESolution\DBEncryption\Traits\EncryptedAttribute;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use EncryptedAttribute;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'role_id', 'position_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be encrypted on save.
     *
     * @var array
     */
    protected $encryptable = [
        'name', 'email', 'phone'
    ];


    public function position() {
        return $this->belongsTo(Position::class);
    }

    public function skills() {
        return $this->belongsToMany(Skill::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }
}
