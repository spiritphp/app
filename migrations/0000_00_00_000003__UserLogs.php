<?php

namespace Migrations;

use spirit\DB;
use Spirit\DB\Schema;
use Spirit\DB\schema\Table;
use Spirit\Structure\Migration;

class UserLogs extends Migration
{

    public function up()
    {
        Schema::create('user_logs', function (Table $table) {
            $table->bigSerial('id')
                ->timestamps()
                ->bigInteger('user_id')->index()
                ->inet('ip')
                ->string('hash', 32)
                ->string('user_agent', 1000)
                ;

            $table->unique('hash');

            $table->foreign('user_id')->references('id')->on('users');


        });
    }

    public function down()
    {
        Schema::table('user_logs', function (Table $table) {
            $table->drop();
        });
    }

}