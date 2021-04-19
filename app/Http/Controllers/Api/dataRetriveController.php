<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dataRetriveController extends Controller
{
    public function userLikePost($id)
    {

        $data=User::where('id',$id)->with(['Likes' => function ($query) {
            $query->select('id', '...');}
        ])
            ->with('Likes.Post')->get(['id','name','email']);


        $response = [
            'success' => true,
            'message' => null,
            'data' =>$data
        ];
        return response($response);

    }


    public function userFiles($id)
    {
        $data=Post::where('user_id',$id)->whereHas()
        $data=User::where('id',$id)->with(['File' => function ($query) {
            $query->select(['id','user_id','post_id','name','extension']);}
        ])
            ->with(['File.Post'  => function ($query) {
        $query->select(['id','user_id','title','body','visible']);}
        ])

            ->get(['id','name','email']);
        $response = [
            'success' => true,
            'message' => null,
            'data' =>$data
        ];
        return ($response);


    }
    public function userCategorie($id)
    {
        $data=User::where('id',$id)->with('Post')->with('Post.Category')->get(['id','name','email']);
        $data1=User::where('id',$id)->with(['likes.Post' => function ($query) {
                $query->select(['id','user_id','category_id','title','body']);}
            ])->with('Post.Category')->get(['id','name','email']);
          $response = [
            'success' => true,
            'message' => null,
            'data' =>$data
        ];
        return ($response);
    }
    public function show1($id)
    {
        //
    }
    public function show2($id)
    {
        //
    }
    public function show3($id)
    {
        //
    }
}
