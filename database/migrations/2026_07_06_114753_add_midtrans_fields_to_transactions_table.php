<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('midtrans_transaction_id')->nullable()->after('status');
            $table->string('midtrans_status')->nullable()->after('midtrans_transaction_id');
            $table->string('midtrans_payment_type')->nullable()->after('midtrans_status');
            $table->text('midtrans_raw_response')->nullable()->after('midtrans_payment_type');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn([
                'midtrans_transaction_id',
                'midtrans_status',
                'midtrans_payment_type',
                'midtrans_raw_response',
            ]);
        });
    }
};
