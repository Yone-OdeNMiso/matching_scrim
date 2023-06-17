<?php namespace Yone\Matchscrim\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateYoneMatchscrimTeamTeams2 extends Migration
{
    public function up()
    {
        Schema::table('yone_matchscrim_team_teams', function($table)
        {
            $table->string('nicename');
        });
    }
    
    public function down()
    {
        Schema::table('yone_matchscrim_team_teams', function($table)
        {
            $table->dropColumn('nicename');
        });
    }
}
