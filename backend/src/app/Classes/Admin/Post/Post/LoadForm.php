<?php


namespace App\Classes\Admin\Post\Post;
use App\Classes\Helper\SetArrayValue;
use App\Models\Post;

class LoadForm
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
    protected $post;


    /**
     * @param $request
     * @param $id
     * @return array
     */
    public static function load($request, $id)
    {

        return (new static)->handle($request, $id);
    }

    /**
     * @param $request
     * @param $id
     * @return array
     */
    private function handle($request, $id)
    {
        return $this->setRequest($request)
                    ->getResult($id);
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
     * @param $id
     * @return array
     */
    private function getResult($id)
    {
        $post  = Post::findOrFail($id);

        $response = [
            'id'                => $post->id,
            'status'            => $post->status,
            'category_id'       => $post->category_id,
            'post_user_id'      => $post->post_user_id,
            'post_tag_id'       => SetArrayValue::returnIds($post->PostTags) ,
            'folder'            => $post->folder,
            'title'             => $post->title,
            'sub_title'         => $post->sub_title,
            'url_title'         => $post->url_title,
            'post_date'         => $post->post_date,
            'short_description' => $post->short_description,
            'description'       => $post->description,
            'key_words'         => $post->key_words,
            'images'            => [
                0 => $this->setImagesDisplay($post, 'display' , 0 ),
                1 => $this->setImagesDisplay($post, 'detail' , 1)
            ],
            'image_gallery'     => $this->setImageGalleryDisplay($post),
            'file_gallery'      => $this->setFileGalleryDisplay($post),
            'video_gallery'     => $this->setVideoDisplay($post),


        ];



        return $response;
    }

    /**
     * @param $post
     * @return array
     */
    protected function setVideoDisplay($post){
        $display = [];
        if($post->Videos()->exists()){
            foreach($post->Videos as $video) {

                array_push($display , [
                    'id'                => $video->id ,
                    'video_website_id'  => $video->video_website_id ,
                    'title'             => $video->title ,
                    'description'       => $video->description ,
                    'reference'         => $video->reference

                ]);
            }
        }

        return $display;

    }

    /**
     * @param $post
     * @return array|string[]
     */
    protected function setImageGalleryDisplay($post){

        // if has image
        if($post->ImageGalleryExists){

            return [
                'id'=> $post->ImageGallery->id  ,'gallery_id' => $post->ImageGallery->gallery_id  , 'title' => $post->ImageGallery->title  , 'description' => $post->ImageGallery->description
            ];
        }

        return [
            'id'=> 'temp' ,'gallery_id' => '' , 'title' => '' , 'description' => ''
        ];

    }

    /**
     * @param $post
     * @return array|string[]
     */
    protected function setFileGalleryDisplay($post){

        // if has image
        if($post->FileGalleryExists){

            return [
                'id'=> $post->FileGallery->id  ,'gallery_id' => $post->FileGallery->gallery_id , 'title' => $post->FileGallery->title  , 'description' => $post->FileGallery->description
            ];
        }

        return [
            'id'=> 'temp' ,'gallery_id' => '' , 'title' => '' , 'description' => ''
        ];

    }

    /**
     * @param $post
     * @param $type_image
     * @param $index
     * @return array
     */
    protected function setImagesDisplay($post , $type_image , $index ){

        // if has image
        if($post->Images->where('type' , $type_image )->isNotEmpty()){
            $image = $post->Images->where('type' , $type_image )->first();

            return [
                'index'       => $index ,
                'type'        => $type_image ,
                'id'          => $image->id ,
                'image'       => $image->image ,
                'position'    => $image->position ,
                'title'       => $image->title ,
                'description' => $image->description

            ];
        }

        return [
            'type'        => $type_image ,
            'id'          => "temp" ,
            'image'       => ""
        ];



    }



}
