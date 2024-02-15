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
        Schema::create('qualification_document', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('qualification_id');
            $table->unsignedBigInteger('document_id');
            $table->timestamps();
            $table->foreign('qualification_id')->references('id')->on('qualification')->onDelete('cascade');
            $table->foreign('document_id')->references('id')->on('document')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qualification_document');
    }
};
