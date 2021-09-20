<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    static public function uploadImage(Request $request){

        $ruta=$request->file('file')->store('products','public');
        return $ruta;
    }

    static public function saveImage($data){

        Image::create($data);
         return response()->json([
            'code'=> 201,
            'msg'=>'imagen agregada  satisfactoriamente'
        ]);

    }
    static public function getImage($id){
        $images= Image::where('product_id',$id)->get();

        return $images;
    }
    static public function deleteImages($id){

        try {
            $images=Image::where('product_id',$id)->get();
            foreach ($images as $image ) {
            Storage::delete('public/'.$image->url);
            $image->delete();
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }

        return'';
    }

}
