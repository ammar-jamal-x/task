<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RetriveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();

        $subset = $data->map(function ($data) {
            return collect($data->toArray())
                ->only(['id', 'name', 'email'])
                ->all();
        });
        $response = [
            'success' => true,
            'message' => null,
            'data' => $subset,
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
        //
    }
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userLikePost($id)
    {
//        $data =DB::table('users')::with()
//            ->where('id', '=', $id)::with('Comment')
//        ->get();
//        $real=User::with('Like')
//            ->where('id', $id)->get(['id', 'name', 'email']);
//
//        $data=Like::where('user_id',$id)->with('User')->with('Post')->get();
        $data=User::where('id',$id)->with(['Likes' => function ($query) {
            $query->select('id');}
            ])->with('Likes.Post')->get();


        $response = [
            'success' => true,
            'message' => null,
            'data' => $data,
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
