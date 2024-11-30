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
<<<<<<< HEAD
                $table->id();
                $table->string('nombre'); 
                $table->unsignedBigInteger('provincia_id'); 
                $table->foreign('provincia_id')
                    ->references('id')->on('provincias')
                    ->onDelete('cascade');
                $table->timestamps();
            });
           
=======
            $table->id();
            $table->string('nombre'); 
            $table->unsignedBigInteger('provincia_id'); 
            $table->foreign('provincia_id')->references('id')->on('provincias')->onDelete('cascade');
            $table->timestamps();
        });
>>>>>>> a233445eff40c05cc9328415eef16d125d15a853
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
<<<<<<< HEAD
    {       
            Schema::dropIfExists('cantons');
=======
    {
        Schema::dropIfExists('cantons');
>>>>>>> a233445eff40c05cc9328415eef16d125d15a853
    }
};
