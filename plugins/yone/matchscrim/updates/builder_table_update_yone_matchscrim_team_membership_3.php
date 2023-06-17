<?php namespace Yone\Matchscrim\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateYoneMatchscrimTeamMembership3 extends Migration
{
    public function up()
    {
        Schema::table('yone_matchscrim_team_membership', function($table)
        {
            $table->renameColumn('member_id', 'team_id');
        });
    }
    
    public function down()
    {
        Schema::table('yone_matchscrim_team_membership', function($table)
        {
            $table->renameColumn('team_id', 'member_id');
        });
    }
}
