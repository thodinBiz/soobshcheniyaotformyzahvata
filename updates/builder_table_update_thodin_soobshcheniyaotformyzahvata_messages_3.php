<?php namespace Thodin\SoobshcheniyaOtFormyZahvata\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThodinSoobshcheniyaotformyzahvataMessages3 extends Migration
{
    public function up()
    {
        Schema::table('thodin_soobshcheniyaotformyzahvata_messages', function($table)
        {
            $table->text('form');
        });
    }
    
    public function down()
    {
        Schema::table('thodin_soobshcheniyaotformyzahvata_messages', function($table)
        {
            $table->dropColumn('form');
        });
    }
}
