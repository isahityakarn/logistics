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
        Schema::create('logistics_load', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('users')->onDelete('set null');
      

            // Pickup Information
            $table->string('pickup_location');
            $table->string('pickup_phone')->nullable();
            $table->string('pickup_company')->nullable();
            $table->text('pickup_additional_info')->nullable();
            $table->decimal('pickup_latitude', 10, 8)->nullable();
            $table->decimal('pickup_longitude', 11, 8)->nullable();
            $table->dateTime('pickup_date_time_from')->nullable();
            $table->dateTime('pickup_date_time_to')->nullable();
             $table->string('pickup_info')->nullable();

            // Delivery Information
            $table->string('delivery_location');
            $table->string('delivery_phone')->nullable();
            $table->string('delivery_company')->nullable();
            $table->text('delivery_additional_info')->nullable();
            $table->decimal('delivery_latitude', 10, 8)->nullable();
            $table->decimal('delivery_longitude', 11, 8)->nullable();
            $table->dateTime('delivery_date_time_from')->nullable();
            $table->dateTime('delivery_date_time_to')->nullable();
            $table->string('delivery_info')->nullable();

            // Job Details
            $table->string('job_description')->nullable();
            $table->string('suggested_vehicle')->nullable();
            $table->string('packaging')->nullable();
            $table->integer('no_of_items')->default(1);
            $table->decimal('gross_weight', 8, 2)->nullable();
           $table->enum('weight_unit', ['kg', 'lbs', 'tons'])->default('kg');
            $table->string('body_type')->nullable();
            $table->enum('job_type', ['pickup_delivery', 'courier', 'freight', 'moving', 'other'])->default('pickup_delivery');


    
            // Package Information
       
            
            $table->decimal('length', 8, 2)->nullable();
            $table->decimal('width', 8, 2)->nullable();
            $table->decimal('height', 8, 2)->nullable();
            $table->enum('dimension_unit', ['cm', 'inches', 'meters', 'feet'])->default('cm');
          


            // Additional Information
            $table->text('notes')->nullable();
            $table->string('document_name')->nullable();
            $table->string('upload_document')->nullable(); // File path
            
            // Distance and Pricing
          
            $table->decimal('distance_km', 8, 2)->nullable();
            $table->decimal('distance_miles', 8, 2)->nullable();
            $table->decimal('rate_per_km', 8, 2)->nullable();
            $table->decimal('rate_per_mile', 8, 2)->nullable();
            $table->enum('currency', ['USD', 'EUR', 'GBP', 'INR', 'CAD', 'AUD'])->default('INR');
            
            // Status and Tracking
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
            
            // Timestamps for job lifecycle
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('logistics_load');
        Schema::enableForeignKeyConstraints();
    }
};
