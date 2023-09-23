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
        Schema::create('vacations', function (Blueprint $table) {
            $table->id();
            $table->string('weekday'); // e.g., Monday, Tuesday, etc.
            $table->time('work_start'); // Work start time for the weekday
            $table->time('work_end');   // Work end time for the weekday
            $table->boolean('is_vacation')->default(false); // Indicates if
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacations');
    }
};
