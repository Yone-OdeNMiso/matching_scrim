<?php namespace Yone\Matchscrim\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateYoneMatchscrimScrims2 extends Migration
{
    public function up()
    {
        Schema::table('yone_matchscrim_scrims', function($table)
        {
            $table->renameColumn('scrim_date', 'start_date');
        });
    }
    
    public function down()
    {
        Schema::table('yone_matchscrim_scrims', function($table)
        {
            $table->renameColumn('start_date', 'scrim_date');
        });
    }
}
