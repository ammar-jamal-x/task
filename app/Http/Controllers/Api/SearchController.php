<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SearchController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search($request){
        $data = Post::where('title', 'like', '%'.$request.'%')
            ->orderBy('title')->select(['id','title','image','created_at'])
            ->paginate(20);
        $response = [
            'success' => true,
            'message' => null,
            'data' => $data
        ];
        return response($response);
    }
    public function  seePost($id){


/*
 *             return post info
 *
 */
        $data=Post::where('id',$id)
            ->with(['likes' => function ($query){$query->select(['post_id','liked']);}])
            ->with('category')
            ->with(['users' => function ($query){$query->select(['id','username','email']);}])
            ->with(['tags' => function ($query){$query->select(['name','name_ar']);}])
            ->with(['comments' => function ($query){$query->select(['post_id','body']);}])
            ->with(['files' => function ($query){$query->select(['post_id','name','extension','size']);}])
            ->first(['id','title','body','image','sub_category_id','user_id']);
/*
 *      returning same posts
 */

        $key=DB::table('posts')->where('posts.id',$id)->select('posts.category_id')->first();
        $data2=Post::where('category_id',$key->category_id)->where('id','<>',$id)->get(['id','title','body','image']);
/*
 *      return download file
 */
        $data3=Post::where('id',$id)
            ->with(['files' => function ($query){$query->select(['post_id','name','extension','size']);}]);


        /*
         *      or i can send file download with this code----
         *           $key=DB::table('files')->where('post_id',$id)->select('files.post_id','files.name','files.extension',
         *                       'files.size')->first();

         *      if (Storage::disk('local')->exists('file.jpg')) {
                       return Storage::download($key->name, $key->extension, $key->size);
                    }

         *
         */

        $response = [
            'success' => true,
            'message' => null,
            'data' => $data,
            'message2' => "next data",
            'data2' => $data2,
            'message3' => "download link",
            'data3' => $data3
        ];
        return response($response);
    }






}
