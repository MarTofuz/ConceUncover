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
        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->integer('comment_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tienda_id')->nullable();
            $table->unsignedBigInteger('sucursal_id')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tienda_id')->references('id')->on('tiendas')->onDelete('cascade');
            $table->foreign('sucursal_id')->references('id')->on('sucursales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment');
    }
};
