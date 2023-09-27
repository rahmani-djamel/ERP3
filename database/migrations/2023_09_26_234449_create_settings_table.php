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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->integer('DaysMonth');
            $table->integer('MinVacationDays');
            $table->string('Nationality');
            $table->string('VacationDay');
            $table->integer('ValidityOfAnnualLeave');
            $table->integer('Guarantee');
            $table->integer('WillPay');
            $table->integer('MaximumVacationEmployees');
            $table->date('PathCreated');
            $table->integer('AutomaticDeduction');
            $table->integer('PeriodBetweenTwoVacations');
            $table->integer('SubmittingLeave');
            $table->integer('AutomaticApproval');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
