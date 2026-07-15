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
        Schema::create('running_shoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete(); 
            $table->string('shoe_name');
            $table->string('shoe_type');
            $table->decimal('mileage', 8, 2)
                ->nullable();
            $table->integer('hours_spent_wearing')
                ->nullable();
            $table->decimal('target_miles', 8, 2)
                ->nullable();
            $table->string('status')
                ->default('active');
            $table->string('default_shoe')
                ->default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('running_shoes');
    }
};
