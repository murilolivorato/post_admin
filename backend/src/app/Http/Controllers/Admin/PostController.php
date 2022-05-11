<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Admin\Post\Post\LoadForm;
use App\Classes\Admin\Post\Post\ProcessDestroy;
use App\Classes\Admin\Post\Post\ProcessSave;
use App\Classes\Admin\Post\Post\LoadDisplay;
use App\Classes\Admin\Post\Post\LoadOptions;
use App\Models\Post;
use App\Classes\Admin\Post\Post\UploadImage;
use App\Http\Requests\Admin\PostRequest;


/**
 * PostController
 */
class PostController extends Controller
{


    /**
     * @param Request $request
     * @return array
     */
    public function load_display(Request $request)
    {
        // COMECA  A DUSCA
        return LoadDisplay::load($request);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function load_form_options(Request $request)
    {
        return LoadOptions::load($request);
    }


    /**
     * @param PostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostRequest $request)
    {
        // FILIAL
        $post = new Post($request->all());
        return  ProcessSave::process($request ,  $post , $this->user);
    }


    /**
     * @param Request $request
     * @return array
     */
    public function upload_images(Request $request )
    {
        return UploadImage::processImage($request);
    }


    /**
     * @param Request $request
     * @param $id
     * @return array
     */
    public function load_form(Request $request , $id)
    {
        return LoadForm::load($request , $id , $this->user);
    }


    /**
     * @param PostRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function update(PostRequest $request , $id)
    {
        // FILIAL
        $post = Post::find($id);

        if($post){
            return  ProcessSave::process($request ,  $post  , $this->user);
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        return  ProcessDestroy::process($request);
    }
}
