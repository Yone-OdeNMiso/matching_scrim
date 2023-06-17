<?php namespace Yone\Discord\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateYoneDiscordUsers extends Migration
{
    public function up()
    {
        Schema::create('yone_discord_users', function($table)
        {
            $table->engine = 'InnoDB';
            $table->string('id');
            $table->integer('user_id');
            $table->string('username');
            $table->string('discriminator')->nullable();
            $table->string('locale')->nullable();
            $table->string('access_token')->nullable();
            $table->string('refresh_token')->nullable();
            $table->dateTime('expires_in')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->primary(['id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('yone_discord_users');
    }
}
