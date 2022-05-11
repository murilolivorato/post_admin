<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\Utilities\ResetMigrationTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class DropAllTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'drop:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop All Tables';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach (ResetMigrationTables::getAll() as $table){
            Schema::dropIfExists($table);
        }

        Schema::dropIfExists('migrations');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
