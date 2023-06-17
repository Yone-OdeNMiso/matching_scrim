<?php namespace Yone\Matchscrim\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteYoneMatchscrimTeamMembers extends Migration
{
    public function up()
    {
        Schema::dropIfExists('yone_matchscrim_team_members');
    }
    
    public function down()
    {
        Schema::create('yone_matchscrim_team_members', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 191);
            $table->string('in_game_id', 191);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('user_id')->nullable()->unsigned();
        });
    }
}
