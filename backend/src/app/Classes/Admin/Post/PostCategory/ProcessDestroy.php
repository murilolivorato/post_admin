<?php


namespace  App\Classes\Admin\Post\PostCategory;
use App\Classes\Admin\Post\PostCategory\Destroy\DestroyPostCategory;
use App\Exceptions\StoreDataException;
use App\Models\PostCategory;
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
            DB::beginTransaction();
            foreach($this->request['delete'] as $deleteItem) {

                $postCategory = PostCategory::find($deleteItem['id']);

                // VERIFICA SE POSSUI PRODUTOS CADASTRADOS
                throw_if(count($postCategory->Posts), new StoreDataException("Esta Categoria de Notícia possui Notícias Cadastradas ,  delete antes as Notícias para depois deletar esta Categoria ."));


                $postCategory =  new DestroyPostCategory(  $postCategory ,
                                                           $deleteItem['index']  );


                // push index into index , to make VUE effect to delete
               array_push($this->list_index , $postCategory->destroy());
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
        return response()->json(['index'   => $this->list_index  ] , 200 );
    }
}
