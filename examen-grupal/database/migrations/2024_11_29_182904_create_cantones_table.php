<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCantonesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cantons', function (Blueprint $table) {
                $table->id();
                $table->string('nombre_canton'); 
                $table->unsignedBigInteger('provincia_id'); 
                $table->foreign('provincia_id')
                    ->references('id')->on('provincias')
                    ->onDelete('cascade');
                $table->timestamps();
            });
           
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {       
            Schema::dropIfExists('cantons');
    }
};
