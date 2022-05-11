<?php

namespace App\Classes\CreateDBSeed;

use App\Classes\CreateDBSeed\ResetData\ResetFolders;
use App\Classes\CreateDBSeed\ResetData\ResetTable;

class ResetData
{
    public function start(){
        $tasks = [
            ResetTable::class,
            ResetFolders::class
        ];

        foreach ($tasks as $task){
            (new $task)->handle();
        }

    }
}
