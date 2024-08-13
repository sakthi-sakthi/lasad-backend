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
        Schema::create('vocations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('stdClass');
            $table->string('schoolName');
            $table->string('villageName');
            $table->string('fatherName');
            $table->string('motherName');
            $table->string('numberOfSisters')->nullable();
            $table->string('numberOfBrothers')->nullable();
            $table->string('district');
            $table->string('diocese');
            $table->string('state');
            $table->string('cellNumber');
            $table->longText('homeAddress');
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
        Schema::dropIfExists('vocations');
    }
};
