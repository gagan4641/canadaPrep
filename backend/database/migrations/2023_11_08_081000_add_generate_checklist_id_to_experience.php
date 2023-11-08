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
        Schema::table('experience', function (Blueprint $table) {
            $table->unsignedBigInteger('generate_checklist_id')->nullable(); // Add the generate_checklist_id field
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('experience', function (Blueprint $table) {
            $table->dropColumn('generate_checklist_id');
        });
    }
};
