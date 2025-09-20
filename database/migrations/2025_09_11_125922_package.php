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
        //
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_name');
            $table->text('package_image')->nullable();
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->text('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('package_id')->constrained('packages')->onDelete('cascade');
        $table->string('user_id')->constrained('')->onDelete('cascade');
        $table->date('booking_date');
        $table->time('booking_time');
        $table->string('queue_number')->nullable();
        $table->string('status')->default('pending'); // pending, confirmed, completed
        $table->timestamps();
        $table->softDeletes();
        });

        Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
        $table->enum('payment_method', ['cash', 'bank_transfer']);
        $table->decimal('amount', 10, 2);
        $table->text('payment_proof')->nullable();
        $table->timestamps();
        $table->softDeletes();
        });

        Schema::create('user_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->text('photo_profile')->nullable();
        $table->string('address')->nullable();
        $table->string('kecamatan')->nullable();
        $table->string('kabupaten')->nullable();
        $table->string('provinsi')->nullable();
        $table->string('phone_number')->nullable();
        $table->string('post_code')->nullable();

        $table->timestamps();
        $table->softDeletes();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('packages');
    }
};
