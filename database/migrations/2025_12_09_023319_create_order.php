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
        Schema::create('order_table', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                    ->constrained('user_table')
                    ->onDelete('cascade');
            $table->integer('number');
            $table->string('place');//場所参照。のちに変える
            $table->string('text');
            $table->integer('money');
            $table->timestamps();
            $table->integer('check') -> default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_table');
    }
};
