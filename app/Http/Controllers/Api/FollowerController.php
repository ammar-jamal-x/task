<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FollowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Follower::paginate(5);
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
            'follower_id' => 'required',
            'leader_id' => 'required',
        ]);
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()->all()], 422);

        $insert=Follower::create(['follower_id'=>$request->follower_id ,
            'leader_id'=>$request->leader_id]);
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
    public function show(Follower $follower)
    {
        $response = [
            'success' => true,
            'message' => null,
            'data' => $follower
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
    public function update(Request $request, Follower $follower)
    {
        if(!$follower)
        {
            $response = [
                'success' => false,
                'message' => 'post not found',
                'data' => null,
            ];
            return response($response);
        }

        $follower->follower_id  = $request->follower_id;
        $follower->leader_id = $request->leader_id;
        $follower->save();

        $response = [
            'success' => true,
            'message' => null,
            'data' => $follower,
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
        $data =Follower::findorFail($id);
        $data->delete();
        $response = [
            'success' => true,
            'message' => null,
        ];
        return response($response);
    }
}
