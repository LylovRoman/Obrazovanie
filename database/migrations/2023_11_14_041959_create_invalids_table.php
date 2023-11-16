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
        Schema::create('invalids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained('reports')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('program');
            $table->string('profession');
            $table->integer('students_all')->nullable()->virtualAs('COALESCE(OVZ, 0) + COALESCE(invalids, 0)'); //OVZ + invalids
            $table->integer('students_federal')->nullable();
            $table->integer('students_subject')->nullable();
            $table->integer('students_target')->nullable();
            $table->integer('students_paid')->nullable();
            $table->integer('OVZ')->nullable();
            $table->integer('invalids')->nullable();
            //vision
            $table->integer('vision_reception')->nullable();
            $table->integer('vision_quantity')->nullable();
            $table->integer('vision_release')->nullable();
            //hearing
            $table->integer('hearing_reception')->nullable();
            $table->integer('hearing_quantity')->nullable();
            $table->integer('hearing_release')->nullable();
            //musculoskeletal
            $table->integer('musculoskeletal_reception')->nullable();
            $table->integer('musculoskeletal_quantity')->nullable();
            $table->integer('musculoskeletal_release')->nullable();
            //other
            $table->integer('other_reception')->nullable();
            $table->integer('other_quantity')->nullable();
            $table->integer('other_release')->nullable();
            //hard
            $table->integer('hard_reception')->nullable();
            $table->integer('hard_quantity')->nullable();
            $table->integer('hard_release')->nullable();
            //intelligence
            $table->integer('intelligence_reception')->nullable();
            $table->integer('intelligence_quantity')->nullable();
            $table->integer('intelligence_release')->nullable();

            $table->timestamps();

            $table->unique(['user_id', 'report_id', 'profession']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invalids');
    }
};
