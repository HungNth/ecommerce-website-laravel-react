<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'city',
        'zip_code',
        'country',
        'phone_number',
        'profile_image',
        'profile_completed',
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
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
    
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class)->with('products')->latest();
    }
    
    public function image_path(): string
    {
        if ($this->profile_image) {
            return asset('storage/images/users/'.$this->profile_image);
        }
        
        return 'https://d3cav5r4mkyokm.cloudfront.net/staging/c9a7aebb-5ab3-41de-8e76-a5685f399a81/6989af1fe7b8a30054b8e82a/A-ME-2026-KZR0-1771916856332.png';
    }
}
