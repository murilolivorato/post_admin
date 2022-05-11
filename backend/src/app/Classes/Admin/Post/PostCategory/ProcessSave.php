<?php


namespace  App\Classes\Admin\Post\PostCategory;

use App\Classes\Admin\Post\PostCategory\Save\MakePostCategoryData;
use App\Classes\Admin\Post\PostCategory\Save\SavePostCategory;


use App\Exceptions\StoreDataException;
use App\Models\PostCategory;
use App\Models\UserAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProcessSave
{
    /**
     * @var
     */
    protected $request;
    /**
     * @var
     */
    protected $user;

    /**
     * @param Request $request
     * @param PostCategory $post_category
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
    public static function process(Request $request , PostCategory $post_category  , $user){
        try {
            return  (new static)->handle($request , $post_category , $user );
        }
        catch (StoreDataException $exeption) {
            throw $exeption->validationExeption();
        }
    }

    /**
     * @param $request
     * @param $post_category
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
    private function handle($request , $post_category , $user){
        return   $this->setRequest($request)
                      ->setUser($user)
                      ->save($post_category)
                      ->getResult();
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

    // SET USER

    /**
     * @param $user
     * @return $this
     */
    private function setUser($user){

        $this->user = $user != null ? UserAdmin::find($user->id) : null;
        return $this;
    }

    // SAVE BOOK

    /**
     * @param $post_category
     * @return $this
     */
    private function save($post_category)
    {
        // START TRANSACTION
        DB::beginTransaction();
            // RETORNA O VALOR PARA O CRUD NA VIEW
            $post_category = new MakePostCategoryData(
                                // SALVA A FILIAL
                                new SavePostCategory($post_category ,
                                                        $this->request ,
                                                        $this->user
                                )
                       );
        $result = $post_category->publish();

        throw_if(! $result , new StoreDataException("Não Inseriu"));
        // END TRANSACTION
        DB::commit();

        $this->result = $result;
        return $this;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getResult(){
        // success
        return response()->json( ['new_record'  =>  $this->result['new_record']  ] , 200 );
    }
}
