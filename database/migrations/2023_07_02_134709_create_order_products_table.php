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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_price', 3);
            $table->string('quantity', 2);
            $table->string('subtotal_price', 10);
            $table->foreignId('product_id')->constrained();
            $table->foreignId('order_id')->constrained();
                                        //  ->onUpdate('cascade')
                                        //  ->onDelete('cascade');
            $table->timestamps();
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
