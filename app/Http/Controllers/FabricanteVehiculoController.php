<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Fabricante;
use App\Vehiculo;

class FabricanteVehiculoController extends Controller
{
    public function __construct(){
        $this->middleware('auth.basic.once', ['on ly' => ['store', 'update', 'destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index($id)
    {   
        $fabricante = Fabricante::find($id);

        if(!$fabricante){
            return response() ->json(['mensaje' => 'No se encuentra este fabricante', 'codigo'=> 404], 404);
        }

        return response()->json(['datos' => $fabricante->vehiculos], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //fabricante_id
        //serie(autoincrementable) nose necesita
        //cilindraje
        //color
        //potencia
        //peso        
        if(!$request->input('color') || !$request->input('cilindraje') || !$request->input('potencia') || !$request->input('peso')){
            return response()->json(['mensaje' => 'No se pudieron procesar los valores','codigo' => 422], 422);
        }

        $fabricante = Fabricante::find($id);
        
        if(! $fabricante){
            return response()->json(['mensaje' => 'No existe el fabricante asociado','codigo' => 404], 404);
        }


        $fabricante->vehiculos()->create($request->all());

        return response()->json(['mensaje' => 'Vehiculo insertado'],201);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idFabricante, $idVehiculo)
    {
        $metodo = $request -> method();
         $fabricante = Fabricante::find($idFabricante);

         if(! $fabricante){
            return response()->json(['mensaje' => 'No se encuentra este fabricante', 'codigo' => 404], 404);
         }

         $vehiculo = $fabricante->vehiculos()->find($idVehiculo);

         if(! $vehiculo){
            return response()->json(['mensaje' => 'No se encuentra el vehiculo asociado a ese Fabricante', 'codigo' => 404], 404);
         }

         $color= $request ->input('color');
         $cilindraje= $request ->input('cilindraje');
         $potencia= $request ->input('potencia');
         $peso= $request ->input('peso');


        if($metodo === 'PATCH'){

            $bandera = false;

            if($color !=null && $color != ''){

            $vehiculo->color= $color;
            $bandera = true;

            }

            if($cilindraje !=null && $cilindraje != ''){

                $vehiculo->cilindraje= $cilindraje;
                $bandera = true;

            }
            if($potencia !=null && $potencia != ''){

                $vehiculo->potencia= $potencia;
                $bandera = true;

            }
            if($peso !=null && $peso != ''){

                $vehiculo->peso= $peso;
                $bandera = true;

            }

            if ($bandera) {
               
            $vehiculo->save();

           return response()->json(['mensaje' => 'vehiculo editado'], 200); 
            }

            return response()->json(['mensaje' => 'No se modifico ningun vehiculo', 'codigo'], 200);

        }


        if (!$color  || !$cilindraje || !$potencia || !$peso) {
            return response()->json(['mensaje' => 'No podemos procesar los valores', 'codigo' => 422], 422);
        }
        $vehiculo->color= $color;
        $vehiculo->cilindraje= $cilindraje;
        $vehiculo->potencia= $potencia;
        $vehiculo->peso= $peso;

        $vehiculo->save();

        return response()->json(['mensaje' => 'vehiculo editado'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idFabricante, $idVehiculo)
    {
        $fabricante = Fabricante::find($idFabricante);

        if (!$fabricante) {
            return response()->json(['mensaje' => 'No se encuentra este fabricante', 'codigo' => 404], 404);
        }

        $vehiculo=$fabricante->vehiculos()->find($idVehiculo);

        if (!$vehiculo) {
            return response()->json(['mensaje' => 'No se encuentra este vehiculo asociado a ese fabricante', 'codigo' => 404], 404);
        }

        $vehiculo->delete();

        return response()->json(['mensaje' => 'Vehiculo eliminado'], 200);


    }
}
