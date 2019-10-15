<?php

namespace app\cli\tasks;

use Phalcon\Cli\Task;

class MainTask extends Task
{
    public function mainAction()
    {
        echo "Congratulations! You are now flying with Phalcon CLI!";
    }

    public function notFoundAction()
    {
        echo 'Task Or Action Not Found!';
    }

    private function showMsg($msg, $newLine = true)
    {
        echo $msg;
        if ($newLine) {
            echo PHP_EOL;
        }
    }
}
