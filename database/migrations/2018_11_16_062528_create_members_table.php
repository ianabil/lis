<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->integer('USERNO')->nullable(false);
            $table->string('USNAME')->nullable(false);
            $table->string('UFNAME')->nullable(false);
            $table->string('UDESIG')->nullable(true);
            $table->string('UPRADD1')->nullable(true);
            $table->string('UPRADD2')->nullable(true);
            $table->string('UPRADD3')->nullable(true);
            $table->string('UPEADD1')->nullable(true);
            $table->string('UPEADD2')->nullable(true);
            $table->string('UPEADD3')->nullable(true);
            $table->date('VALIDFR')->nullable(true);
            $table->date('VALIDTO')->nullable(true);
            $table->date('MODIFIED_ON')->nullable(true);
            $table->date('UPLOAD_ON')->nullable(true); 
            $table->string('USR_ID')->nullable(true);  
            $table->primary('USERNO');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
