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
            // File upload fields
            $table->string('document_file')->nullable()->after('version'); // For documentation PDFs
            $table->string('certificate_file')->nullable()->after('document_file'); // For certificates
            $table->string('receipt_file')->nullable()->after('certificate_file'); // For purchase receipts
            $table->json('file_metadata')->nullable()->after('receipt_file'); // Store file info
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('licenses', function (Blueprint $table) {
            $table->dropColumn([
                'document_file',
                'certificate_file', 
                'receipt_file',
                'file_metadata'
            ]);
        });
    }
};
