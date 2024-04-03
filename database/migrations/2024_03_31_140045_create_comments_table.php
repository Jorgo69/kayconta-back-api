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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commentator_id')->nullable();
                $table->foreign('commentator_id')
                        ->references('id')
                        ->on('users')
                        ->onDelete('set null');
            $table->unsignedBigInteger('manga_id');
                $table->foreign('manga_id')
                        ->references('id')
                        ->on('mangas')
                        ->onDelete('cascade');
            $table->unsignedBigInteger('chapter_id');
                $table->foreign('chapter_id')
                        ->references('id')
                        ->on('chapters')
                        ->onDelete('cascade');
            $table->text('content');
            $table->boolean('actif')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
