<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtendedProfileFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('bio')->nullable()->after('timezone');
            $table->string('website')->nullable()->after('bio');
            $table->string('address')->nullable()->after('website');
            $table->string('city')->nullable()->after('address');
            $table->string('state')->nullable()->after('city');
            $table->string('country')->nullable()->after('state');
            $table->string('postal_code')->nullable()->after('country');
            $table->string('linkedin')->nullable()->after('postal_code');
            $table->string('twitter')->nullable()->after('linkedin');
            $table->string('facebook')->nullable()->after('twitter');
            $table->string('instagram')->nullable()->after('facebook');
            $table->boolean('email_notifications')->default(true)->after('instagram');
            $table->boolean('security_alerts')->default(true)->after('email_notifications');
            $table->boolean('marketing_emails')->default(false)->after('security_alerts');
            $table->boolean('product_updates')->default(true)->after('marketing_emails');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'bio',
                'website',
                'address',
                'city',
                'state',
                'country',
                'postal_code',
                'linkedin',
                'twitter',
                'facebook',
                'instagram',
                'email_notifications',
                'security_alerts',
                'marketing_emails',
                'product_updates'
            ]);
        });
    }
}
