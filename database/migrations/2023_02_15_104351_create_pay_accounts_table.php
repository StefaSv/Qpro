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
        Schema::create('pay_accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('dealerId');
            $table->integer('days');
            $table->integer('summ');
            $table->text('date_start');
            $table->text('date_finish');
            $table->boolean('is_payd');
            $table->boolean('is_start');
            $table->boolean('is_over');
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
        Schema::dropIfExists('pay_accounts');
    }
};
