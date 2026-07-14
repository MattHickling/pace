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
        Schema::create('runner_preferences', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->json('available_training_days')
                ->nullable();

            $table->string('preferred_long_run_day')
                ->nullable();

            $table->string('preferred_run_time')
                ->nullable();

            $table->decimal('maximum_weekly_hours', 5, 2)
                ->nullable();

            $table->string('preferred_units')
                ->default('km');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('runner_preferences');
    }
};
