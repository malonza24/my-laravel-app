<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('children', function (Blueprint $table) {
            $table->date('checkin_date')->nullable()->after('checkin_time');
            $table->date('checkout_date')->nullable()->after('checkout_time');
        });
    }

    public function down(): void
    {
        Schema::table('children', function (Blueprint $table) {
            $table->dropColumn(['checkin_date', 'checkout_date']);
        });
    }
};