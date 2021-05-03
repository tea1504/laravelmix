<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->string('first_name', 30);
            $table->string('last_name', 20);
            $table->date('date_of_birth');
            $table->string('identity_card_number', 12);
            $table->string('phone_number', 10);
            $table->string('address', 100);
            $table->string('username', 50)->unique();
            $table->string('password', 100);
            $table->string('image', 100)->nullable();
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
