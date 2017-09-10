<?php

namespace App\Commands;

class Cron extends \Spirit\Console\Commands\Cron
{

    protected function schedule()
    {
        $this->add('cron_name')->pretty()->call(function () {
            var_dump((8 % 3));
        })->cron('* * * * *');
    }

}