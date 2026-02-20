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
        Schema::create('payments', function (Blueprint $table) {
             $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('plan_name');
        $table->decimal('amount', 10, 2);
        $table->string('payment_method'); // qr or bank
        $table->string('transaction_id')->nullable();
        $table->string('screenshot')->nullable();
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
