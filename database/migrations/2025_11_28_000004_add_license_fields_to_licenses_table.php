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
        Schema::table('licenses', function (Blueprint $table) {
            // Activation tracking
            $table->integer('activations_used')->default(0)->after('activation_limit');
            $table->boolean('is_active')->default(true)->after('license_key');
            
            // License status and expiry
            $table->string('status')->default('active')->after('is_active'); // active, suspended, expired
            $table->timestamp('expires_at')->nullable()->after('status');
            
            // Domain/URL restrictions
            $table->json('allowed_domains')->nullable()->after('expires_at');
            $table->text('notes')->nullable()->after('allowed_domains');
            
            // Metadata
            $table->json('metadata')->nullable()->after('notes');
            $table->string('version')->nullable()->after('metadata');
            
            // Indexes for performance
            $table->index(['status', 'is_active']);
            $table->index('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('licenses', function (Blueprint $table) {
            $table->dropIndex(['status', 'is_active']);
            $table->dropIndex('expires_at');
            $table->dropColumn([
                'activations_used',
                'is_active', 
                'status',
                'expires_at',
                'allowed_domains',
                'notes',
                'metadata',
                'version'
            ]);
        });
    }
};
