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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('license_id')->nullable();
            $table->foreignId('subscription_id')->nullable();
            $table->foreignId('product_id');
            
            // Transaction Details
            $table->string('transaction_id')->unique(); // Unique transaction identifier
            $table->string('type'); // purchase, renewal, refund, etc.
            $table->string('status'); // pending, completed, failed, refunded
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('USD');
            
            // Payment Information
            $table->string('payment_method'); // stripe, paypal, etc.
            $table->string('payment_gateway_transaction_id')->nullable(); // Stripe payment intent ID, etc.
            $table->string('payment_gateway_customer_id')->nullable();
            $table->json('payment_metadata')->nullable(); // Additional payment gateway data
            
            // Product/Subscription Details
            $table->string('product_name');
            $table->string('plan'); // monthly, yearly, lifetime
            $table->decimal('original_amount', 10, 2)->nullable(); // Original price before discounts
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->string('discount_code')->nullable();
            $table->string('license_key')->nullable();
            
            // Period Information (for subscriptions)
            $table->timestamp('period_start')->nullable();
            $table->timestamp('period_end')->nullable();
            $table->boolean('auto_renewal')->default(false);
            
            // Billing Information
            $table->string('billing_name');
            $table->string('billing_email');
            $table->string('billing_address')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('billing_country')->nullable();
            $table->string('billing_postal_code')->nullable();
            $table->string('billing_phone')->nullable();
            
            // Additional Information
            $table->text('description')->nullable();
            $table->json('metadata')->nullable(); // Additional transaction metadata
            $table->text('notes')->nullable(); // Admin notes
            
            // Timestamps
            $table->timestamp('processed_at')->nullable(); // When transaction was processed
            $table->timestamp('refunded_at')->nullable(); // When transaction was refunded
            $table->timestamps();
            
            // Indexes
            $table->index(['user_id', 'created_at']);
            $table->index(['transaction_id']);
            $table->index(['type', 'status']);
            $table->index(['payment_method', 'status']);
            $table->index(['processed_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
