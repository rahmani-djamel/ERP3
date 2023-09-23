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
        Schema::create('worktimes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('vacation_id');
            $table->string('weekday'); // e.g., Monday, Tuesday, etc.
            $table->time('work_start'); // Work start time for the weekday
            $table->time('work_end');   // Work end time for the weekday
            $table->boolean('is_vacation')->default(false); // Indicates if
            $table->integer('is_changed')->default(0);


            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('vacation_id')->references('id')->on('vacations')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worktimes');
    }
};
