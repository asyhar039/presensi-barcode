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
        Schema::table('attendance_sessions', function (Blueprint $table) {
            // make subject_id and class_id nullable
            $table->unsignedBigInteger('subject_id')->nullable()->change();
            $table->unsignedBigInteger('class_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance_sessions', function (Blueprint $table) {
            // revert to not nullable
            $table->unsignedBigInteger('subject_id')->nullable(false)->change();
            $table->unsignedBigInteger('class_id')->nullable(false)->change();
        });
    }
};
