<?php namespace Yone\Matchscrim\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateYoneMatchscrimTeamTeams extends Migration
{
    public function up()
    {
        Schema::rename('yone_matchscrim_teams', 'yone_matchscrim_team_teams');
    }
    
    public function down()
    {
        Schema::rename('yone_matchscrim_team_teams', 'yone_matchscrim_teams');
    }
}
