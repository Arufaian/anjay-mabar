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
        Schema::create('moora_calculation_matrices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('moora_calculation_id')->constrained('moora_calculations')->onDelete('cascade');
            $table->foreignId('alternative_id')->constrained('alternatives')->onDelete('cascade');
            $table->foreignId('criteria_id')->constrained('criteria')->onDelete('cascade');
            $table->decimal('raw_value', 20, 6);
            $table->decimal('normalized_value', 20, 10);
            $table->decimal('weighted_value', 20, 10);
            $table->enum('criteria_type', ['benefit', 'cost']);
            $table->decimal('weight_used', 8, 6);
            $table->timestamps();
            $table->unique(['moora_calculation_id', 'alternative_id', 'criteria_id'], 'moora_calc_matrix_unique');
            $table->index('moora_calculation_id');
            $table->index('alternative_id');
            $table->index('criteria_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moora_calculation_matrices');
    }
};
