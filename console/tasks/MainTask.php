<?php

namespace console\tasks;

use Phalcon\Cli\Task;

class MainTask extends Task
{
    public function mainAction()
    {
        echo 'Thissdgfsdfsdf is the default task and the default action' . PHP_EOL;
    }

    public function aAction()
    {
        echo 'gsfgsfgsf';
    }
}