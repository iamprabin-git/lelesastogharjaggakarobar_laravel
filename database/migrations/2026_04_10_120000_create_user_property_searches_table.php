<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_property_searches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('keyword', 255)->nullable();
            $table->string('city', 120)->nullable();
            $table->string('type', 32)->nullable();
            $table->string('bedrooms', 8)->nullable();
            $table->string('min_price', 32)->nullable();
            $table->string('max_price', 32)->nullable();
            $table->string('sort', 32)->nullable();
            $table->timestamps();

            $table->index(['user_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_property_searches');
    }
};
