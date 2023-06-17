<?php namespace Yone\Matchscrim\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateYoneMatchscrimTeamMembers2 extends Migration
{
    public function up()
    {
        Schema::table('yone_matchscrim_team_members', function($table)
        {
            $table->renameColumn('user_id', 'member_id');
        });
    }
    
    public function down()
    {
        Schema::table('yone_matchscrim_team_members', function($table)
        {
            $table->renameColumn('member_id', 'user_id');
        });
    }
}
