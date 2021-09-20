<?php

namespace App\Http\Controllers;

use App\Image;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function newProduct ( Request $request){

        $request->validate([
            'name' => 'required|max:255',
            'stock'=> 'required|numeric|gt:0',
            'price'=> 'required|numeric',
            'status'=>'required',
            'category_id'=>'required',
            'providers_id'=>'required'
            ]);

        $data=[
        'name'=>$request->name,
        'stock'=>$request->stock,
        'price'=>$request->price,
        'status'=>$request->status,
        'category_id'=>$request->category_id,
        'providers_id'=>$request->providers_id
        ];
        $product=Product::create($data);
        $ruta= ImageController::uploadImage($request);
        $imagedb=[
            'url'=>$ruta,
            'status'=>'P',
            'product_id'=> $product->id
        ];
        ImageController::saveImage($imagedb);

        return response()->json([
            'code'=> 201,
            'msg'=>'Producto agregado  satisfactoriamente'
        ]);
    }
    public function imageProduct(Request $request){

        $ruta= ImageController::uploadImage($request);
        $imagedb=[
            'url'=>$ruta,
            'status'=>'S',
            'product_id'=>$request->id
        ];
        ImageController::saveImage($imagedb);


    }
    public function editProduct (Request $id, $request){
        $request->validate([
            'name' => 'required|max:255',
            'stock'=> 'required|numeric',
            'price'=> 'required|numeric',
            'status'=>'required',
            'category_id'=>'required',
            'providers_id'=>'required'
            ]);

        Product::find($id)->update($data=[
        'name'=>$request->name,
        'stock'=>$request->stock,
        'price'=>$request->price,
        'status'=>$request->status,
        'category_id'=>$request->category_id,
        'providers_id'=>$request->providers_id
        ]);

        return response()->json([
            'code'=> 201,
            'msg'=>'Producto Editado  satisfactoriamente'
        ]);

    }
    public function stockProduct(Request $id, $request){
        $product= Product::find($id);
        $request->validate([
            'stock'=>  'required|numeric'
        ]);

        if ($product->stock <= 0) {
            if( $product->status  !== 'NO STOCK') {$product->status === 'NO STOCK';}
        } else {
            if ($request->stock === 0) {$product->status === 'NO STOCK';}
            else {
                $product->stock = $request->stock;
            }
        }

        $product->save();

        return response()->json([
            'code'=> 201,
            'msg'=>'Producto Actualizado satisfactoriamente su esta es '.$product->status
        ]);
    }
    public function allProducts(Request $request){
        $filter= $request->filter;
        $products = Product::fproduct($filter)->get();

        if (sizeof($products)===0) {
            return response()->json(['code'=>200,
            'response'=>'No se encontraron Productos'
        ]);
        } else {
            return $products;
        }

    }
    public function getImagesProduct($id){
        $images=ImageController::getImage($id);
        return $images;
    }
    public function deleteProduct($id){
        $product=Product::find($id);
        if(!$product){
            return response()->json([
                'errors'=>'No se encuentro ningun producto con ese id']);

        }else{

            if (ImageController::deleteImages($id)) {
                $product->delete();
                return response()->json(['code'=>200,
                    'message'=>'Producto borrado'
                ]);
            } else {
                return response()->json([
                    'errors'=>'Error al eliminar las imagenes asociadas']);
            }



        }


    }
    public function product($id){
        $product = Product::fproduct($id)->get();

        if (sizeof($product)===0) {
            return response()->json(['code'=>200,
            'response'=>'No se encontraron Productos'
        ]);
        } else {
            return $product;
        }
    }

}
