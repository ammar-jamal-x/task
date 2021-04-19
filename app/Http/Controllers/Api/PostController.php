<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\returnArgument;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  DB::table('posts')
            ->orderByRaw('created_at DESC')
            ->select(['id','title','image','created_at'])->simplePaginate(5);

        $response = [
            'success' => true,
            'message' => null,
            'data' => $data,
        ];
        return response($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
          'category_id' => 'required',
            'body' => 'required',
        ]);
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()->all()], 422);

       $insert=Post::create(['user_id' =>$request->user_id,
           'category_id'=>$request->category_id,
            'title'=>$request->title,'body'=>$request->body,
            'visible'=>$request->visible,'image'=>$request->image,
           'sub_category_id'=>$request->sub_category_id]);

        $response = [
            'success' => true,
            'message' => null,
            'data' => $insert
        ];
        return response($response);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $response = [
            'success' => true,
            'message' => null,
            'data' => $post
        ];
        return response($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        if(!$post)
        {
            $response = [
                'success' => false,
                'message' => 'post not found',
                'data' => null,
            ];
            return response($response);
        }

        $post->user_id  = $request->user_id;
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->visible = $request->visible;
        $post->image = $request->image;
        $post->sub_category_id = $request->sub_category_id;
        $post->save();
        $response = [
            'success' => true,
            'message' => null,
            'data' => $post,
        ];
        return response($response);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data =Post::findorFail($id);
        $data->delete();
        $response = [
            'success' => true,
            'message' => null,
        ];
        return response($response);
    }
}
