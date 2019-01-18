<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCtrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ctrls', function (Blueprint $table) {
            $table->string('ORG_NAME')->nullable(false);
            $table->string('SERVER_IP_ADD')->nullable(true);
            $table->string('DATABASE_USERID')->nullable(true);
            $table->string('DATABASE_USERPASS')->nullable(true);
            $table->string('VIRTUAL_DIR')->nullable(true);
            $table->integer('LAST_ACCESS_NO')->nullable(true);
            $table->string('FORMS_ROOT')->nullable(true);
            $table->date('MODIFIED_ON')->nullable(true);
            $table->date('UPLOAD_ON')->nullable(true); 
            $table->string('USR_ID')->nullable(true);  
            $table->primary('ORG_NAME');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ctrls');
    }
}
