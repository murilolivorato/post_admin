<?php


namespace  App\Classes\Admin\Post\Post;
use App\Classes\Admin\Post\PostCategory\Destroy\DestroyPostCategory;
use App\Exceptions\StoreDataException;
use App\Models\PostCategory;

use App\Classes\Admin\Post\Post\Destroy\DeleteFileGallery;
use App\Classes\Admin\Post\Post\Destroy\DeleteFolder;
use App\Classes\Admin\Post\Post\Destroy\DeleteImageGallery;
use App\Classes\Admin\Post\Post\Destroy\DeleteImages;
use App\Classes\Admin\Post\Post\Destroy\DeletePost;
use App\Classes\Admin\Post\Post\Destroy\DeletePostTag;
use App\Classes\Admin\Post\Post\Destroy\DeleteVideoGallery;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
                                  ->destroy()
                                  ->result();
    }


    /**
     * @param $request
     * @return $this
     */
    private function setRequest($request){

        $this->request = $request;
        return $this;
    }

    /**
     * @return $this
     */
    private function destroy(){
        // START TRANSACTION
        DB::beginTransaction();

        foreach($this->request['delete'] as $deleteItem) {

            $post = Post::find($deleteItem['id']);

            $post = new DeletePost (
                                new DeletePostTag(
                                        new DeleteFolder(
                                             new DeleteImages(
                                                        new DeleteImageGallery(
                                                                    new DeleteFileGallery(
                                                                                new DeleteVideoGallery(
                                                                                            $post ,
                                                                                            $this->request
                                                                                        )
                                                                                 )
                                                                         )
                                                                    )
                                                        )
                                                 )
                                        );



            if($post->destroy() == true ){
                // push index into index , to make VUE effect to delete
                array_push($this->list_index , $deleteItem['index']);
            }
        }
        throw_if(empty($this->list_index), new StoreDataException("Erro, Comunique o Suporte"));

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
