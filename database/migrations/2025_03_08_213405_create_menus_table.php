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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('title_en')->nullable();
            $table->integer('parent_id');
            $table->longText('description')->nullable();
            $table->longText('description_en')->nullable();
            $table->string('image')->nullable();
            $table->string('image_banner')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('hit')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
