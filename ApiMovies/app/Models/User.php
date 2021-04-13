<?php

namespace App\Models;

use App\Http\Controllers\Api\UserController;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'api_key',
    ];

    /**
     * @return $this
     */
    public function setPasswordAttribute(string $password): self
    {
        $this->attributes['password'] = bcrypt($password);
        return $this;
    }

    public function setApiKeyAttribute(): self
    {
        $this->attributes['api_key'] = Str::random(60);
        return $this;
    }
}
