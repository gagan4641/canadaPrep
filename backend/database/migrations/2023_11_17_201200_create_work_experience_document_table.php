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
        Schema::create('work_experience_document', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id');
            $table->unsignedBigInteger('document_group_id');
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('document_id')->references('id')->on('document')->onDelete('cascade');
            $table->foreign('document_group_id')->references('id')->on('document_group')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_experience_document');
    }
};
