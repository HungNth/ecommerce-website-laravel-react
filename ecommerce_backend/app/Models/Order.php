<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected $fillable = ['qty', 'total', 'delivered_at', 'user_id', 'coupon_id'];
    
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }
}
