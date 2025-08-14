<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('seller_profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('creator_id')->nullable()->after('id');
        });
    }

    public function down()
    {
        Schema::table('seller_profiles', function (Blueprint $table) {
            $table->dropColumn('creator_id');
        });
    }
};
