<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Denuncia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class DenunciasController extends Controller
{
    public function index()
    {
        $denuncias = Denuncia::orderBy("titulo")->get();
	    
	    return $denuncias;
    }
    
        public function store(Request $request)
    {
        try
        {
            if(!$request->has('titulo') || !$request->has('usuarios_id'))
            {
                throw new \Exception('Se esperaba campos mandatorios');
            }
            
            $denuncia = new Denuncia();
            $denuncia->titulo = $request->get('titulo');
    		$denuncia->descripcion = $request->get('descripcion');
    		$denuncia->usuarios_id = $request->get('usuarios_id');
    		
    		if($request->hasFile('imagen') && $request->file('imagen')->isValid())
    		{
        		$imagen = $request->file('imagen');
        		$filename = $request->file('imagen')->getClientOriginalName();
        		
        		Storage::disk('images')->put($filename,  File::get($imagen));
        		
        		$denuncia->imagen = $filename;
    		}
    		
    		$denuncia->save();
    	    
    	    return response()->json(['type' => 'success', 'message' => 'Registro completo'], 200);
    	    
    }catch(\Exception $e)
    {
          return response()->json(['type' => 'error', 'message' => $e->getMessage()], 500);
        }
    }


}
