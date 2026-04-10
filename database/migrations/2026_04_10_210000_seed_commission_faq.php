<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('faqs')) {
            return;
        }

        $question = 'What commission do you charge?';

        if (DB::table('faqs')->where('question', $question)->exists()) {
            return;
        }

        DB::table('faqs')->insert([
            'question' => $question,
            'answer' => 'We charge 3% commission after sell in average.',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        if (! Schema::hasTable('faqs')) {
            return;
        }

        DB::table('faqs')->where('question', 'What commission do you charge?')->delete();
    }
};
