<?php

namespace App\Http\Controllers;

use App\Models\Reve;
use Illuminate\Http\Request;
use Prophecy\Prophecy\Revealer;

class reveApiContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reve = Reve::latest('id')->paginate(10);
        return response()->json($reve,200);
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
            'name' => "required",
            'age' =>"required|numeric",
            'netWorth' =>"required|numeric"
        ]);
        $Reve = Reve::create([
            "name"=>$request->name,
            "age"=>$request->age,
            "netWorth"=>$request->netWorth
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reve = Reve::find($id);
        if(!Reve::find($id)){
            return response()->json(["message" =>"Product is not found"],404);
        }
        return response()->json($reve);
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
        $request->validate([
            'name' => "nullable|min:1",
            'age' =>"nullable|min:1|numeric",
            'netWorth' =>"nullable|min:1|numeric"
        ]);
        $reve = Reve::find($id);
        if(is_null($reve)){
            return response()->json(['product is not found']);
        };
        if($request->has('name')){
             $reve->name = $request->name;
        }
        if($request->has('age')){
            $reve->age = $request->age;
        }
        if($request->has('netWorth')){
            $reve->netWorth = $request->netWorth;
        }

            $reve->update();
            return response()->json($reve);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reve = Reve::find($id);
        if(is_null($reve)){
            return response()->json(["message" => "reve is not found"],404);
        };
        $reve->delete();
        return response()->json(["message" => "reve is deleted"]);
    }
}
