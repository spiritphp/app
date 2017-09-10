<?php

namespace Migrations;

use spirit\DB;
use Spirit\DB\Schema;
use Spirit\DB\schema\Table;
use Spirit\Structure\Migration;

class UserInfo extends Migration
{

    public function up()
    {
        Schema::create('user_info', function (Table $table) {
            $table->bigInteger('user_id')->primary()->unique()
                ->jsonb('info');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('user_info', function (Table $table) {
            $table->drop();
        });
    }

}