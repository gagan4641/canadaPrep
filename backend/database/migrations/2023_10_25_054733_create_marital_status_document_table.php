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
        Schema::create('marital_status_document', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marital_status_id');
            $table->unsignedBigInteger('document_id');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('marital_status_id')->references('id')->on('marital_status')->onDelete('cascade');
            $table->foreign('document_id')->references('id')->on('document')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marital_status_document');
    }
};
