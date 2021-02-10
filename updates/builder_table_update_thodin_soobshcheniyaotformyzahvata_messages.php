<?php namespace Thodin\SoobshcheniyaOtFormyZahvata\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThodinSoobshcheniyaotformyzahvataMessages extends Migration
{
    public function up()
    {
        Schema::table('thodin_soobshcheniyaotformyzahvata_messages', function($table)
        {
            $table->text('utm')->nullable();
            $table->boolean('is_sanded')->default(false);
        });
    }
    
    public function down()
    {
        Schema::table('thodin_soobshcheniyaotformyzahvata_messages', function($table)
        {
            $table->dropColumn('utm');
            $table->dropColumn('is_sanded');
        });
    }
}
