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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('unit_number'); // Unit number or name
            $table->string('building')->nullable();
            $table->integer('floor');
            $table->string('view')->nullable(); // e.g., 'Sea View', 'Garden View', 'City View'
            $table->decimal('area', 8, 2); // Area in square meters
            $table->decimal('price', 12, 2); // Price
            $table->enum('status', ['available', 'reserved', 'sold'])->default('available');
            $table->timestamps();
            
            // Ensure unique unit number within the same project
            $table->unique(['project_id', 'unit_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
