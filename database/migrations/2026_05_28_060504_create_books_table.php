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
            $table->unsignedBigInteger('id_author');
            $table->unsignedBigInteger('id_publisher');
            $table->string('publish_year');
            $table->string('language');
            $table->string('location');
            $table->unsignedBigInteger('id_category');
            $table->string('call_number');
            $table->string('isbn');
            $table->string('pages');
            $table->string('description')->nullable();
            $table->string('edition')->nullable();
            $table->string('stock');

            $table->foreign('id_author')->references('id')->on('authors')->onDelete('cascade');
            $table->foreign('id_publisher')->references('id')->on('publishers')->onDelete('cascade');
            $table->foreign('id_category')->references('id')->on('categories')->onDelete('cascade');
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
