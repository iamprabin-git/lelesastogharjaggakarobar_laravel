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
        Schema::create('property_inquiries', function (Blueprint $table) {
           $table->id();
        $table->foreignId('property_id')->constrained()->onDelete('cascade');
        $table->foreignId('agent_id')->constrained()->onDelete('cascade'); // optional denormalization
        $table->string('name');
        $table->string('email');
        $table->text('message');
        $table->boolean('is_read')->default(false);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_inquiries');
    }
};
