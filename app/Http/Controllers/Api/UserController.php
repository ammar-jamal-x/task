<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::with('Likes');

//        User::paginate(10);
        $response = [
            'success' => true,
            'message' => null,
            'data' => $data,
        ];
        return response($response);
    }


    /**
     *  $data = User::with('Post')->get();
          return response($data);
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()->all()], 422);

        $insert=User::create(['name' =>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,'about'=>$request->about,
            'birth_date'=>$request->birth_date,'gender'=>$request->gender,
            'verified'=>$request->verified,'password'=>$request->password,
            'remember_token'=>$request->remember_token,'is_admin'=>$request->is_admin,
            ]);

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
    public function show(User $user)
    {
        $response = [
            'success' => true,
            'message' => null,
            'data' => $user,
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
    public function update(Request $request,User $user)
    {
        if(!$user) {
            $response = [
                'success' => false,
                'message' => 'post not found',
                'data' => null,
            ];
            return response($response);
        }


        $user->name=$request->name;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->about = $request->about;
        $user->birth_date = $request->gbirth_date;
        $user->gender = $request->gender;
        $user->verified = $request->verified;
        $user->password = $request->password;
        $user->remember_token = $request->remember_token;
        $user->is_admin = $request->is_admin;
        $user->save();
        $response = [
            'success' => true,
            'message' => null,
            'data' => $user,
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
        $data =User::findorFail($id);
        $data->delete();
        $response = [
            'success' => true,
            'message' => null,
        ];
        return response($response);

    }
}
