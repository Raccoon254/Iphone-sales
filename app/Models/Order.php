<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Env;

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

    // In Order model
    /*
     * protected $fillable = [
        'user_id',
        'order_id',
        'transaction_id',
        'amount',
        'currency',
        'status',
        'payment_date',
    ];
     */
    public function createPayment(): Model
    {
        $user = auth()->user();
        return $this->payment()->create([
            'user_id' => $user->id,
            'order_id' => $this->id,
            'amount' => $this->grand_total,
            'currency' => Env::get('APP_CURRENCY') ?? 'KES',
            'status' => 'pending',
            'payment_date' => now()
        ]);
    }


    //user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

}
