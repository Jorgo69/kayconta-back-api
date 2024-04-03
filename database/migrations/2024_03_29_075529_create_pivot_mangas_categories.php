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
        Schema::create('pivot_mangas_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manga_id');
                $table->foreign('manga_id')
                        ->references('id')
                        ->on('mangas')
                        ->onDelete('cascade');
            $table->unsignedBigInteger('categorie_id');
                $table->foreign('categorie_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_mangas_categories');
    }
};
