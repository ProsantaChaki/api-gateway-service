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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('transaction_summary_id')->unsigned();
            $table->decimal('amount', 10, 2)->comment('total balance');
            $table->bigInteger('sell_id')->unsigned()->nullable();
            $table->string('remark', 200)->nullable();
            $table->tinyInteger('is_halkhata')->comment('0:no, 1:yes')->default(0);
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('transaction_summary_id')->references('id')->on('transaction_summaries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_details');
    }
};
