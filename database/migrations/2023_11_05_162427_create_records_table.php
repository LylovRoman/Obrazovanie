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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained('reports')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('program');
            $table->string('category');
            $table->string('profession');
            $table->string('duration');
            $table->string('form');
            $table->integer('course')->nullable();
            $table->float('avg_score')->nullable();
            $table->integer('KCP')->nullable();
            $table->integer('students_all')->nullable()->virtualAs('COALESCE(students_federal, 0) + COALESCE(students_subject, 0) + COALESCE(students_paid, 0)'); //students_federal + students_subject + students_paid
            $table->integer('students_federal')->nullable();
            $table->integer('students_subject')->nullable();
            $table->integer('students_target')->nullable();
            $table->integer('students_paid')->nullable();
            $table->integer('students_foreigner')->nullable();
            $table->integer('students_orphan')->nullable();
            $table->integer('students_without_care')->nullable();
            $table->integer('need')->nullable();
            $table->integer('provided')->nullable();
            $table->integer('refused')->nullable();
            $table->integer('release')->nullable();
            $table->integer('GIA')->nullable();
            $table->integer('interim_certification')->nullable();
            $table->integer('basic_level')->nullable();
            $table->integer('professional_level')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'report_id', 'profession']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
