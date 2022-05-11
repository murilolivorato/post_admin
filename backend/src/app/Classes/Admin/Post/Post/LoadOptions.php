<?php


namespace App\Classes\Admin\Post\Post;
use App\Models\FileGallery;
use App\Models\ImageGallery;
use App\Models\PostCategory;
use App\Models\PostUser;
use App\Models\PostTag;
use App\Classes\Utilities\DBImageGalleryStyle;

use App\Classes\Utilities\DBStatus;

class LoadOptions
{
    /**
     * @var
     */
    protected $request;
    /**
     * @var
     */
    protected $result;


    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function load($request)
    {

        return (new static)->handle($request);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    private function handle($request)
    {
        return $this->setRequest($request)
                    ->process();
    }

    /**
     * @param $request
     * @return $this
     */
    private function setRequest($request)
    {

        $this->request = $request;
        return $this;

    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    private function process()
    {

        return response()->json([
            'status'               =>  DBStatus::getAll() ,
            'category'             =>  PostCategory::select(['id', 'title' , 'url_title'])->orderBy('id', 'ASC')->get()  ,
            'post_user'            =>  PostUser::select(['id', 'title', 'url_title'])->orderBy('id', 'ASC')->get()  ,
            'post_tag'             =>  PostTag::select(['id', 'title', 'url_title'])->orderBy('id', 'ASC')->get()  ,
            'image_gallery_style'  =>  DBImageGalleryStyle::getAll()  ,
            'image_gallery'        =>  ImageGallery::select(['id', 'title'])->withCount('Images')->orderBy('id', 'ASC')->get() ,
            'file_gallery'         =>  FileGallery::select(['id', 'title'])->withCount('Files')->orderBy('id', 'ASC')->get() ,
        ]);

    }


}
