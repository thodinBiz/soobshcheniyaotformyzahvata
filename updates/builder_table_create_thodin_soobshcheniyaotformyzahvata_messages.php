<?php namespace Thodin\SoobshcheniyaOtFormyZahvata\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateThodinSoobshcheniyaotformyzahvataMessages extends Migration
{
    public function up()
    {
        Schema::create('thodin_soobshcheniyaotformyzahvata_messages', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 250)->nullable();
            $table->string('email', 250)->nullable();
            $table->string('phone', 50);
            $table->text('message')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('thodin_soobshcheniyaotformyzahvata_messages');
    }
}
