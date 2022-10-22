<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('landlord_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->string('description');
            $table->string('foreign_url');
            $table->foreignId('city_id')->constrained();
            $table->string('road');
            $table->string('building_number')->nullable();
            $table->string('apartment_number')->nullable();
            $table->decimal('longitude', 9, 6, false)->nullable();
            $table->decimal('latitude', 9, 6, false)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
