<?php namespace Yone\Matchscrim\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateYoneMatchscrimScrims3 extends Migration
{
    public function up()
    {
        Schema::table('yone_matchscrim_scrims', function($table)
        {
            $table->renameColumn('start_date', 'start_at');
        });
    }
    
    public function down()
    {
        Schema::table('yone_matchscrim_scrims', function($table)
        {
            $table->renameColumn('start_at', 'start_date');
        });
    }
}
