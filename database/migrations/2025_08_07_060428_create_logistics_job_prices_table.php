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
        Schema::create('load_price', function (Blueprint $table) {
            $table->id();
            $table->foreignId('logisticjob_id')->constrained('logistics_jobs')->onDelete('cascade');
            $table->foreignId('driver_id')->constrained('users')->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->enum('status', [
                'pending', 
                'assigned', 
                'in_progress', 
                'picked_up', 
                'in_transit', 
                'delivered', 
                'completed', 
                'cancelled'
            ])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('load_price');
    }
};
