<?php namespace Yone\Matchscrim\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateYoneMatchscrimScrims extends Migration
{
    public function up()
    {
        Schema::table('yone_matchscrim_scrims', function($table)
        {
            $table->dateTime('expire_in');
        });
    }
    
    public function down()
    {
        Schema::table('yone_matchscrim_scrims', function($table)
        {
            $table->dropColumn('expire_in');
        });
    }
}