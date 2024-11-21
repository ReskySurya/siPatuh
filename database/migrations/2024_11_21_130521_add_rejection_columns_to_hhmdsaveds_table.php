<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('hhmdsaveds', function (Blueprint $table) {
            // Tambah kolom baru dulu
            $table->text('rejection_note')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->unsignedBigInteger('reviewed_by')->nullable();
        });

        // Tambah foreign key dalam statement terpisah
        Schema::table('hhmdsaveds', function (Blueprint $table) {
            $table->foreign('reviewed_by')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            // Pastikan data submitted_by valid sebelum menambah constraint
            DB::statement('DELETE FROM hhmdsaveds WHERE submitted_by NOT IN (SELECT id FROM officers)');

            $table->foreign('submitted_by')
                ->references('id')
                ->on('officers')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('hhmdsaveds', function (Blueprint $table) {
            $table->dropForeign(['reviewed_by']);
            $table->dropForeign(['submitted_by']);
            $table->dropColumn(['rejection_note', 'reviewed_at', 'reviewed_by']);
        });
    }
};
