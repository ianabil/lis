<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irs', function (Blueprint $table) {
            $table->integer('USERNO')->nullable(false);
            $table->integer('ACCESSNO')->nullable(false);
            $table->string('REC_FLAG')->nullable(true);
            $table->date('DTREQ')->nullable(true);
            $table->date('DTISS')->nullable(false);
            $table->date('DTREC')->nullable(true);
            $table->date('MODIFIED_ON')->nullable(true);
            $table->date('UPLOAD_ON')->nullable(true); 
            $table->string('USR_ID')->nullable(true);  
            $table->primary(['USERNO','ACCESSNO','DTISS']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('irs');
    }
}
