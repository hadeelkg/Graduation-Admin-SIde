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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name', 70);
            $table->string('email', 254)->unique();
            $table->string('password');
            // $table->string('gender', 6);
            $table->enum("gender", ["male", "female"]);
            $table->string('phone', 10);
            $table->string('address', 200);
            $table->foreignId('city_id')->constrained()
                                        ->onUpdate('cascade')
                                        ->onDelete('cascade');
            $table->timestamps();
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
