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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
$table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Reference
            $table->unsignedBigInteger('product_id');
            

            // Snapshot of product details
            $table->string('product_name');
            $table->decimal('product_price', 10, 2);
            $table->string('product_image')->nullable();

            // Variations (JSON for multiple values)
            $table->json('selected_colors')->nullable();
            $table->json('selected_sizes')->nullable();

            // Quantity
            $table->integer('quantity')->default(1);

            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
