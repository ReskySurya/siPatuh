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
        Schema::create('hhmdsaveds', function (Blueprint $table) {
            $table->id();
            $table->string('operatorName');
            $table->dateTime('testDateTime');
            $table->string('location');
            $table->string('deviceInfo');
            $table->string('certificateInfo');
            $table->boolean('terpenuhi')->default(true);
            $table->boolean('tidakterpenuhi')->default(false);
            $table->boolean('test1')->default(false);
            $table->boolean('test2')->default(false);
            $table->boolean('test3')->default(false);
            $table->boolean('testCondition1')->default(true);
            $table->boolean('testCondition2')->default(true);
            $table->enum('result', ['pass', 'fail'])->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['pending_supervisor', 'approved', 'rejected'])->default('pending_supervisor');
            $table->unsignedBigInteger('submitted_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hhmdsaveds');
    }
};
