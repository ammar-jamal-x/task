<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Job::paginate(5);
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
            'queue' => 'required',
            'payload' => 'required',
        ]);
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()->all()], 422);


        $insert=new Job;
        $insert->queue =$request->queue;
           $insert->payload=$request->payload;
          $insert->attempts=$request->attempts;
          $insert->reserved_at=$request->reserved_at;
          $insert->available_at=$request->available_at;
          $insert->created_at=$request->created_at;


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
    public function show(Job $jop)
    {
        $response = [
            'success' => true,
            'message' => null,
            'data' => $jop
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
    public function update(Request $request, Job $jop)
    {
        if(!$jop)
        {
            $response = [
                'success' => false,
                'message' => 'post not found',
                'data' => null,
            ];
            return response($response);
        }

        $jop->queue  = $request->queue;
        $jop->payload = $request->payload;
        $jop->attempts = $request->attempts;
        $jop->reserved_at = $request->reserved_at;
        $jop->available_at = $request->available_at;
        $jop->created_at = $request->created_at;
        $jop->save();
        $response = [
            'success' => true,
            'message' => null,
            'data' => $jop,
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
        $data =Jop::findorFail($id);
        $data->delete();
        $response = [
            'success' => true,
            'message' => null,
        ];
        return response($response);
    }
}
