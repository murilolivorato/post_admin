<?php


namespace  App\Classes\Admin\Post\PostTag;
use App\Classes\Admin\Post\PostTag\Destroy\DestroyPostTag;
use App\Exceptions\StoreDataException;
use App\Models\PostTag;
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
        try {
             return  (new static)->handle($request);
        }
        catch (StoreDataException $exeption) {
            throw $exeption->validationExeption();
        }
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

                    $PostTag = PostTag::find($deleteItem['id']);

                    // VERIFICA SE POSSUI PRODUTOS CADASTRADOS
                    throw_if(count($PostTag->Posts), new StoreDataException("Esta Arquivo de Notícia possui Notícias Cadastradas ,  delete antes as Notícias para depois deletar esta Categoria ."));


                    $PostTag =  new DestroyPostTag( $PostTag ,  $deleteItem['index']  );

                    // push index into index , to make VUE effect to delete
                   array_push($this->list_index , $PostTag->destroy());
                }

            // END TRANSACTION
            DB::commit();
            throw_if(empty($this->list_index), new StoreDataException("Erro, Comunique o Suporte"));

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
