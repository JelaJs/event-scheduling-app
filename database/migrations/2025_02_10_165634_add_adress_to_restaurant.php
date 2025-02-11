<?php

use App\Models\Restaurants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(Restaurants::TABLE, function (Blueprint $table) {
            $table->string('address');
        });
    }


    public function down(): void
    {
        Schema::table('restaurant', function (Blueprint $table) {
            //
        });
    }
};
