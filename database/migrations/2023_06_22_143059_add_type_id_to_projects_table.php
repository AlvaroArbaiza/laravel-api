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
        Schema::table('projects', function (Blueprint $table) {

            // Aggiungiamo una colonna alla tabella('projects') chiamata "type_id" di tipo "unsignedBigInteger" che può essere nulla (nullable()) e viene posizionata dopo la colonna "id" (after('id')).
            $table->unsignedBigInteger('type_id')->nullable()->after('id');


            // Definiamo una relazione esterna (foreign) per la colonna "type_id" tramite il metodo references('id')->on('types')->onDelete('set null'). Questa relazione fa riferimento alla colonna "id" della tabella "types" stessa (references('id')->on('types')). L'opzione onDelete('set null') indica che se un progetto viene eliminato, il valore della colonna "type_id" verrà impostato su NULL.
            $table->foreign('type_id')->references('id')->on('types')->onDelete('set null');

            // OPPURE PER ABBREVIARE TUTTO POSSIAMO SCRIVERE
            // $table->foreignId('type_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    //  In caso di eliminazione delle modifiche del database, specifichiamo come eliminare le modifica apportate nella migrazione precendete, ovvero resetta tutto, altrimenti ci darebbe errore
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {

            // Il parametro 'projects_type_id_foreign' è il nome della chiave esterna che è stata assegnata a questa relazione. Utilizzando il metodo dropForeign(), si elimina la chiave esterna dalla tabella "projects" e quindi la relazione esterna
            $table->dropForeign('projects_type_id_foreign');

            // Con dropColumn('type_id') eliminiamo la colonna "type_id" dalla tabella "projects". 
            $table->dropColumn('type_id');
        });
    }
};
