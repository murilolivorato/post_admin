<?php

namespace App\Classes\CreateDBSeed\ResetData;
use App\Classes\Utilities\ResetMigrationTables;
use Illuminate\Support\Facades\DB;

class ResetTable
{
    public function  handle(){
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach (ResetMigrationTables::getAll() as $table){
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
