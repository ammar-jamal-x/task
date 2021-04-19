<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\deletable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeletableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = deletable ::paginate(5);
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
            'deletable_id' => 'required',
            'deletable_type' => 'required',
            'message' => 'required',
        ]);
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()->all()], 422);

        $insert=Deletable::create(['deletable_id' =>$request->deletable_id,
            'deletable_type'=>$request->deletable_type,
            'message'=>$request->message]);

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
    public function show(Deletable $deletable)
    {
        $response = [
            'success' => true,
            'message' => null,
            'data' => $deletable
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
    public function update(Request $request, Deletable $deletable)
    {
        if(!$deletable)
        {
            $response = [
                'success' => false,
                'message' => 'post not found',
                'data' => null,
            ];
            return response($response);
        }
        $deletable->deletable_id  = $request->deletable_id;
        $deletable->deletable_type = $request->deletable_type;
        $deletable->message = $request->message;
        $deletable->save();
        $response = [
            'success' => true,
            'message' => null,
            'data' => $deletable,
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
        $data =Deletable::findorFail($id);
        $data->delete();
        $response = [
            'success' => true,
            'message' => null,
        ];
        return response($response);
    }
}
