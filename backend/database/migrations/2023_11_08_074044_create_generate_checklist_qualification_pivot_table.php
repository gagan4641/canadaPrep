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
        Schema::create('generate_checklist_qualification', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('generate_checklist_id');
            $table->unsignedBigInteger('qualification_id');
            $table->year('completion_year');
            $table->timestamps();

            $table->foreign('generate_checklist_id')->references('id')->on('generate_checklist')->onDelete('cascade');
            $table->foreign('qualification_id')->references('id')->on('qualification')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generate_checklist_qualification');
    }
};
