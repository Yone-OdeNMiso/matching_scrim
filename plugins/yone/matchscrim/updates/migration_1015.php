<?php namespace Yone\Matchscrim\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class Migration1015 extends Migration
{
    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->string('in_game_id');
        });
    }
    
    public function down()
    {
        Schema::table('users', function($table)
        {
            $table->dropColumn('in_game_id');
        });
    }
}