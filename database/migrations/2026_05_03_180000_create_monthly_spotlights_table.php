<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monthly_spotlights', function (Blueprint $table): void {
            $table->id();
            $table->string('kind', 32)->unique();
            $table->string('honoree_name');
            $table->string('subtitle')->nullable();
            $table->string('period_label')->nullable();
            $table->string('page_title')->nullable();
            $table->string('image')->nullable();
            $table->longText('congratulations_html')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monthly_spotlights');
    }
};
