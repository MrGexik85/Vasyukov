<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->integer('unit_id');
            $table->integer('order_id');
            $table->string('year', 45);
            $table->float('amount', 16, 5);
            $table->float('unitCost', 16, 2);
            $table->float('allCost', 16, 2);
            $table->longText('combinationContract'); 
            $table->string("purchaseMethod", 45);
            $table->string("purchaseDate", 45);
            $table->integer('CFO_id');
            $table->string("CPS", 45);
            $table->string("CEC", 45);
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
        Schema::dropIfExists('product');
    }
}
