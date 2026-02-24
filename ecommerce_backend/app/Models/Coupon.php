<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Coupon extends Model
{
    protected $fillable = [
        'name',
        'discount',
        'valid_until',
    ];
    
    /**
     * Convert the coupon name to uppercase
     */
    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = Str::upper($value);
    }
    
    /**
     * Check if a coupon is valid
     */
    public function checkIfValid(): bool
    {
        if ($this->valid_until > Carbon::now()) {
            return true;
        }
        
        return false;
    }
}
