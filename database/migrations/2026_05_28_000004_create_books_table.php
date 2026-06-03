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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('cover_image')->nullable();
            $table->string('title');
            $table->string('author');
            $table->unsignedBigInteger('publisher_id');
            $table->year('publish_year');
            $table->string('language');
            $table->string('location');
            $table->unsignedBigInteger('category_id');
            $table->string('call_number');
            $table->string('isbn');
            $table->string('pages');
            $table->string('description')->nullable();
            $table->string('edition')->nullable();
            $table->string('stock');

            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
