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
        Schema::create('abouts', function (Blueprint $table) {
        $table->id();
        $table->string('hero_title');
        $table->text('hero_description');
        $table->string('hero_image');

        $table->string('about_image');
        $table->string('experience_years');

        $table->integer('properties_sold');
        $table->integer('happy_clients');

        $table->text('mission');
        $table->text('vision');

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
