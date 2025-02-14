<?php

use App\Models\Restaurants;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create(Restaurants::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('name', '128');
            $table->string('background_image')->nullable();
            $table->text('description');
            $table->string('instagram', 128)->nullable();
            $table->string('youtube', 128)->nullable();
            $table->string('phone_number', 64)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
