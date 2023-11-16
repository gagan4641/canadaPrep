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
        Schema::table('qualification', function (Blueprint $table) {
            $table->unsignedBigInteger('document_group_id')->nullable()->after('status');
            $table->foreign('document_group_id')->references('id')->on('document_group')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('qualification', function (Blueprint $table) {
            $table->dropForeign(['document_group_id']);
            $table->dropColumn('document_group_id');
        });
    }
};
