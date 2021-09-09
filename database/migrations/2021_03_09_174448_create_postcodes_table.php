<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostcodesTable extends Migration
{
    public function up(): void
    {
        Schema::create('postcodes', function (Blueprint $table) {
            $table->id();
            $table->string('postcode');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 10, 8);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('postcodes');
    }
}
