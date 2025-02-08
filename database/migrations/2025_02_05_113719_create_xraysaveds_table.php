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
        Schema::create('xraysaveds', function (Blueprint $table) {
            $table->id();
            $table->string('operatorName');
            $table->dateTime('testDateTime');
            $table->string('location');
            $table->string('deviceInfo');
            $table->string('certificateInfo');
            $table->boolean('terpenuhi')->default(false);
            $table->boolean('tidakterpenuhi')->default(false);

            // Generator Atas/Bawah
            $table->boolean('test2aab')->default(false);
            $table->boolean('test2bab')->default(false);
            $table->boolean('test3ab_14')->default(false);
            $table->boolean('test3ab_16')->default(false);
            $table->boolean('test3ab_18')->default(false);
            $table->boolean('test3ab_20')->default(false);
            $table->boolean('test3ab_22')->default(false);
            $table->boolean('test3ab_24')->default(false);
            $table->boolean('test3ab_26')->default(false);
            $table->boolean('test3ab_28')->default(false);
            $table->boolean('test3ab_30')->default(false);

            // Test 1a dan 1b Atas/Bawah
            $table->boolean('test1aab_36')->default(false);
            $table->boolean('test1aab_32')->default(false);
            $table->boolean('test1aab_30')->default(false);
            $table->boolean('test1aab_24')->default(false);
            $table->boolean('test1bab_36_1')->default(false);
            $table->boolean('test1bab_32_1')->default(false);
            $table->boolean('test1bab_30_1')->default(false);
            $table->boolean('test1bab_24_1')->default(false);
            $table->boolean('test1bab_36_2')->default(false);
            $table->boolean('test1bab_32_2')->default(false);
            $table->boolean('test1bab_30_2')->default(false);
            $table->boolean('test1bab_24_2')->default(false);
            $table->boolean('test1bab_36_3')->default(false);
            $table->boolean('test1bab_32_3')->default(false);
            $table->boolean('test1bab_30_3')->default(false);
            $table->boolean('test1bab_24_3')->default(false);

            // Test 4 Atas/Bawah
            $table->boolean('test4ab_h10mm')->default(false);
            $table->boolean('test4ab_v10mm')->default(false);
            $table->boolean('test4ab_h15mm')->default(false);
            $table->boolean('test4ab_v15mm')->default(false);
            $table->boolean('test4ab_h20mm')->default(false);
            $table->boolean('test4ab_v20mm')->default(false);

            // Test 5 Atas/Bawah
            $table->boolean('test5ab_05mm')->default(false);
            $table->boolean('test5ab_10mm')->default(false);
            $table->boolean('test5ab_15mm')->default(false);

            // Generator Bawah
            $table->boolean('test2ab')->default(false);
            $table->boolean('test2bb')->default(false);
            $table->boolean('test3b_14')->default(false);
            $table->boolean('test3b_16')->default(false);
            $table->boolean('test3b_18')->default(false);
            $table->boolean('test3b_20')->default(false);
            $table->boolean('test3b_22')->default(false);
            $table->boolean('test3b_24')->default(false);
            $table->boolean('test3b_26')->default(false);
            $table->boolean('test3b_28')->default(false);
            $table->boolean('test3b_30')->default(false);

            // Test 4 Bawah
            $table->boolean('test4b_h10mm')->default(false);
            $table->boolean('test4b_v10mm')->default(false);
            $table->boolean('test4b_h15mm')->default(false);
            $table->boolean('test4b_v15mm')->default(false);
            $table->boolean('test4b_h20mm')->default(false);
            $table->boolean('test4b_v20mm')->default(false);

            // Test 5 Bawah
            $table->boolean('test5b_05mm')->default(false);
            $table->boolean('test5b_10mm')->default(false);
            $table->boolean('test5b_15mm')->default(false);

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
        Schema::dropIfExists('xraysaveds');
    }
};
