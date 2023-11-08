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
        Schema::table('generate_checklist', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('marital_status_id');

            $table->foreign('category_id')->references('id')->on('category');
            $table->foreign('country_id')->references('id')->on('country');
            $table->foreign('marital_status_id')->references('id')->on('marital_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('generate_checklist', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['country_id']);
            $table->dropForeign(['marital_status_id']);
            $table->dropColumn('category_id');
            $table->dropColumn('country_id');
            $table->dropColumn('marital_status_id');
        });
    }
};
