<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('date_time');
            $table->integer('laps');
            $table->integer('checkpoints');
            $table->decimal('total_distance_km', 3, 1);
            $table->enum('status', ['Open Inscriptions', 'Closed Inscriptions', 'In Progress', 'Finished'])->default('Open Inscriptions');
            $table->text('description')->nullable();
            $table->dateTime('start_race', 3)->nullable();
            $table->dateTime('end_race', 3)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('races');
    }
};
