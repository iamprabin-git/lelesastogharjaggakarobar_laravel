<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('property_inquiries', function (Blueprint $table) {
            $table->dropForeign(['property_id']);
        });

        Schema::table('property_inquiries', function (Blueprint $table) {
            $table->foreignId('property_id')->nullable()->change();
        });

        Schema::table('property_inquiries', function (Blueprint $table) {
            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('property_inquiries', function (Blueprint $table) {
            $table->dropForeign(['property_id']);
        });

        Schema::table('property_inquiries', function (Blueprint $table) {
            $table->foreignId('property_id')->nullable(false)->change();
        });

        Schema::table('property_inquiries', function (Blueprint $table) {
            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->cascadeOnDelete();
        });
    }
};
