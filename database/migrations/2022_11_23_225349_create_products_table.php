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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string('parent_sku')->nullable();
            $table->string("sku")->unique();
            $table->float("price")->default(0);
            $table->foreignId('category_id')
                ->constrained()
                ->references('id')
                ->onDelete('cascade')
                ->on('categories');

            $table->foreignId('supplier_id')
                ->constrained()
                ->references('id')
                ->onDelete('cascade')
                ->on('suppliers');

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
        Schema::dropIfExists('products');
    }
};
