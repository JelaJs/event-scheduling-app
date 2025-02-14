<?php

use App\Models\Bands;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('band_images', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Bands::class)->constrained()->cascadeOnDelete();
            $table->string('image');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('band_images');
    }
};
