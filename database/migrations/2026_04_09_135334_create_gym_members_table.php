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
        Schema::create('gym_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gym_id')->nullable();
            $table->unsignedBigInteger('partner_id')->nullable();
            $table->string('member_id')->unique()->nullable();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->text('address')->nullable();
            $table->string('adhar_no')->nullable();
            $table->string('plan_duration')->nullable(); // e.g., "1 Month", "3 Months"
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('total_fees', 10, 2)->default(0);
            $table->decimal('amount_paid', 10, 2)->default(0);
            $table->decimal('pending_amount', 10, 2)->default(0);
            $table->enum('status', ['active', 'expired', 'pending'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gym_members');
    }
};
