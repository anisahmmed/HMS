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
        Schema::table('visits', function (Blueprint $table) {
            $table->string('ticket_number')->unique()->nullable();
            $table->decimal('fee_amount', 8, 2)->nullable();
            $table->boolean('fee_paid')->default(false);
            $table->time('visit_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            $table->dropColumn(['ticket_number', 'fee_amount', 'fee_paid', 'visit_time']);
        });
    }
};
