<?php namespace Yone\Matchscrim\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateYoneMatchscrimTeamMembers extends Migration
{
    public function up()
    {
        Schema::rename('yone_matchscrim_team_users', 'yone_matchscrim_team_members');
    }
    
    public function down()
    {
        Schema::rename('yone_matchscrim_team_members', 'yone_matchscrim_team_users');
    }
}
