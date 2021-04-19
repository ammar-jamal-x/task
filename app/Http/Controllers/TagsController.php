<?php

namespace App\Http\Controllers\api;

use App\Models\Tag;
use App\Models\tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Tag::all();
        return response($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'username'=>'required',
            'email'=>'required'
        ]);


        $insert = new Tag();
        $insert->name = $request->name;
        $insert->username = $request->username;
        $insert->email = $request->email;
        $insert->about = $request->about;
        $insert->birth_date = $request->gbirth_date;
        $insert->gender = $request->gender;
        $insert->verified = $request->verified;
        $insert->email_verified_at = $request->email_verified_at;
        $insert->password = $request->password;
        $insert->remember_token = $request->remember_token;
        $insert->created_at = $request->created_at;
        $insert->updated_at = $request->updated_at;
        $insert->is_admin = $request->is_admin;
        $insert->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function show(tags $tags)
    {
        $data =Tag::find($tags);
        return response($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function edit(tags $tags)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tags $tags)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function destroy(tags $tags)
    {
        //
    }
}
