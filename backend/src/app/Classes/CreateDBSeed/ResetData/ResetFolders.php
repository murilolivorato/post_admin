<?php

namespace App\Classes\CreateDBSeed\ResetData;
use File;
class ResetFolders
{
    public function  handle(){
        File::deleteDirectory(public_path("/assets/arquivos/posts"));
        File::makeDirectory( public_path("/assets/arquivos/posts") , 0755, true);

        File::deleteDirectory(public_path("/assets/arquivos/usuarios"));
        File::makeDirectory( public_path("/assets/arquivos/usuarios") , 0755, true);

    }
}
