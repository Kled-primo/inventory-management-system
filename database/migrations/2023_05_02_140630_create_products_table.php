<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId("user_id")->constrained()->onDelete('cascade');
            $table->char('name');
            $table->char('slug');
            $table->char('code');
            //$table->integer('unit_id');
            $table->integer('producttype');
            //$table->string('product_barcode_symbology')->nullable();
            $table->integer('quantity');
            $table->char('unit_number')->comment('Unit Number')->nullable();
            $table->float('selling_price')->comment('Selling Price');
            $table->float('purchase_price')->comment('Purchase Price');
            $table->integer('quantity_alert');
            $table->text('notes')->nullable();
            $table->timestamp('manufacturing_date')->nullable();
            $table->timestamp('expiry_date')->nullable();
            $table->foreignIdFor(\App\Models\Category::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignIdFor(\App\Models\Unit::class)->constrained()
                ->nullable()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
