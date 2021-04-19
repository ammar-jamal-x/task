<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Failed_jobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Failed_jobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Failed_jobs::paginate(5);
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
            'connection' => 'required',
            'queue' => 'required',

        ]);
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()->all()], 422);

        $failed_jobs=Failed_jobs::create(['connection' =>$request->connection,
            'queue'=>$request->queue,
            'payload'=>$request->payload,
            'exception'=>$request->exception,
            'failed_at'=>$request->failed_at,]);
        $failed_jobs=new Failed_jobs;
        $failed_jobs->connection  = $request->connection;
        $failed_jobs->queue = $request->queue;
        $failed_jobs->payload = $request->payload;
        $failed_jobs->exception = $request->exception;
        $failed_jobs->save();

        $response = [
            'success' => true,
            'message' => null,
            'data' => $failed_jobs
        ];
        return response($response);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Failed_jobs $failed_jobs)
    {
        $response = [
            'success' => true,
            'message' => null,
            'data' => $failed_jobs
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
    public function update(Request $request, Failed_jobs $failed_jobs)
    {
        if(!$failed_jobs)
        {
            $response = [
                'success' => false,
                'message' => 'post not found',
                'data' => null,
            ];
            return response($response);
        }

        $failed_jobs->connection  = $request->connection;
        $failed_jobs->queue = $request->queue;
        $failed_jobs->payload = $request->payload;
        $failed_jobs->exception = $request->exception;
        $failed_jobs->save();
        $response = [
            'success' => true,
            'message' => null,
            'data' => $failed_jobs,
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
        $data =Failed_jobs::findorFail($id);
        $data->delete();
        $response = [
            'success' => true,
            'message' => null,
        ];
    }
}
