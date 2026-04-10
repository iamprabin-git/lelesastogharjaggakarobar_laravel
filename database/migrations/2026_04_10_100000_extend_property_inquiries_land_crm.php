<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('property_inquiries', function (Blueprint $table) {
            $table->string('phone', 32)->nullable()->after('email');
            $table->string('lead_source', 32)->nullable()->after('phone');
            $table->decimal('deal_value', 15, 2)->nullable()->after('lead_source');
            $table->date('expected_close_date')->nullable()->after('deal_value');
            $table->dateTime('next_follow_up_at')->nullable()->after('expected_close_date');
            $table->text('agent_notes')->nullable()->after('admin_notes');
            $table->string('lost_reason', 64)->nullable()->after('agent_notes');
        });
    }

    public function down(): void
    {
        Schema::table('property_inquiries', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'lead_source',
                'deal_value',
                'expected_close_date',
                'next_follow_up_at',
                'agent_notes',
                'lost_reason',
            ]);
        });
    }
};
