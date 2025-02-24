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
        Schema::create('governments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->unsignedBigInteger('governmentTitle_id');
            $table->unsignedBigInteger('county_id');
            $table->string('description');
            $table->string('description_en')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->foreign('governmentTitle_id')->references('id')->on('government_titles');
            $table->foreign('county_id')->references('id')->on('counties');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('governments');
    }
};
