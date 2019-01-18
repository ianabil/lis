<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publishes', function (Blueprint $table) {
            $table->string('PUBCODE')->nullable(false);
            $table->string('PUBNAME')->nullable(false);
            $table->string('PUBADD')->nullable(true);
            $table->date('MODIFIED_ON')->nullable(true);
            $table->date('UPLOAD_ON')->nullable(true); 
            $table->string('USR_ID')->nullable(true);  
            $table->primary('PUBCODE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publishes');
    }
}
