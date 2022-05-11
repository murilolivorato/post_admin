<?php


namespace App\Console\Commands;


use App\Classes\Utilities\ResetMigrationTables;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use File;

class ResetFolders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset-folder:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $folderList = [
            '/assets/arquivos/arquivos' ,
            '/assets/arquivos/galerias_de_imagens' ,
            '/assets/arquivos/posts' ,
            '/assets/arquivos/product' ,
            '/assets/arquivos/product_category' ,
            '/assets/arquivos/product_manufacture' ,
            '/assets/arquivos/product_sub_category' ,
            '/assets/arquivos/usuarios'
        ];

        foreach ($folderList as $folder){
            $this->setNewFolder($folder);
        }
    }

    protected function setNewFolder($folder){
        File::deleteDirectory(public_path($folder));
        File::makeDirectory( public_path($folder) , 0755, true);
    }
}
