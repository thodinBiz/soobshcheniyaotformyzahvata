<?php namespace Thodin\SoobshcheniyaOtFormyZahvata\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThodinSoobshcheniyaotformyzahvataMessages2 extends Migration
{
    public function up()
    {
        Schema::table('thodin_soobshcheniyaotformyzahvata_messages', function($table)
        {
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('thodin_soobshcheniyaotformyzahvata_messages', function($table)
        {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
}
