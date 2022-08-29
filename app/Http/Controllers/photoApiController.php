<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class photoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photo = Photo::latest('id')->get();
        return response()->json($photo);
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
            'products_id' => 'required|exists:products,id',
            'photos' =>'required',
            'photos.*' => 'required|mimes:png,jpg,max:2000'
        ]);

        foreach($request->file('photos') as  $photo){
            $newName = $photo->store('public');
            Photo::create([
                'products_id' => $request->products_id,
                'name' => $newName
            ]);
        };
        return response()->json(['message'=>'success']);
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $photo = Photo::find($id);
        if(is_null($photo)){
            return response()->json(['message'=>'product is not found'],404);
        }
            Storage::delete('public/', $photo->name);
        $photo->delete();
        return response()->json([]);
    }
}
