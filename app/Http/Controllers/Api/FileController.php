<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = File::paginate(5);
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
            'post_id' =>'required',
            'user_id' => 'required',
            'name' => 'required',
            'size' => 'required',
            'path' => 'required',
        ]);
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()->all()], 422);

        $insert=File::create(['post_id' =>$request->post_id,
            'user_id'=>$request->user_id,
            'name'=>$request->name,'extension'=>$request->extension,
            'size'=>$request->size,'path'=>$request->path,]);

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
    public function show(File $file)
    {
        $response = [
            'success' => true,
            'message' => null,
            'data' => $file
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
    public function update(Request $request, File $file)
    {
        if(!$file)
        {
            $response = [
                'success' => false,
                'message' => 'post not found',
                'data' => null,
            ];
            return response($response);
        }

        $file->post_id  = $request->post_id;
        $file->user_id = $request->user_id;
        $file->name = $request->name;
        $file->extension = $request->extension;
        $file->size = $request->size;
        $file->path = $request->path;
        $file->save();
        $response = [
            'success' => true,
            'message' => null,
            'data' => $file,
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
        $data =File::findorFail($id);
        $data->delete();
        $response = [
            'success' => true,
            'message' => null,
        ];
        return response($response);
    }
}
