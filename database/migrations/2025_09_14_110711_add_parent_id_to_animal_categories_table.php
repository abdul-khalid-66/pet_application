<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('animal_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable()->after('image');
            $table->integer('depth')->default(0)->after('parent_id');
            $table->foreign('parent_id')->references('id')->on('animal_categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('animal_categories', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
            $table->dropColumn('depth');
        });
    }
};
