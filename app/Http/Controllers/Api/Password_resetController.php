<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Password_reset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Password_resetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Password_reset::paginate(5);
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
            'email' => 'required',
        ]);
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()->all()], 422);

        $insert=Password_reset::create(['email ' =>$request->email ,'token'=>$request->token,
        ]);
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
    public function show(Password_reset $password_reset)
    {
        $response = [
            'success' => true,
            'message' => null,
            'data' => $password_reset
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
    public function update(Request $request, Password_reset $password_reset)
    {
        if(!$password_reset)
        {
            $response = [
                'success' => false,
                'message' => 'post not found',
                'data' => null,
            ];
            return response($response);
        }

        $password_reset->email  = $request->email;
        $password_reset->token  = $request->token;
        $password_reset->save();
        $response = [
            'success' => true,
            'message' => null,
            'data' => $password_reset,
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
        $data =Password_reset::findorFail($id);
        $data->delete();
        $response = [
            'success' => true,
            'message' => null,
        ];
        return response($response);
    }
}
