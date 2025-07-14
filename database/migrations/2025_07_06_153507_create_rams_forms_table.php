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
        Schema::create('rams_forms', function (Blueprint $table) {
            $table->id();
            $table->string('phone_no')->nullable();
            $table->string('email_form')->nullable();
            $table->string('club_name')->nullable();
            $table->string('person_name')->nullable();
            $table->date('today_date')->nullable();
            $table->string('activity_type')->nullable();
            $table->date('activity_date')->nullable();
            $table->string('activity_objective')->nullable();
            $table->text('cause_people')->nullable();
            $table->text('cause_equipment')->nullable();
            $table->text('cause_environment')->nullable();
            $table->text('manage_operation_people')->nullable();
            $table->text('manage_operation_equipment')->nullable();
            $table->text('manage_operation_environment')->nullable();
            $table->text('manage_emergency')->nullable();
            $table->text('relevant_standards')->nullable();
            $table->text('policies_guidelines')->nullable();
            $table->text('staff_skills')->nullable();
            $table->enum('decision', ['accept', 'reject'])->nullable();
            $table->string('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rams_forms');
    }
};