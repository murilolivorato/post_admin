<?php


namespace  App\Classes\Admin\Post\Post;
use App\Models\Post;
use App\Models\PostCategory;
use App\Classes\Helper\SetQuery;

class LoadDisplay
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
     * @var int
     */
    protected $paginateNumber = 20;
    /**
     * @var null
     */
    protected $page = null;


    /**
     * @param $request
     * @return array
     */
    public static function load($request){

        return   (new static)->handle($request);
    }

    /**
     * @param $request
     * @return array
     */
    private function handle($request){
        return   $this->setRequest($request)
                      ->processQuery();
    }

    /**
     * @param $request
     * @return $this
     */
    private function setRequest($request){

        $this->request = $request;
        return $this;
    }

    // PROCESSING FORM

    /**
     * @return array
     */
    public function processQuery()
    {
        $title                 = $this->request->input('title');
        $category_id           = $this->request->input('category');
        $post_user_id          = $this->request->input('post_user');
        $post_tag_id           = $this->request->input('post_tag');


        $result  = Post::select([ 'id', 'status', 'category_id' , 'folder', 'post_user_id' , 'url_title' , 'status' , 'sub_title' , 'title' , 'user_id'])

            // POST CATEGORY
            ->with([ 'PostCategory' => function($query) {
                $query->select('id','title', 'url_title');
            } ])

            // POST USER
            ->with([ 'PostUser' => function($query) {
                $query->select('id','title', 'url_title');
            } ])

            // POST TAG
            ->with([ 'PostTags' => function($query) {
                $query->select('id','title', 'url_title');
            } ])

            // IMAGE GALLERY
            ->with([ 'ImageGallery' => function($query) {
                $query->select('id','title' , 'gallery_id', 'importable_id' , 'importable_type');
            } ])


            // QUANDO NOME
            ->when($title, function ($query) use ($title) {
                return $query->where('title', 'like' , '%' .  $title .'%'  );
            })

            // WHEN HAS CATEGORY ID
            ->when($category_id , function ($query) use ($category_id) {
                return $query->whereIn('category_id' , SetQuery::convertArray($category_id ));
            })

            // WHEN HAS POST USER
            ->when($post_user_id , function ($query) use ($post_user_id) {
                return $query->whereIn('post_user_id' , SetQuery::convertArray($post_user_id ));
            })

            // WHEN HAS POST USER
            ->when($post_user_id , function ($query) use ($post_user_id) {
                return $query->where('post_user_id' , SetQuery::convertArray($post_user_id) );
            })

            // WHEN HAS POST USER
            ->when($post_tag_id , function ($query) use ($post_tag_id) {
                // HAS NO DISTANCE
                $query->whereHas('PostTags', function ($query) use ($post_tag_id) {
                    return $query->whereIn('id', addArrayElement($post_tag_id));
                });
             })


            ->orderBy('created_at', 'DESC')
            ->paginate($this->paginateNumber , ['*'], 'page', $this->page );


        return  [
            'pagination' => [
                'total'         => $result->total(),
                'per_page'      => $result->perPage(),
                'current_page'  => $result->currentPage(),
                'last_page'     => $result->lastPage(),
                'from'          => $result->firstItem(),
                'to'            => $result->lastItem()
            ],
            'data'             => self::makeCollection($result->items())
        ];

    }


    /**
     * @param $result
     * @return \Illuminate\Support\Collection
     */
    protected static function makeCollection($result){

        $collection =  collect($result);

        return  $collection->map(function ($item, $key) {
            return [
                'id'                   => $item->id,
                'status'               => $item->status,
                'title'                => $item->title ,
                'url_title'            => $item->url_title ,
                'post_category'        => $item->postCategory ? $item->postCategory : null ,
                'post_user'            => $item->PostUser ? $item->PostUser : null ,
                'post_tags'            => $item->PostTags ? $item->PostTags : null ,
                'image'                => self::makeImageCollection($item->Images) ,
                'folder'               => $item->folder
            ];
        });
    }

    /**
     * @param $result
     * @return mixed|void
     */
    protected static function makeImageCollection($result){
        $image = $result->where('type' , 'display' );
        if($image->isNotEmpty()){
            return $image->first();
        }
    }
}
