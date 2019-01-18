<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titles', function (Blueprint $table) {
           $table->increments('TIT_CODE');
           $table->string('TIT_DESC')->nullable(false);
           $table->date('MODIFIED_ON')->nullable(true);
            $table->date('UPLOAD_ON')->nullable(true); 
            $table->string('USR_ID')->nullable(true); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('titles');
    }
}
