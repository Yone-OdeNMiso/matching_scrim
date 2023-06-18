<?php namespace Yone\Matchscrim\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateYoneMatchscrimScrims4 extends Migration
{
    public function up()
    {
        Schema::table('yone_matchscrim_scrims', function($table)
        {
            $table->boolean('is_asap')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('yone_matchscrim_scrims', function($table)
        {
            $table->dropColumn('is_asap');
        });
    }
}