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
        Schema::create('player_forms', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('no_ic', 12);
            $table->string('no_fon', 12);
            $table->integer('score')->nullable();
            $table->string('resit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_forms');
    }
};
