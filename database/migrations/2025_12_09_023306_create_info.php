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
        Schema::create('info_table', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                    ->constrained('user_table')
                    ->onDelete('cascade');
            $table->integer('number');
            $table->string('place');//場所参照。のちに変える
            $table->string('text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_table');
    }
};
