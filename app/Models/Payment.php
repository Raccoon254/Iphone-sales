<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *     Schema::create('payments', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->unsignedBigInteger('order_id');
    $table->string('transaction_id')->nullable();
    $table->decimal('amount', 8, 2);
    $table->string('currency');
    $table->enum('status', ['completed', 'pending', 'failed', 'cancelled']);
    $table->timestamp('payment_date')->nullable();
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users');
    $table->foreign('order_id')->references('id')->on('orders');
    });
     */
    protected $fillable = [
        'user_id',
        'order_id',
        'transaction_id',
        'amount',
        'currency',
        'status',
        'payment_date',
    ];
}
