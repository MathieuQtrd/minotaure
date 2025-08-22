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
        Schema::create('tasks', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['à faire', 'en cours', 'en validation', 'terminée'])->default('à faire');
            $table->enum('priority', ['faible', 'moyen', 'élevé', 'urgent', 'bloquant'])->default('moyen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
