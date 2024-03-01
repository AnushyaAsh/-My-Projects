<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('addurl', function (Blueprint $table) {
            $table->id();
            $table->String('original_url');
            $table->String('shorterned_url');
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('addurl');
    }
};
