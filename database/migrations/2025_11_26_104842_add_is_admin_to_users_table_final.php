<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddIsAdminToUsersTableFinal extends Migration
{
    public function up()
    {
        // First, check if the column exists
        $hasColumn = false;
        $columns = Schema::getColumnListing('users');
        if (in_array('is_admin', $columns)) {
            $hasColumn = true;
        }

        // If the column doesn't exist, add it
        if (!$hasColumn) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('is_admin')->default(false)->after('password');
            });
        }
    }

    public function down()
    {
        // Only drop the column if it exists
        $columns = Schema::getColumnListing('users');
        if (in_array('is_admin', $columns)) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('is_admin');
            });
        }
    }
}