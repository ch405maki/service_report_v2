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
        Schema::table('machines', function (Blueprint $table) {
            $table->string('monitor')->nullable();
            $table->string('processor')->nullable();
            $table->string('motherboard')->nullable();
            $table->string('memory')->nullable();
            $table->string('drive')->nullable();
            $table->string('video_card')->nullable();
            $table->string('mac_address')->nullable();
            $table->string('ups')->nullable();
            $table->string('ms_office')->nullable();
            $table->string('operating_system')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('machines', function (Blueprint $table) {
            $table->dropColumn([
                'monitor',
                'processor',
                'motherboard',
                'memory',
                'drive',
                'video_card',
                'mac_address',
                'ups',
                'ms_office',
                'operating_system',
            ]);
        });
    }
};
