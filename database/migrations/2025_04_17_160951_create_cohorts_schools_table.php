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
        Schema::create('cohorts_schools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cohort_id')->constrained('cohorts', 'id');
            $table->foreignId('teacher_id')->constrained('users_schools', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cohorts_schools');
    }
};
