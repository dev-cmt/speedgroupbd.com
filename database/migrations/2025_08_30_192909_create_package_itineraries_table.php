<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_itineraries', function (Blueprint $table) {
           $table->id();
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->integer('day_number'); // Day 1, Day 2
            $table->string('title');       // e.g. "Arrive In Zürich, Switzerland"
            $table->longText('description')->nullable(); // paragraph description
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
        Schema::dropIfExists('package_itineraries');
    }
};
