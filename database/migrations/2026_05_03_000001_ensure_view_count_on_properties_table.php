<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('properties', 'view_count')) {
            Schema::table('properties', function (Blueprint $table): void {
                $table->unsignedBigInteger('view_count')->default(0)->after('agent_id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('properties', 'view_count')) {
            Schema::table('properties', function (Blueprint $table): void {
                $table->dropColumn('view_count');
            });
        }
    }
};
