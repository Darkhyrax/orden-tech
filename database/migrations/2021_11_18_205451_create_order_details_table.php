<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) 
        {
            $table->id();
            $table->foreignIdFor(App\Models\Articulo::class);
            $table->bigInteger('cantidad');
            $table->bigInteger('precio');
            $table->bigInteger('total');
            $table->foreignIdFor(App\Models\Order::class);
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
        Schema::dropIfExists('order_details');
    }
}
