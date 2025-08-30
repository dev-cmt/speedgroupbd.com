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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('place_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('sale_price', 10, 2)->nullable(); // Added for discounted price
            $table->string('duration')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_featured')->default(false); // Added for featured badge
            $table->boolean('is_bestseller')->default(false); // Added for bestseller tag
            $table->integer('max_persons')->default(12); // Added for person count
            $table->integer('review_count')->default(1); // Added for review count
            $table->decimal('rating', 3, 1)->default(5.0); // Added for star rating
            $table->boolean('status')->default(true); 
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
        Schema::dropIfExists('tour_packages');
    }
};
