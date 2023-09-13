<?php

namespace App\Http\Controllers;

use App\Trabajadores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrabajadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //                    Select * from Trabajadores   
        $datos['trabajadores']=Trabajadores::orderBy('apellido', 'asc')
        ->paginate(10);

        return view('trabajadores.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trabajadores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campo=[
                'nombre'=>'required|string|max:30',
                'apellido'=>'required|string|max:30',
                'correo'=>'required|max:100|email',
                'foto'=>'required|max:1000|mimes:jpeg,png,jpg'
                ];
        $mensaje=[
                'required'=>' El campo :attribute es requerido',
                'string' =>'Este campo debe contener mínimo :min caraceres'
        ];
        $this->validate($request,$campo,$mensaje);
        $datosTrabajadores=request()->except(['_token']);

        if($request->hasFile('foto')){
            $datosTrabajadores['foto']=$request->file('foto')->store('images/trabajadores','public');
        }

        //Para ingresar los datos del fromulario en la base de datos
        
        Trabajadores::insert($datosTrabajadores);
        return redirect('trabajadores')->with('Ingresado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trabajadores  $trabajadores
     * @return \Illuminate\Http\Response
     */
    public function show(Trabajadores $trabajadores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trabajadores  $trabajadores
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trabajador=Trabajadores::findOrFail($id);

        return view('trabajadores.edit',compact('trabajador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trabajadores  $trabajadores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $campo=[
                'nombre'=>'required|string|max:30',
                'apellido'=>'required|string|max:30',
                'correo'=>'required|max:100|email'
                ];
        $mensaje=[
                'required'=>' El campo :attribute es requerido'
        ];

        if($request->hasFile('foto')){
            $campo+=['foto'=>'required|max:1000|mimes:jpeg,png,jpg'];
            $mensaje+=['mimes'=>':attribute solo admite jpge,jpg,png'];
        }
        $this->validate($request,$campo,$mensaje);

        $datosTrabajadores=Request()->except(['_token','_method']);

        if($request->hasFile('foto')){
            $trabajador=Trabajadores::findOrFail($id);
            Storage::disk('public')->delete($trabajador->foto);
            //subir la nueva fotografia al servidor
            $datosTrabajadores['foto']=$request->file('foto')->store('images/trabajadores','public');
        }

        Trabajadores::where('id','=',$id)->update($datosTrabajadores);

        return redirect('trabajadores')->with('Mensaje','Trabajdor se editó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trabajadores  $trabajadores
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trabajador=Trabajadores::findOrFail($id);
        //eliminar imagen asosicada al registro a eliminar

        if(Storage::disk('public')->delete($trabajador->foto)){
            Trabajadores::destroy($id);
        }

        

        return redirect('trabajadores')->with('Mensaje','Se eliminó correctamente');
    }
}
