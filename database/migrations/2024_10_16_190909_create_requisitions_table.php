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
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('space_id');  //? Relación con los espacios
            $table->foreign('space_id')
                    ->references('id')
                    ->on('spaces')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('estate_id')->nullable();  //? Relación con los Bienes
            $table->foreign('estate_id')
                    ->references('id')
                    ->on('estates')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('service_id')->nullable();  //? Relación con los servicios
            $table->foreign('service_id')
                    ->references('id')
                    ->on('services')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->text('Num requisitions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitions');
    }
};
