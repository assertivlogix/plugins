<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductsTableForWordpressPlugins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Add new columns if they don't exist
            if (!Schema::hasColumn('products', 'short_description')) {
                $table->string('short_description', 255)->nullable()->after('description');
            }
            if (!Schema::hasColumn('products', 'version')) {
                $table->string('version', 20)->default('1.0.0')->after('short_description');
            }
            if (!Schema::hasColumn('products', 'tested_up_to')) {
                $table->string('tested_up_to', 20)->nullable()->after('version');
            }
            if (!Schema::hasColumn('products', 'requires_php')) {
                $table->string('requires_php', 20)->nullable()->after('tested_up_to');
            }
            if (!Schema::hasColumn('products', 'requires_wordpress')) {
                $table->string('requires_wordpress', 20)->nullable()->after('requires_php');
            }
            if (!Schema::hasColumn('products', 'banner_image')) {
                $table->string('banner_image')->nullable()->after('file_path');
            }
            if (!Schema::hasColumn('products', 'icon_image')) {
                $table->string('icon_image')->nullable()->after('banner_image');
            }
            if (!Schema::hasColumn('products', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('icon_image');
            }
            if (!Schema::hasColumn('products', 'changelog')) {
                $table->text('changelog')->nullable()->after('is_active');
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
            
            // Modify existing columns if needed
            // $table->text('description')->change(); // Commented out to avoid issues if it's already text
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop added columns
            $table->dropColumn([
                'short_description',
                'version',
                'tested_up_to',
                'requires_php',
                'requires_wordpress',
                'banner_image',
                'icon_image',
                'is_active',
                'changelog',
                'documentation_url',
                'github_url',
                'support_url'
            ]);
            
            // Revert any column modifications
            $table->string('description')->change();
        });
    }
}
