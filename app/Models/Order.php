<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'order_date',
        'payment_method',
        'payment_status',
        'grand_total',
        'shipping_address',
        'shipping_method',
        'shipping_cost',
        'location',
        'shipping_status',
        'delivery_date',
        'items',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'order_date' => 'datetime',
        'delivery_date' => 'datetime',
        'items' => 'array',
        'location' => 'array',
    ];

    //user
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
