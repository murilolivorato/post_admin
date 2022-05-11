<?php


namespace  App\Classes\Admin\Post\Post;

use App\Exceptions\StoreDataException;
use App\Models\Post;
use App\Classes\Admin\Post\Post\Save\MakeFolder;
use App\Classes\Admin\Post\Post\Save\SaveImageGallery;
use App\Classes\Admin\Post\Post\Save\SaveImages;
use App\Classes\Admin\Post\Post\Save\SavePost;
use App\Classes\Admin\Post\Post\Save\SavePostTag;
use App\Classes\Admin\Post\Post\Save\SaveFileGallery;
use App\Classes\Admin\Post\Post\Save\SaveVideoGallery;

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
     * @param Request $request
     * @param Post $post
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
    public static function process(Request $request , Post $post  , $user){
        try {
            return  (new static)->handle($request , $post , $user );
        }
        catch (StoreDataException $exeption) {
            throw $exeption->validationExeption();
        }

    }

    /**
     * @param $request
     * @param $post
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
    private function handle($request , $post , $user){
        return   $this->setRequest($request)
                      ->setUser($user)
                      ->save($post)
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
     * @param $post
     * @return $this
     */
    private function save($post)
    {

        // START TRANSACTION
        DB::beginTransaction();
            // RETORNA O VALOR PARA O CRUD NA VIEW
            $post =
                // SAVE VIDEO GALLERY
                new SaveVideoGallery(
                        // SAVE FILE GALLERY
                        new SaveFileGallery(
                            // SAVE IMAGE GALLERY
                            new SaveImageGallery(
                                    // SAVE IMAGES
                                    new SaveImages(
                                            // MAKE FOLDER
                                            new MakeFolder(
                                                // SAVE POST TAG
                                                    new SavePostTag(
                                                            // SALVA A FILIAL
                                                            new SavePost($post ,
                                                                         $this->request ,
                                                                         $this->user
                                                            )
                                                    )
                                            )
                                    )
                            )
                        )
                 );

        throw_if(! $post->publish() , new StoreDataException("Não Inseriu"));

        // END TRANSACTION
        DB::commit();

        return $this;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getResult(){
        // SUCESSO
        return response()->json(null , 200 );
    }
}
