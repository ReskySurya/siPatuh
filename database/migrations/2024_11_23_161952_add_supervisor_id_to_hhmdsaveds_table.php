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
            // Tambahkan kolom dulu tanpa constraint
            $table->unsignedBigInteger('supervisor_id')->nullable()->after('submitted_by');
        });

        // Isi dengan default supervisor jika diperlukan
        // Misalnya supervisor pertama yang ada di database
        if (DB::table('hhmdsaveds')->count() > 0) {
            $defaultSupervisor = DB::table('users')
                ->where('role', 'supervisor')
                ->first();

            if ($defaultSupervisor) {
                DB::table('hhmdsaveds')
                    ->whereNull('supervisor_id')
                    ->update(['supervisor_id' => $defaultSupervisor->id]);
            }
        }

        // Baru tambahkan foreign key constraint
        Schema::table('hhmdsaveds', function (Blueprint $table) {
            $table->foreign('supervisor_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('hhmdsaveds', function (Blueprint $table) {
            $table->dropForeign(['supervisor_id']);
            $table->dropColumn('supervisor_id');
        });
    }
};
