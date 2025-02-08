<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('xraysaveds', function (Blueprint $table) {
            // Test 1a dan 1b Bawah
            $table->boolean('test1ab_36')->default(false);
            $table->boolean('test1ab_32')->default(false);
            $table->boolean('test1ab_30')->default(false);
            $table->boolean('test1ab_24')->default(false);
            $table->boolean('test1bb_36_1')->default(false);
            $table->boolean('test1bb_32_1')->default(false);
            $table->boolean('test1bb_30_1')->default(false);
            $table->boolean('test1bb_24_1')->default(false);
            $table->boolean('test1bb_36_2')->default(false);
            $table->boolean('test1bb_32_2')->default(false);
            $table->boolean('test1bb_30_2')->default(false);
            $table->boolean('test1bb_24_2')->default(false);
            $table->boolean('test1bb_36_3')->default(false);
            $table->boolean('test1bb_32_3')->default(false);
            $table->boolean('test1bb_30_3')->default(false);
            $table->boolean('test1bb_24_3')->default(false);
        });
    }

    public function down()
    {
        Schema::table('xraysaveds', function (Blueprint $table) {
            $table->dropColumn([
                'test1ab_36', 'test1ab_32', 'test1ab_30', 'test1ab_24',
                'test1bb_36_1', 'test1bb_32_1', 'test1bb_30_1', 'test1bb_24_1',
                'test1bb_36_2', 'test1bb_32_2', 'test1bb_30_2', 'test1bb_24_2',
                'test1bb_36_3', 'test1bb_32_3', 'test1bb_30_3', 'test1bb_24_3'
            ]);
        });
    }
};
