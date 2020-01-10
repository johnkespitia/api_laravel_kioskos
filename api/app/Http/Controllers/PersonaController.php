<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use DB;

use App\Persona;
class PersonaController extends Controller
{
    public function obtenerTiposDocumentos()
    {
        $tiposDocumento = DB::select('CALL listadoTiposDocumento');
        return response()->json($tiposDocumento, 201);
    }
    public function personas()
    {
        $personas = DB::select('CALL listadoPersonas');
        return response()->json($personas, 201);
    }
 
    public function obtenerPersona($cedula)
    {
        $persona = DB::select('CALL obtenerPersona(?)',array($cedula));
        return response()->json($persona, 201);
    }

    public function nuevo(Request $request)
    {
        $persona = DB::select('CALL nuevaPersona(?,?,?,?,?,?)',
        array($request->cedula,$request->tipo_documento,$request->p_nombre,$request->s_nombre,$request->p_apellido,$request->s_apellido));
        return response()->json($persona, 201);
    }

    public function editar(Request $request)
    {
        $persona = DB::select('CALL editarPersona(?,?,?,?,?,?,?)',
        array($request->cedulaAnterior,$request->cedulaNueva,$request->tipo_documento,$request->p_nombre,$request->s_nombre,$request->p_apellido,$request->s_apellido));
        return response()->json($persona, 201);
    }

    public function eliminar($cedula)
    {
        $persona = DB::select('CALL eliminarPersona(?)',array($cedula));
        return response()->json($persona, 201);
    }
}
