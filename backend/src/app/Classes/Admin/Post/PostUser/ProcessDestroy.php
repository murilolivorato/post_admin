<?php


namespace  App\Classes\Admin\Post\PostUser;
use App\Classes\Admin\Post\PostUser\Destroy\DestroyPostUser;
use App\Exceptions\StoreDataException;
use App\Models\PostUser;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\DB;


class ProcessDestroy
{
    /**
     * @var
     */
    protected $request;
    /**
     * @var array
     */
    protected $list_index = [];

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function process($request){

        return  (new static)->handle($request);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    private function handle($request){
        return   $this->setRequest($request)
                       ->destroyBook()
                       ->result();
    }

    // SET REQUEST

    /**
     * @param $request
     * @return $this
     */
    private function setRequest($request){

        $this->request = $request;
        return $this;
    }

    // DESTROY BOOK

    /**
     * @return $this
     */
    private function destroyBook(){
            // START TRANSACTION
            DB::beginTransaction();

            foreach($this->request['delete'] as $deleteItem) {

                $PostUser = PostUser::find($deleteItem['id']);

                throw_if(count($PostUser->Posts) , new StoreDataException("Este Arquivo de Notícia possui Notícias Cadastradas ,  delete antes as Notícias para depois deletar este Arquivo ."));

                $PostUser =  new DestroyPostUser(  $PostUser ,  $deleteItem['index']  );

                // push index into index , to make VUE effect to delete
                array_push($this->list_index , $PostUser->destroy());
            }

           throw_if(empty($this->list_index) , new StoreDataException("Erro, Comunique o Suporte"));
            // END TRANSACTION
            DB::commit();

        return $this;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    private function result(){
        // success
        return response()->json(['index'   => $this->list_index  ] , 200);
    }
}
