<?php namespace Yone\Matchscrim\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateYoneMatchscrimTeamMembership extends Migration
{
    public function up()
    {
        Schema::rename('yone_matchscrim_team_teams_members', 'yone_matchscrim_team_membership');
    }
    
    public function down()
    {
        Schema::rename('yone_matchscrim_team_membership', 'yone_matchscrim_team_teams_members');
    }
}
