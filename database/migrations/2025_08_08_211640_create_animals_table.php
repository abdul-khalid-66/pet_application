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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('animal_categories');
            $table->string('name');
            $table->integer('age');
            $table->date('date_of_birth')->nullable();
            $table->string('color');
            $table->decimal('weight', 8, 2);
            $table->decimal('height', 8, 2)->nullable();
            $table->enum('gender', ['male', 'female', 'other']);
            $table->text('health_info')->nullable();
            $table->text('feed_details')->nullable();
            $table->string('location');
            $table->decimal('price', 10, 2);
            $table->enum('sale_type', ['fixed', 'auction', 'group']);
            $table->enum('status', ['available', 'sold', 'not_for_sale', 'expired'])->default('available');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
