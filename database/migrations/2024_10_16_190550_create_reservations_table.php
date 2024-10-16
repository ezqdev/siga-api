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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  //? Relación con el usuario
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('space_id');  //? Relación con los espacios
            $table->foreign('space_id')
                    ->references('id')
                    ->on('spaces')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->date('reservation_date');   //? Fecha de reserva
            $table->date('start_date');   //? Fecha de En la que inicia la reunion
            $table->date('end_date');     //? Fecha de culminación de la reunion
            $table->time('start_time');  //? Hora de inicio
            $table->time('end_time');    //? Hora de fin
            $table->enum('status', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');  //? Estado de la reserva (e.g., pendiente, confirmada, cancelada)
            $table->text('reservation_details');  //? Detalles adicionales
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
