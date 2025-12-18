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
        Schema::create('moora_calculations', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('is_latest_save')->default(false);
            $table->boolean('is_user_saved')->default(false);
            $table->string('calculation_version', 50)->nullable();
            $table->enum('status', ['draft', 'completed', 'archived'])->default('draft');
            $table->integer('total_alternatives')->default(0);
            $table->integer('total_criteria')->default(0);
            $table->foreignId('best_alternative_id')->nullable()->constrained('alternatives')->onDelete('set null');
            $table->json('final_ranking')->nullable();
            $table->json('calculation_metadata')->nullable();
            $table->timestamps();
            $table->index(['user_id', 'is_user_saved']);
            $table->index('is_latest_save');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moora_calculations');
    }
};
