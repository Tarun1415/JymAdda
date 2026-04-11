<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('gyms', function (Blueprint $table) {

            $table->id();

            $table->uuid('uuid')->unique();

            // Partner relation (IMPORTANT CHANGE)
            $table->unsignedBigInteger('partner_id');

            $table->string('gym_name');
            $table->string('slug')->unique();

            $table->string('owner_name')->nullable();
            $table->string('mobile', 15)->nullable();
            $table->string('email')->nullable();

            $table->enum('status', ['pending', 'active', 'rejected'])
                ->default('pending');

            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('pincode', 10)->nullable();

            $table->boolean('trainer_available')->default(false);
            $table->boolean('parking_available')->default(false);
            $table->boolean('ac_available')->default(false);

            $table->string('gym_image')->nullable();

            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->string('open_days', 100)->nullable();

            $table->decimal('rating', 2, 1)->default(0.0);
            $table->integer('total_reviews')->default(0);

            $table->timestamps();

            // Foreign key constraint
            $table->foreign('partner_id')
                ->references('partner_id')
                ->on('partners')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gyms');
    }
};
