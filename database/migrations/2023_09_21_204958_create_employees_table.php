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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('email')->unique();
            $table->string('CarteNumber');
            $table->string('JobNumber');
            $table->string('Nationality');
            $table->string('Gender');
            $table->date('DateOfBirth');
            $table->date('Start_work');
            $table->date('End');
            $table->string('Phone');
            $table->integer('VacationDays');
            $table->string('ContratType');
            $table->string('Rating');
            $table->string('Status');
            $table->string('FriendName')->nullable();
            $table->string('FriendPhone')->nullable();
            $table->string('InsuranceClass')->nullable();
            $table->date('InsuranceExpiryDate')->nullable();
            $table->string('BankName')->nullable();
            $table->string('BankNumber')->nullable();
            $table->string('BasicSalary');
            $table->string('OtherAllowances'); //
            $table->string('InsuranceRatio'); //
            $table->string('InsuranceSubscriptionAmount'); 
            $table->string('HousingAllowance');  //
            $table->string('transportationAllowance');
            $table->string('VacationSalary');
            $table->string('DurationOfTheWarningPeriod');
            $table->string('LoanHistory')->nullable();
            $table->string('CovenantRecord')->nullable();
            $table->integer('is_adminstaror')->default(0);

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
