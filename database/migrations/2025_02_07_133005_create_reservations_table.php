<?php

use App\Models\Reservations;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create(Reservations::TABLE, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurant_id');
            $table->unsignedBigInteger('band_id');
            $table->unsignedBigInteger('customer_id');
            $table->date('reservation_date');
            $table->string('restaurant_status')->default(Reservations::PENDING_STATUS);
            $table->string('band_status')->default(Reservations::PENDING_STATUS);
            $table->timestamps();

            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->foreign('band_id')->references('id')->on('bands')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
