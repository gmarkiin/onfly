<?php

namespace App\Models;

use AllowDynamicProperties;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

#[AllowDynamicProperties]
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    public const STATE_NEWLY_CREATED = 'newly_created';
    public const STATE_AUTHENTICATED = 'authenticated';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function createUser(array $data): User
    {
        self::fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ])->save();
        $this->token = $this->createToken('apiAuthToken')->plainTextToken;
        $this->state = self::STATE_NEWLY_CREATED;

        return $this;
    }

    public function checkToken(array $userData): bool
    {
        if (Auth::attempt($userData)) {
            $this->state = self::STATE_AUTHENTICATED;

            $this->token = $this->createToken('apiAuthToken')->plainTextToken;

            return true;
        }

        return false;
    }

    public function expense(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
}
