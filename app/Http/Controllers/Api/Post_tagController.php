<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post_tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Post_tagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Post_tag::paginate(5);
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
            'post_id' => 'required',
            'tag_id' => 'required',
        ]);
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()->all()], 422);

        $insert=Post_tag::create(['post_id' =>$request->post_id,'tag_id'=>$request->tag_id]);
        $response = [
            'success' => true,
            'message' => null,
            'data' => $insert,
        ];
        return response($response);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post_tag $post_tag)
    {

        $response = [
            'success' => true,
            'message' => null,
            'data' => $post_tag,
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
    public function update(Request $request, Post_tag $post_tag)
    {
        if(!$post_tag)
        {
            $response = [
                'success' => false,
                'message' => 'post not found',
                'data' => null,
            ];
              return response($response);
        }
        $post_tag->post_id=$request->post_id;
        $post_tag->tag_id=$request->tag_id;
        $post_tag->save();
        $response = [
            'success' => true,
            'message' => null,
            'data' => $post_tag,
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
        $data=Post_tag::findorFail($id);
        $data->delete();
        $response = [
            'success' => true,
            'message' => null,
        ];
        return response($response);
    }
}
