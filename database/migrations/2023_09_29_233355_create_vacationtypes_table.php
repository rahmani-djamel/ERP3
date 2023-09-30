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
        Schema::create('vacationtypes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('is_reducable')->default(0);
            $table->timestamps();
        });

        Schema::table('annual_holidays', function (Blueprint $table) {
            // Add a new column 'branch_id' that references the 'id' column of the 'branches' table
            $table->foreign('vacationtype_id')->references('id')->on('vacationtypes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacationtypes');
    }
};
