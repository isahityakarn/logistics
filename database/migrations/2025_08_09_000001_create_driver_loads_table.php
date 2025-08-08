<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
    Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('load_id');
            $table->unsignedBigInteger('driver_id');
            $table->decimal('price', 10, 2)->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('load_id')->references('id')->on('loads')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
    Schema::dropIfExists('bids');
    }
};
