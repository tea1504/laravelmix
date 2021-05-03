<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('table_id');
            $table->date('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('is_paid')->default(false);
            $table->time('check_in')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->time('check_out')->nullable();
            $table->timestamps();

            $table->foreign('staff_id')->references('id')->on('staff');
            $table->foreign('table_id')->references('id')->on('tables');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
