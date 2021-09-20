<?php

namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter= $request->filter;
        $providers=Provider::Fprovider($filter)->get();
        if(sizeof($providers)===0){
            return response()->json([
                'response'=>'no se encontraron provedores'
            ]);
        }else{
            return $providers;
        }


    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'phone'=>'required|max:14',
                'email'=>'required|email',

            ]);
        $data= $request->all();
        Provider::create($data);

        return response()->json([
            'res'=> true,
            'msg'=>'Provedor agregado  satisfactoriamente'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'phone'=>'required|max:14',
                'email'=>'required|email',
            ]);
        Provider::find($request->id)->update($request->all());
        return response()->json([
            'status'=>'Provedir editada'
        ]);
    }



    public function destroy($id)
    {
        $providers=Provider::find($id);
        if(!$providers){
            return response()->json([
                'errors'=>'No se encuentra ningun provedor']);
        }else{
            $products=$providers->products;
                if(sizeof($products)>0)
                {
                    return response()->json([
                        'errors'=>array(['code'=>409,
                        'message'=>'Este provedor  posee productos y no puede ser eliminado.'])]
                        ,409);


        }else{
            $providers->delete();
            return response()->json([
                'status'=>'provedor borrado'
            ]);
        }
    }
    }

    public function Providerprodutcs($id){

        $products= Provider::find($id)->products;
        if(isNull($products)){
            return response()->json([
                'response'=>'no se encontraron provedores'
            ]);
        }else{
            return $products;
        }



    }
}
