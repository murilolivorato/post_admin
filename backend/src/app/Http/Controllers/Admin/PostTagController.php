<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Classes\Admin\Post\PostTag\ProcessDestroy;
use App\Classes\Admin\Post\PostTag\ProcessSave;
use App\Classes\Admin\Post\PostTag\LoadDisplay;
use App\Models\PostTag;
use App\Http\Requests\Admin\PostTagRequest;
use Exception;
/**
 * PostTagController
 */
class PostTagController extends Controller
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
     * @param PostTagRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostTagRequest $request)
    {

        // FILIAL
        $postCategory = new PostTag($request->all());
        return ProcessSave::process($request, $postCategory, $this->user);


    }


    /**
     * @param PostTagRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function update(PostTagRequest $request , $id)
    {
        // FILIAL
        $postCategory = PostTag::find($id);

        if($postCategory){
            return  ProcessSave::process($request ,  $postCategory  , $this->user );

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
