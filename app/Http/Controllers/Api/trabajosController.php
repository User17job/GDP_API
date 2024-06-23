<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Trabajos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class trabajosController extends Controller
{
    public function getT()
    {
        $trabajos =  Trabajos::all();
        if(!$trabajos){
            return response()->json(['mensaje'=>'No hay trabajos'],404);
        }
        $data = [
            'trabajos'=>$trabajos,
            'status'=>200
        ];
        return response()->json($data, 200);
    }
    public function get1T($id)
    {
        $trabajos =  Trabajos::find($id);
        if(!$trabajos){
            return response()->json(['mensaje'=>'NO se encontro este trabajo'],404);
        }

        $data = [
            'trabajo'=>$trabajos,
            'status' =>200
        ];
        return response()->json($data,200);
    }

    public function postT(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre'      => 'required|string|max:35|unique:trabajos',
            'descripcion' => 'required|string',
            'herramientas'=> 'required',
            'imagen_url'  => 'required|unique:trabajos',
            'link'        => 'required|unique:trabajos',
            'name'        => 'required|string|max:35|unique:trabajos',
            'description' => 'required',
            'by'          => 'required'
        ]);
        if($validator->fails()){
            $data = [
                'message' => 'Error al crear el trabajo',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $trabajos = Trabajos::create([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'herramientas'=> $request->herramientas,
            'link'        => $request->link,
            'imagen_url'  => $request->imagen_url,
            'name'        => $request->name,
            'description' => $request->description,
            'by'          => $request->by
        ]);
        #confirmar que el trabajo se a creado
        if(!$trabajos){
            return response()->json(['message' => 'Error creating project'], 500);
        }
        $data = [
            'message' => 'trabajo creado correctamente',
            'trabajo' => $trabajos,
            'status' => 201
        ];
        return response()->json($data, 201);
    } 
    public function putT(Request $request, $id)
    {
        $trabajos = Trabajos::find($id);
        if(!$trabajos){
            return response()->json(['message' => 'Trabajo no encontrado'], 404);
        }
        $validator = Validator::make($request->all(), [
            'nombre'      => 'required|string|max:35',
            'descripcion' => 'required|string',
            'herramientas'=> 'required',
            'imagen_url'  => 'required',
            'link'        => 'required',
            'name'        => 'required|string|max:35',
            'description' => 'required',
            'by'          => 'required'
        ]);
        if($validator->fails()){
            $data = [
                'message' => 'Error al actualizar el trabajo',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $trabajos->nombre      = $request->nombre;
        $trabajos->descripcion = $request->descripcion;
        $trabajos->herramientas= $request->herramientas;
        $trabajos->imagen_url  = $request->imagen_url;
        $trabajos->link        = $request->link;
        $trabajos->name        = $request->name;
        $trabajos->description = $request->description;
        $trabajos->by          = $request->by;
        $trabajos->save();
        $data = [
            'message' => 'Trabajo actualizado correctamente',
            'trabajo' => $trabajos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    public function patchT(Request $request, $id)
    {
        $trabajos = Trabajos::find($id);
        if(!$trabajos){
            return response()->json(['message' => 'Trabajo no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre'      => 'min:3|string|max:35',
            'descripcion' => 'min:3|string',
            'herramientas'=> 'min:3',
            'imagen_url'  => 'min:3',
            'link'        => 'min:3',
            'name'        => 'min:3|string|max:35',
            'description' => 'min:3',
            'by'          => 'min:3'
        ]);  
        if($validator->fails()){
            $data = [
                'message' => 'Error al actualizar el trabajo',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if($request->has('nombre')){
            $trabajos->nombre = $request->nombre;
        }
        if($request->has('descripcion')){
            $trabajos->descripcion = $request->descripcion;
        }
        if($request->has('herramientas')){
            $trabajos->herramientas = $request->herramientas;
        }
        if($request->has('imagen_url')){
            $trabajos->imagen_url = $request->imagen_url;
        }
        if($request->has('link')){
            $trabajos->link = $request->link;
        }
        if($request->has('name')){
            $trabajos->name = $request->name;
        }
        if($request->has('description')){
            $trabajos->description = $request->description;
        }
        if($request->has('by')){
            $trabajos->by = $request->by;
        }
        $trabajos->save();

        $data = [
            'message' => 'Trabajo actualizado correctamente',
            'trabajo' => $trabajos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    public function deleteT($id)
    {
        $trabajos = Trabajos::find($id);
        if(!$trabajos){
            return response()->json(['mensaje'=>'No hay trabajos'],404);
        }
        $trabajos->delete();
        $data = [
            'message' => 'Trabajo eliminado correctamente',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

}
