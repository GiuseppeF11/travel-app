<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    /**
     * Esegui la migrazione.
     */
    public function up(): void
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('travel_id')->constrained()->onDelete('cascade'); // Collega la foto al viaggio
            $table->string('file_path'); // Percorso del file
            $table->string('description')->nullable(); // Descrizione opzionale
            $table->timestamps();
        });
    }

    /**
     * Inverti la migrazione.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
}
