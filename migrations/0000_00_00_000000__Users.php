<?php

namespace Migrations;

use Spirit\DB\Schema;
use Spirit\DB\schema\Table;
use Spirit\Structure\Migration;

class Users extends Migration
{

    public function up()
    {
        Schema::create('users', function (Table $table) {
            $table->bigSerial('id')->unique()
                ->timestamps()
                ->softRemove()
                ->string('uid', 8)->unique()
                ->string('email', 255)->unique()
                ->string('login', 255)->unique()
                ->string('token', 64)->unique()
                ->string('password', 60)
                ->string('version', 16)->default(1)
                ->jsonb('roles')
                ->timestamp('activated_at')
                ->string('block', 255)
                ->timestamp('date_online')->now()->notNull()
            ;
        });
    }

    public function down()
    {
        Schema::table('users', function (Table $table) {
            $table->drop();
        });
    }

}