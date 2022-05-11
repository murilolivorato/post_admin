<?php


namespace  App\Classes\Admin\Post\PostUser;

use App\Classes\Admin\Post\PostUser\Save\SavePostUser;
use App\Classes\Admin\Post\PostUser\Save\MakePostUserData;

use App\Exceptions\StoreDataException;
use App\Models\PostUser;
use App\Models\User;
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
     * @var
     */
    protected $result;

    /**
     * @param Request $request
     * @param PostUser $post_user
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
    public static function process(Request $request , PostUser $post_user  , $user){
        try {
            return  (new static)->handle($request , $post_user , $user );
        }
        catch (StoreDataException $exeption) {
            throw $exeption->validationExeption();
        }
    }

    /**
     * @param $request
     * @param $post_user
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
    private function handle($request , $post_user , $user){
        return   $this->setRequest($request)
                      ->setUser($user)
                      ->save($post_user)
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
     * @param $post_user
     * @return $this
     */
    private function save($post_user)
    {
        // START TRANSACTION
        DB::beginTransaction();

        // RETORNA O VALOR PARA O CRUD NA VIEW
        $post_user = new MakePostUserData(
                                // SALVA POST TAG
                                new SavePostUser($post_user ,
                                                 $this->request ,
                                                 $this->user
                                )
                   );

        // RESULT
        $result = $post_user->publish();

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
