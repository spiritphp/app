<?php

namespace Migrations;

use spirit\DB;
use Spirit\DB\Schema;
use Spirit\DB\schema\Table;
use Spirit\Structure\Migration;

class UserRecovery extends Migration
{

    public function up()
    {
        Schema::create('user_recovery', function (Table $table) {
            $table->bigSerial('id')
                ->timestamps()
                ->bigInteger('user_id')->index()
                ->inet('ip')->notNull()
                ->inet('ip_use')
                ->string('hash', 40)
                ->timestamp('used_at')
                ->boolean('active')->default(true)->notNull();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('user_recovery', function (Table $table) {
            $table->drop();
        });
    }

}