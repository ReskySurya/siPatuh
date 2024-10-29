<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Officer extends Authenticatable
{
    use AuthenticatableTrait, HasFactory, HasApiTokens, Notifiable;

    protected $guard = 'officer';

    protected $fillable = [
        'name',
        'nip',
        'email',
        'password',
        'image_signature',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'nip';
    }
}
