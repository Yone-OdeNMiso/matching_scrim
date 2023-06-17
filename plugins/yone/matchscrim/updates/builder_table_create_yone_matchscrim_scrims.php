<?php namespace Yone\Matchscrim\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateYoneMatchscrimScrims extends Migration
{
    public function up()
    {
        Schema::create('yone_matchscrim_scrims', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->dateTime('scrim_date');
            $table->integer('recruiting_team_id')->unsigned();
            $table->integer('applied_team_id')->nullable()->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('yone_matchscrim_scrims');
    }
}
