<?php

namespace Database\Seeders;


use App\Classes\CreateDBSeed\CreatePostDependencies;
use App\Classes\CreateDBSeed\CreatePosts;
use App\Classes\CreateDBSeed\ResetData;
use App\Classes\Utilities\ResetMigrationTables;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $tasks = [
            ResetData::class,
            CreatePostDependencies::class ,
            CreatePosts::class
        ];

        foreach ($tasks as $task){
            (new $task)->start();
        }
    }
}
