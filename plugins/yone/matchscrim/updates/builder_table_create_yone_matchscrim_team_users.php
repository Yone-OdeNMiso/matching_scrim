<?php namespace Yone\Matchscrim\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateYoneMatchscrimTeamUsers extends Migration
{
    public function up()
    {
        Schema::create('yone_matchscrim_team_users', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('team_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('yone_matchscrim_team_users');
    }
}
