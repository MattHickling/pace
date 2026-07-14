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
        Schema::create('runner_pbs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();    
            $table->decimal('400m', total: 8, places: 2);
            $table->decimal('800m', total: 8, places: 2);
            $table->decimal('1k', total: 8, places: 2);
            $table->decimal('1mile', total: 8, places: 2);
            $table->decimal('5k', total: 8, places: 2);
            $table->decimal('10k', total: 8, places: 2);
            $table->decimal('half_marathon', total: 8, places: 2);
            $table->decimal('marathon', total: 8, places: 2);
            $table->decimal('ultra', total: 8, places: 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('runner_pbs');
    }
};
