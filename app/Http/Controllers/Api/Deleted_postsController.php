<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Delete_posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Deleted_postsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Delete_posts::paginate(5);
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
        ]);
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()->all()], 422);

        $insert=Delete_posts::create(['post_id' =>$request->post_id,
            'message'=>$request->message,]);
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
    public function show(Delete_posts $deleted_posts)
    {
        $response = [
            'success' => true,
            'message' => null,
            'data' => $deleted_posts
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
    public function update(Request $request, Delete_posts $delete_posts)
    {
        if(!$delete_posts)
        {
            $response = [
                'success' => false,
                'message' => '$delete_posts not found',
                'data' => null,
            ];
            return response($response);
        }


        $delete_posts->post_id  = $request->post_id;

        $delete_posts->message = $request->message;
   //     dd($request->all());
        $delete_posts->save();

        $response = [
            'success' => true,
            'message' => null,
            'data' => $delete_posts,
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
        $data =Delete_posts::findorFail($id);
        $data->delete();
        $response = [
            'success' => true,
            'message' => null,
        ];
        return response($response);
    }
}
