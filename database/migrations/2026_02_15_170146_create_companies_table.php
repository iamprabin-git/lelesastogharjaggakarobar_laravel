<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('logo')->nullable(); // store file path

            // Social links
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('viber')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('whatsapp')->nullable();

            // Branding colors
            $table->string('primary_color')->default('#1d4ed8');   // Tailwind Blue
            $table->string('secondary_color')->default('#9333ea'); // Tailwind Purple
            $table->string('primary_background_color')->default('#ffffff'); // White background
            $table->string('secondary_background_color')->default('#f3f4f6'); // Tailwind Gray-100
            $table->string('primary_text_color')->default('#000000'); // Tailwind Gray-900
            $table->string('secondary_text_color')->default('#6b7280'); // Tailwind Gray-500
            $table->boolean('status')->default(true); // active/inactive
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
