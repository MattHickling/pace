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
        Schema::create('runs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('strava_account_id')
                    ->nullable()
                    ->constrained('strava_accounts')
                    ->nullOnDelete();
            $table->date('date');
            $table->string('type');
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('target_distance', 8, 2)->nullable();
            $table->decimal('target_pace', 8, 2)->nullable();
            $table->integer('target_duration_seconds')->nullable();
            $table->boolean('completed')
                ->default(false);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('runs');
    }
};
