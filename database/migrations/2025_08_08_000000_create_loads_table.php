<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->string('pickup_location');
            $table->string('pickup_phone');
            $table->string('pickup_company')->nullable();
            $table->text('pickup_additional_info')->nullable();
            $table->decimal('pickup_latitude', 10, 7)->nullable();
            $table->decimal('pickup_longitude', 10, 7)->nullable();
            $table->dateTime('pickup_date_time_from')->nullable();
            $table->dateTime('pickup_date_time_to')->nullable();
            $table->text('pickup_info')->nullable();
            $table->string('delivery_location');
            $table->string('delivery_phone');
            $table->string('delivery_company')->nullable();
            $table->text('delivery_additional_info')->nullable();
            $table->decimal('delivery_latitude', 10, 7)->nullable();
            $table->decimal('delivery_longitude', 10, 7)->nullable();
            $table->dateTime('delivery_date_time_from')->nullable();
            $table->dateTime('delivery_date_time_to')->nullable();
            $table->text('delivery_info')->nullable();
            $table->text('job_description')->nullable();
            $table->string('suggested_vehicle')->nullable();
            $table->string('packaging')->nullable();
            $table->integer('no_of_items')->nullable();
            $table->decimal('gross_weight', 10, 2)->nullable();
            $table->string('weight_unit')->nullable();
            $table->string('body_type')->nullable();
            $table->string('job_type')->nullable();
            $table->decimal('length', 10, 2)->nullable();
            $table->decimal('width', 10, 2)->nullable();
            $table->decimal('height', 10, 2)->nullable();
            $table->string('dimension_unit')->nullable();
            $table->text('notes')->nullable();
            $table->string('document_name')->nullable();
            $table->string('upload_document')->nullable();
            $table->decimal('distance_km', 10, 2)->nullable();
            $table->decimal('distance_miles', 10, 2)->nullable();
            $table->decimal('rate_per_km', 10, 2)->nullable();
            $table->decimal('rate_per_mile', 10, 2)->nullable();
            $table->string('currency')->nullable();
            $table->string('status')->default('pending');
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loads');
    }
};
