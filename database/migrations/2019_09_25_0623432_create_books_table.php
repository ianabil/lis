<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->integer('ACCESSNO')->nullable(false);
            $table->string('LIBNO')->nullable(true);
            $table->integer('TIT_CODE')->nullable(true);
            $table->string('TITLE')->nullable(true);
            $table->text('CONTENT')->nullable(true);
            $table->string('TYPE')->nullable(false);
            $table->string('VOLNO')->nullable(true);
            $table->string('PARTNO')->nullable(true);
            $table->integer('EDENO')->nullable(true);
            $table->integer('YEAR')->nullable(true);
            $table->integer('YEAR1')->nullable(true);
            $table->integer('PAGE')->nullable(true);
            $table->double('PRICE',8,3)->nullable(true);
            $table->string('AUSNAME1')->nullable(true);
            $table->string('AUFNAME1')->nullable(true);
            $table->string('AUSNAME2')->nullable(true);
            $table->string('AUFNAME2')->nullable(true);
            $table->string('PUBCODE')->nullable(true);
            $table->string('EDINAME')->nullable(true);
            $table->date('DTPUR')->nullable(true);
            $table->string('SUB1')->nullable(true);
            $table->string('SUB2')->nullable(true);
            $table->integer('LOCNO')->nullable(true);
            $table->string('PLACE')->nullable(true);
            $table->string('ISSUE_FLAG')->nullable(true);
            $table->integer('COPY_NO')->nullable(true);
            $table->date('ENTRY_DATE')->nullable(true);
            $table->date('MODIFIED_ON')->nullable(true);
            $table->date('UPLOAD_ON')->nullable(true); 
            $table->string('USR_ID')->nullable(true);        
            $table->primary('ACCESSNO');
            $table->foreign('TIT_CODE')->references('TIT_CODE')->on('titles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
