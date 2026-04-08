<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->string('facebook')->nullable()->after('avatar');
            $table->string('twitter')->nullable()->after('facebook');
            $table->string('linkedin')->nullable()->after('twitter');
            $table->string('instagram')->nullable()->after('linkedin');
        });

        Schema::table('property_inquiries', function (Blueprint $table) {
            $table->string('crm_status', 32)->default('new')->after('is_read');
            $table->text('admin_notes')->nullable()->after('crm_status');
        });
    }

    public function down(): void
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->dropColumn(['facebook', 'twitter', 'linkedin', 'instagram']);
        });

        Schema::table('property_inquiries', function (Blueprint $table) {
            $table->dropColumn(['crm_status', 'admin_notes']);
        });
    }
};
