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
        Schema::table('user_qualification', function (Blueprint $table) {
            $table->year('completion_year')->after('qualification_id'); // Add the completion_year field
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_qualification', function (Blueprint $table) {
            $table->dropColumn('completion_year');
        });
    }
};
