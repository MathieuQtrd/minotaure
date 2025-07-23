<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); // la clé primaire de la table
            $table->string('name'); // le champ name="name"
            $table->string('email'); // le champ name="email"
            $table->string('message'); // le champ name="message"
            $table->timestamps(); // champs created_at et updated_at
        });

        // https://laravel.com/docs/12.x/migrations#creating-columns
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
