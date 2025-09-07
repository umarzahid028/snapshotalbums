<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubscriptionFieldsToUsersTable extends Migration
{
    
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('plan')->nullable();
        $table->boolean('subscription_active')->default(false);
        $table->timestamp('trial_ends_at')->nullable();
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['plan', 'subscription_active', 'trial_ends_at']);
    });
}


}
