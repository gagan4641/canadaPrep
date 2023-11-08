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
        Schema::create('children_document', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id');
            // Add any other fields you need here

            // Define foreign key constraints
            $table->foreign('document_id')->references('id')->on('document')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children_document');
    }
};
