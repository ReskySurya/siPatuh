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
        Schema::table('hhmdsaveds', function (Blueprint $table) {
            $table->string('officerName')->nullable();
            $table->string('supervisorName')->nullable();
            $table->binary('officer_signature')->nullable();
            $table->binary('supervisor_signature')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hhmdsaveds', function (Blueprint $table) {
            $table->dropColumn(['officerName', 'supervisorName', 'officer_signature', 'supervisor_signature']);
        });
    }
};
