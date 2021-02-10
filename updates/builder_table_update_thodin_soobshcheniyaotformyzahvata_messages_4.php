<?php namespace Thodin\SoobshcheniyaOtFormyZahvata\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThodinSoobshcheniyaotformyzahvataMessages4 extends Migration
{
    public function up()
    {
        Schema::table('thodin_soobshcheniyaotformyzahvata_messages', function($table)
        {
            $table->text('url')->nullable();
            $table->text('element')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('thodin_soobshcheniyaotformyzahvata_messages', function($table)
        {
            $table->dropColumn('url');
            $table->dropColumn('element');
        });
    }
}
