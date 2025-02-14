<?php

use App\Models\BandImages;
use App\Models\Bands;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create(BandImages::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Bands::class)->constrained()->cascadeOnDelete();
            $table->string('image');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(BandImages::TABLE);
    }
};
