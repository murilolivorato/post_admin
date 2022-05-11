<?php


namespace  App\Classes\Admin\Post\PostTag;
use App\Models\PostTag;
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


        $result  = PostTag::select([ 'id' , 'title' , 'url_title' , 'user_id' , 'created_at'])

            // QUANDO NOME
            ->when($title, function ($query) use ($title) {
                return $query->where('title', 'like' , '%' .  $title .'%'  );
            })

        // PRODUTOS
            ->withCount('Posts')
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
            'data'             => $result->items()
        ];




    }
}
