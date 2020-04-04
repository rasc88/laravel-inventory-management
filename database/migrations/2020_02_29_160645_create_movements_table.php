<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movements', function (Blueprint $table) {
            $table->bigIncrements('id')->unique()->index()->autoIncrement();
            $table->unsignedBigInteger('companies_id');
            $table->foreign('companies_id')->references('id')->on('companies');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
			$table->date('entry_date');
			$table->string('entry_quantity');
			$table->string('entry_unit');
			$table->string('invoice_number');
			$table->string('provider_name');
			$table->string('permission_number');
			$table->date('exit_date');
			$table->string('exit_quantity');
			$table->string('exit_unit');
			$table->text('observations');
			$table->unsignedBigInteger('superviser_id');
            $table->foreign('supervisor_id')->references('id')->on('supervisors');
            $table->text('balance');
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
        Schema::dropIfExists('movements');
    }
}
