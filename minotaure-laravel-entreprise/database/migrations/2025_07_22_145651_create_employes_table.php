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
        Schema::create('employes', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->date('hiring_date');
            $table->decimal('salary', 10, 2);
            $table->foreignId('service_id')->constrained()->onDelete('cascade'); // clé étrangère qui se réfère à la table services sur la clé primaire id de cette table
            // ->onDelete('cascade') si on supprime un service, les employes de ce service seront aussi supprimés (CASCADE | SET NULL | RESTRICT | NO ACTION)

            // on peut préciser nous même la colonne liée pour la clé étrangère, dans ce cas on précise le nom de la table concernée dans constrained() 
            // $table->foreignId('service_secondaire_id')->constrained('services')->onDelete('cascade'); 

            $table->string('photo')->nullable(); // l'image n'est pas obligatoire : null possible

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
