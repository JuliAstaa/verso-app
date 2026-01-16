<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable, HasApiTokens, SoftDeletes;

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }
    
    // Jangan lupa relasi ke Address juga kalau belum
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role',
        'google_id',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function getAvatarAttribute()
    {
        // 1. Ambil path avatar dari tabel profiles (lewat relasi)
        $path = $this->profile?->avatar;

        // 2. Kalau KOSONG -> Pake UI Avatars (Inisial Nama)
        if (!$path) {
            $name = urlencode($this->name);
            return "https://ui-avatars.com/api/?name={$name}&color=FFFFFF&background=6B4F3B";
        }

        // 3. Kalau LINK EXTERNAL (Google/Socialite) -> Balikin mentah
        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        // 4. Kalau FILE LOKAL -> Bungkus pake Storage::url
        return Storage::url($path);
    }
}
