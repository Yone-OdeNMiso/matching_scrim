<?php namespace Yone\Matchscrim\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateYoneMatchscrimTeamMembers3 extends Migration
{
    public function up()
    {
        Schema::table('yone_matchscrim_team_members', function($table)
        {
            $table->integer('user_id')->nullable()->unsigned();
        });
    }
    
    public function down()
    {
        Schema::table('yone_matchscrim_team_members', function($table)
        {
            $table->dropColumn('user_id');
        });
    }
}
