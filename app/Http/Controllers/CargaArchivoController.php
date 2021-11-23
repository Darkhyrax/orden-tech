<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CargaArchivoController extends Controller
{
    public function index()
    {
        $archivos = array_diff(scandir(public_path().'/files'), array('..', '.'));
        return view('carga_archivo.index',compact('archivos'));
    }

    public function carga(Request $request)
    {
        $this->validate($request, [
            'files'=>'required',
            'files.*' =>'mimes:pdf'
        ],
        ['files.required'=>'Debe agregar al menos un archivo']);

        if($request->hasfile('files'))
        {
            foreach($request->file('files') as $file)
            {
                $name = $file->getClientOriginalName();
                $file->move(public_path().'/files/', $name);  
            }
        }

        return redirect()->back()->with('flash_message',['success','Se han cargado los archivos correctamente']);
    }
}
