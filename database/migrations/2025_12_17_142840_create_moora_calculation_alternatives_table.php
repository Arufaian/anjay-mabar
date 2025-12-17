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
        Schema::create('moora_calculation_alternatives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('moora_calculation_id')->constrained('moora_calculations')->onDelete('cascade');
            $table->foreignId('alternative_id')->constrained('alternatives')->onDelete('cascade');
            $table->decimal('final_score', 20, 10);
            $table->integer('final_rank');
            $table->decimal('benefit_sum', 20, 10);
            $table->decimal('cost_sum', 20, 10);
            $table->json('alternative_snapshot')->nullable();
            $table->timestamps();
            $table->unique(['moora_calculation_id', 'alternative_id'], 'moora_calc_alt_unique');
            $table->index('moora_calculation_id');
            $table->index('alternative_id');
            $table->index('final_rank');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moora_calculation_alternatives');
    }
};
