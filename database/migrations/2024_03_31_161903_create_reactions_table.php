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
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedBigInteger('reactor_id')->nullable();
                $table->foreign('reactor_id')
                        ->references('id')
                        ->on('users')
                        ->onDelete('set null');
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
        Schema::dropIfExists('reactions');
    }
};
