<?php
// database/migrations/2025_09_10_000001_create_products_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('category')->nullable();
    $table->decimal('price', 10, 2)->default(0);
    $table->integer('stock_quantity')->default(0);
    $table->string('sizes')->nullable();     
    $table->string('color')->nullable();     
    $table->text('description')->nullable();
    $table->string('images')->nullable();    
    $table->boolean('status')->default(1);
    $table->timestamps();
});


    }

    public function down(): void {
        Schema::dropIfExists('products');
    }
};
