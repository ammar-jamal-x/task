<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Like::paginate(5);
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
            'post_id' => 'required',
        ]);
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()->all()], 422);

        $insert=Like::create(['user_id' =>$request->user_id,
            'post_id'=>$request->post_id,
            'liked'=>$request->liked,]);

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
    public function show(Like $like)
    {
        $response = [
            'success' => true,
            'message' => null,
            'data' => $like
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
    public function update(Request $request,Like $post1)
    {
        if(!$post1)
        {
            $response = [
                'success' => false,
                'message' => 'post not found',
                'data' => null,
            ];
            return response($response);
        }
      //  dd($request->all());


        $post1->user_id = $request->user_id;

        $post1->post_id=$request->post_id;
        $post1->liked=$request->liked;
        $post1->save();
        $response = [
            'success' => true,
            'message' => null,
            'data' => $post1,
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
        $data=Like::findorFail($id);
        $data->destroy();
        $response = [
            'success' => true,
            'message' => null,
        ];
        return response($response);
    }
}
