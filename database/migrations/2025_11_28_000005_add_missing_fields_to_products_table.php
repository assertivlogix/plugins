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
        Schema::table('products', function (Blueprint $table) {
            // Plugin details
            if (!Schema::hasColumn('products', 'short_description')) {
                $table->string('short_description')->nullable()->after('description');
            }
            if (!Schema::hasColumn('products', 'version')) {
                $table->string('version')->default('1.0.0')->after('short_description');
            }
            if (!Schema::hasColumn('products', 'tested_up_to')) {
                $table->string('tested_up_to')->nullable()->after('version');
            }
            if (!Schema::hasColumn('products', 'requires_php')) {
                $table->string('requires_php')->default('7.4')->after('tested_up_to');
            }
            if (!Schema::hasColumn('products', 'requires_wordpress')) {
                $table->string('requires_wordpress')->default('5.0')->after('requires_php');
            }
            
            // Images
            if (!Schema::hasColumn('products', 'banner_image')) {
                $table->string('banner_image')->nullable()->after('file_path');
            }
            if (!Schema::hasColumn('products', 'icon_image')) {
                $table->string('icon_image')->nullable()->after('banner_image');
            }
            
            // Additional fields
            if (!Schema::hasColumn('products', 'changelog')) {
                $table->text('changelog')->nullable()->after('icon_image');
            }
            if (!Schema::hasColumn('products', 'documentation_url')) {
                $table->string('documentation_url')->nullable()->after('changelog');
            }
            if (!Schema::hasColumn('products', 'github_url')) {
                $table->string('github_url')->nullable()->after('documentation_url');
            }
            if (!Schema::hasColumn('products', 'support_url')) {
                $table->string('support_url')->nullable()->after('github_url');
            }
            if (!Schema::hasColumn('products', 'default_activation_limit')) {
                $table->integer('default_activation_limit')->default(1)->after('support_url');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'short_description',
                'version',
                'tested_up_to',
                'requires_php',
                'requires_wordpress',
                'banner_image',
                'icon_image',
                'changelog',
                'documentation_url',
                'github_url',
                'support_url',
                'default_activation_limit'
            ]);
        });
    }
};
