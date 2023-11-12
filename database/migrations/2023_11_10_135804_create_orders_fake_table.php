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
        Schema::create('orders_fake', function (Blueprint $table) {
            $$table->id();
            $table->integer('product_id');
            $table->integer('user_id');
            $table->integer('quantity');
            $table->string('address');
            $table->integer('status');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->string('message');
            $table->timestamp('purchase_date')->default(DB::raw('getdate()'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_fake');
    }
};
