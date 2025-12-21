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
        Schema::create('renewal_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('license_id');
            $table->foreignId('subscription_id');
            $table->foreignId('product_id');
            
            $table->string('plan'); // monthly, yearly
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('USD');
            
            $table->string('renewal_type')->default('extension'); // extension, new_license
            $table->string('transaction_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_intent_id')->nullable();
            $table->string('customer_id')->nullable();
            
            $table->timestamp('renewal_start_date')->nullable();
            $table->timestamp('renewal_end_date')->nullable();
            
            $table->text('notes')->nullable();
            $table->json('metadata')->nullable();
            
            $table->timestamps();
            
            $table->index(['user_id', 'license_id']);
            $table->index(['subscription_id']);
            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renewal_history');
    }
};
