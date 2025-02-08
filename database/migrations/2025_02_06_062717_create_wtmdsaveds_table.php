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
        Schema::create('wtmdsaveds', function (Blueprint $table) {
            $table->id();
            $table->string('operatorName');
            $table->dateTime('testDateTime');
            $table->string('location');
            $table->string('deviceInfo');
            $table->string('certificateInfo');
            $table->boolean('terpenuhi')->default(false);
            $table->boolean('tidakterpenuhi')->default(false);

            // Test Depan
            $table->boolean('test1_in_depan')->default(false);
            $table->boolean('test1_out_depan')->default(false);
            $table->boolean('test2_in_depan')->default(false);
            $table->boolean('test2_out_depan')->default(false);
            $table->boolean('test4_in_depan')->default(false);
            $table->boolean('test4_out_depan')->default(false);

            // Test Belakang
            $table->boolean('test3_in_belakang')->default(false);
            $table->boolean('test3_out_belakang')->default(false);

            // Form fields
            $table->enum('result', ['pass', 'fail'])->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['pending_supervisor', 'approved', 'rejected'])->default('pending_supervisor');
            $table->foreignId('submitted_by')->nullable()->constrained('officers')->onDelete('set null');
            $table->string('officerName');
            $table->string('supervisorName')->nullable();
            $table->text('officer_signature')->nullable();
            $table->text('supervisor_signature')->nullable();
            $table->text('rejection_note')->nullable();
            $table->dateTime('reviewed_at')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('supervisor_id')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wtmdsaveds');
    }
};
