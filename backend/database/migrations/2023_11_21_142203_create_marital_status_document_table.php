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
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('marital_status_id')->references('id')->on('marital_status');
            $table->foreign('document_id')->references('id')->on('document');
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
