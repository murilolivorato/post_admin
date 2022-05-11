<?php


namespace  App\Classes\Admin\Post\PostTag;

use App\Classes\Admin\Post\PostTag\Save\MakePostTagData;
use App\Classes\Admin\Post\PostTag\Save\SavePostTag;

use App\Exceptions\StoreDataException;
use App\Models\PostTag;
use App\Models\UserAdmin;
use GuzzleHttp\Exception\ClientException;
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
     * @var
     */
    protected $result;

    /**
     * @param Request $request
     * @param PostTag $post_tag
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
    public static function process(Request $request , PostTag $post_tag  , $user){
        try {
            return  (new static)->handle($request , $post_tag , $user );
        }
        catch (StoreDataException $exeption) {
            throw $exeption->validationExeption();
        }
    }

    /**
     * @param $request
     * @param $post_tag
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
    private function handle($request , $post_tag , $user){
        return   $this->setRequest($request)
                      ->setUser($user)
                      ->save($post_tag)
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
     * @param $post_tag
     * @return $this
     */
    private function save($post_tag)
    {
        // START TRANSACTION
        DB::beginTransaction();
            // RETORNA O VALOR PARA O CRUD NA VIEW
            $post_tag = new MakePostTagData(
                                    // SALVA POST TAG
                                    new SavePostTag($post_tag ,
                                                         $this->request ,
                                                         $this->user
                                    )
                       );

        $result = $post_tag->publish();

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
        // SUCESSO
        return response()->json(['new_record'  =>  $this->result['new_record']  ] , 200 );
    }
}
