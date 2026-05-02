<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_sections', function (Blueprint $table): void {
            $table->string('hero_image')->nullable()->change();
            $table->string('about_image')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('about_sections', function (Blueprint $table): void {
            $table->string('hero_image')->nullable(false)->change();
            $table->string('about_image')->nullable(false)->change();
        });
    }
};
