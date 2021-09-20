<?php

namespace App\Http\Controllers;

use App\Category;
use Hamcrest\Core\IsNull;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class CategoryController extends Controller
{

    /**
        devuelve todas las categorias y filtra
     */
    public function index(Request $request)
    {
        $filter= $request->filter;

        $categories = Category::fcategory($filter)->get();


        if(sizeof($categories)===0){
            return response()->json(['code'=>200,
                'response'=>'No se encontraron categorias'
            ]);
        }else{
            return $categories;
        }
    }
    /**
        guarda una nueva categoria
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'description'=>'required'
            ]);


        $data= $request->all();
        Category::create($data);

        return response()->json([
            'code'=> 201,
            'msg'=>'categoria agregada  satisfactoriamente'
        ]);
    }
    /**
    Actualiza una categoria
     */
    public function update(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'description'=>'required'
            ]);
        Category::find($request->id)->update($request->all());
        return response()->json([
            'status'=>'categoria editada'
        ]);
    }
    /**
    Elimina una catgoria
     */
    public function destroy($id)
    {
        $categories=Category::find($id);
            if(!$categories){
                return response()->json([
                    'errors'=>'No se encuentra ninguna categoria']);
            }
            else{
                $products=$categories->products;
                if(sizeof($products)>0)
                {
                    return response()->json([
                        'errors'=>array(['code'=>409,
                        'message'=>'Esta categoria  posee productos y no puede ser eliminado.'])]
                        ,409);

                }else{
                    $categories->delete();
                    return response()->json(['code'=>200,
                        'message'=>'categoria borrada'
                    ]);
                }
            }

    }

    /**
    muestra todos lo productos
     */
    public function categorieProducts($id)
    {
        $products= Category::find($id)->products;

        return $products;
    }

}
