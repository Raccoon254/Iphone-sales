<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('order_number');
            $table->enum('status', ['pending', 'processing', 'completed', 'decline', 'cancel']);
            $table->dateTime('order_date');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->string('grand_total');
            $table->string('shipping_address');
            $table->string('shipping_method');
            $table->string('shipping_cost');
            $table->json('location')->nullable();
            $table->enum('shipping_status', ['pending', 'processing', 'completed', 'decline', 'cancel']);
            $table->dateTime('delivery_date')->nullable();
            $table->json('items');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
