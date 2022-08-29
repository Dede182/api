<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */


    public function stockstatus($amount){
        $status = "";
        if($amount > 10){
            $status = "avaiable";
        }
        else if($amount >0){
            $status = "few";
        }
        else if($amount === 0){
            $status = "out of stock";
        }
        return $status;
    }


    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
            'stock status' => $this->stockstatus($this->stock),
            'date' => $this->created_at->format("d M Y"),
            'time' => $this->created_at->format("H:i A"),
            'owner' => $this->user->name,
            'user' => new UserResource($this->user),
            'photos' => PhotoResource::collection($this->photos),
            // 'photo' => $this->photos
            // 'photo' => new PhotoResource($this->photos)
        ];
    }
}
