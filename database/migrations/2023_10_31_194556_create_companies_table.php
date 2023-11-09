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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('package_id');
            $table->integer('days');
            $table->integer('N_Of_Emps');
            $table->integer('N_Of_Adminstrative');
            $table->integer('N_branches');
            $table->integer('Testing_period')->default(0);


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');

            $table->timestamps();
        });

        
        Schema::table('employees', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id'); // Add the employee column
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade'); // Define the relationship
        });

        Schema::table('branches', function (Blueprint $table) {
           $table->unsignedBigInteger('company_id'); // Add the employee column
            $table->foreign('company_id')->references('id')->on('branches')->onDelete('cascade');
        });


        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
