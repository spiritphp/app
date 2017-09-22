<?php

namespace Migrations;

use spirit\DB;
use Spirit\DB\Schema;
use Spirit\DB\schema\Table;
use Spirit\Structure\Migration;

class UserRecoveries extends Migration
{

    public function up()
    {
        Schema::create('user_recoveries', function (Table $table) {
            $table->bigSerial('id')
                ->timestamps()
                ->bigInteger('user_id')->index()
                ->inet('ip')->notNull()
                ->inet('ip_used')
                ->string('token', 64)
                ->timestamp('used_at')
                ;

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('user_recoveries', function (Table $table) {
            $table->drop();
        });
    }

}