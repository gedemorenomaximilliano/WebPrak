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
        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('pax_count')->default(1)->after('package_id');
            $table->string('payment_method')->nullable()->after('pax_count');
            $table->string('phone')->nullable()->after('payment_method');
            $table->string('first_name')->nullable()->after('phone');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('email')->nullable()->after('last_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['pax_count', 'payment_method', 'phone', 'first_name', 'last_name', 'email']);
        });
    }
};
