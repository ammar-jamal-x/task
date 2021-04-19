<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::with(['childCategory'=> function ($query)
                 {$query->select(['id','name','name_ar','parent_to']);}])
            ->where('parent_to','0')
            ->get(['id','name','name_ar']);


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
            'name' => 'required',
            'name_ar' => 'required',
            'parent_to' => 'required',
        ]);
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()->all()], 422);

        $insert=Categorie::create(['name' =>$request->name,
            'name_ar'=>$request->name_ar,
            'parent_to'=>$request->parent_to]);

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
    public function show(Categorie $categorie)
    {
        $response = [
            'success' => true,
            'message' => null,
            'data' => $categorie
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
    public function update(Request $request, Categorie $categorie)
    {
        if(!$categorie)
        {
            $response = [
                'success' => false,
                'message' => 'post not found',
                'data' => null,
            ];
            return response($response);
        }

        $categorie->name  = $request->name;
        $categorie->name_ar = $request->name_ar;
        $categorie->parent_to = $request->parent_to;
        $categorie->save();
        $response = [
            'success' => true,
            'message' => null,
            'data' => $categorie,
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
        $data =Categorie::findorFail($id);
        $data->delete();
        $response = [
            'success' => true,
            'message' => null,
        ];
        return response($response);
    }
}
