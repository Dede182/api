<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Photo;
use App\Models\Products;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isNull;

class productsApiController extends Controller
{
    public function __construct()
    {
        sleep(0);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::latest('id')->paginate(10);
        // return response()->json($products,200);
        return ProductResource::collection($products);
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
            'price'=>'required|numeric',
            'stock'=>'required|numeric',
            'photos' =>'nullable',
            'photos.*' => 'nullable|mimes:png,jpg,max:2000'
        ]);

        $products = Products::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'stock'=>$request->stock,
            'user_id' => Auth::id()
        ]);

        $photos = [];
        foreach($request->file('photos') as $key=>$photo){
                $newName = $photo->store('public');
                $photos[$key] = new Photo(['name' => $newName]);
        };
        $products->photos()->saveMany($photos);
        return response()->json([
            "message"=>"product is added",
            "product" => new ProductResource($products),
            "success" => true
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
        $product = Products::find($id);
        if(is_null($product)){
            return response()->json(["message" => "Prodcts is not found"],404);
        };
        return new ProductResource($product);
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
            'name'=>'nullable|min:1',
            'price'=>'nullable|min:1|numeric',
            'stock'=>'nullable|min:1|numeric',
            ''
        ]);

        $product = Products::find($id);
        if(is_null($product)){
            return response()->json(["message" => "Products is not found"],404);
        };
        if($request->has('name')){
            $product->name = $request->name;
       }
       if($request->has('age')){
           $product->price = $request->price;
       }
       if($request->has('netWorth')){
           $product->stock = $request->stock;
       }
        $product->update();
        return response()->json([
            'success' => true,
            'product' => new ProductResource($product),
            "message" => "product is updated"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::find($id);

        if(is_null($product)){
            return response()->json(["message" => "Products is not found"],404);
        };
        // return response()->json(['message' => "you are here"]);
        $product->delete();
        return response()->json(["message" => "Products is  deleted"]);
    }
}
