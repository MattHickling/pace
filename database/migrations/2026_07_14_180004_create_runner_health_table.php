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
        Schema::create('runner_health', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->integer('resting_heart_rate')
                ->nullable();

            $table->text('injury_history')
                ->nullable();

            $table->text('current_injury')
                ->nullable();

            $table->decimal('average_sleep_hours', 4, 2)
                ->nullable();

            $table->integer('stress_level')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('runner_health');
    }
};
