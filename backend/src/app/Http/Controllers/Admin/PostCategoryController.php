<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Admin\Post\PostCategory\ProcessDestroy;
use App\Classes\Admin\Post\PostCategory\ProcessSave;
use App\Classes\Admin\Post\PostCategory\LoadDisplay;
use App\Models\PostCategory;
use App\Http\Requests\Admin\PostCategoryRequest;
use Auth;


/**
 * PostCategoryController
 */
class PostCategoryController extends Controller
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
     * @param PostCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostCategoryRequest $request)
    {
          // FILIAL
          $postCategory = new PostCategory($request->all());
          return  ProcessSave::process($request ,  $postCategory , $this->user );
    }


    /**
     * @param PostCategoryRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function update(PostCategoryRequest $request , $id)
    {

        // FILIAL
        $postCategory = PostCategory::find($id);

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
