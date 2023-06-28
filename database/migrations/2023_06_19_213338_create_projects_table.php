<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50)->unique(); // titolo
            $table->text('description'); // descrizione
            $table->string('slug')->nullable(); // slug
            $table->string('customer', 50); // nome cliente
            $table->string('type_customer', 50); // tipo di cliente
            $table->decimal('price', 8, 2); // costo progetto
            $table->date('created'); // data creazione progetto
            $table->string('image')->nullable(); // Immagine
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
