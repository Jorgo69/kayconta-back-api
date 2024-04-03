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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('summary')->nullable();
            $table->text('cover');
            $table->string('slugChapter')->nullable();
            $table->string('number')->nullable();
            $table->boolean('actif')->default(false);
            $table->unsignedBigInteger('manga_id');
            $table->foreign('manga_id')
                    ->references('id')
                    ->on('mangas')
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
