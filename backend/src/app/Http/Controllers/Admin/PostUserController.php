<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Classes\Admin\Post\PostUser\ProcessDestroy;
use App\Classes\Admin\Post\PostUser\ProcessSave;
use App\Classes\Admin\Post\PostUser\LoadDisplay;
use App\Models\PostUser;
use App\Http\Requests\Admin\PostUserRequest;

/**
 * PostUserController
 */
class PostUserController extends Controller
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
     * @param PostUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostUserRequest $request)
    {
        // FILIAL
        $postUser = new PostUser($request->all());
        return  ProcessSave::process($request ,  $postUser , $this->user  );
    }

    /**
     * @param PostUserRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function update(PostUserRequest $request , $id)
    {
        // FILIAL
        $postUser = PostUser::find($id);

        if($postUser){
            return  ProcessSave::process($request ,  $postUser  , $this->user   );

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
