<?php

namespace Migrations;

use spirit\DB;
use Spirit\DB\Schema;
use Spirit\DB\schema\Table;
use Spirit\Structure\Migration;

class UserApp extends Migration
{

    public function up()
    {
        Schema::create('user_app', function (Table $table) {
            $table->bigSerial('id')
                ->timestamps()
                ->bigInteger('user_id')->index()
                ->string('hash', 40)->unique()
                ->string('alias', 50)
                ->string('app_user_id', 255)
                ->string('token', 255)
                ;

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('user_app', function (Table $table) {
            $table->drop();
        });
    }

}