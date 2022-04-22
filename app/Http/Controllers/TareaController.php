<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index','show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tareas = Tarea::with('etiquetas')
            ->with('user: name')
            ->with('user.domicilio')
            ->get();
        //$tareas = Auth::user()->tareas;
        return view('tareas.indexTareas', compact('tareas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $etiquetas = Etiqueta::all();
        return view('tareas.formTareas', compact('etiquetas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tarea' => 'required|min:5|max:255',
            'descripcion' => ['required','min:5'],
            'tipo' => 'required',
            'etiqueta_id' => 'required',
        ]);

        /*Forma 1: para usar con autenticación con usuarios
        $tarea = new Tarea();
        $tarea->user_id = Auth::id();
        $tarea->tarea = $request->tarea;
        $tarea->descripcion = $request->descripcion;
        $tarea->tipo = $request->tipo;
        $tarea->save();*/

        /*Forma 2: No es obligatoria la autenticación con usuarios
        $user = Auth::user();
        $user->tareas()->save($tarea);*/

        /*Forma 3: Usando un arreglo, si necesidad de poner save al
        final. Requiere agrega fillable en el modelo*/
        $request->merge([
            'user_id' => Auth::id()
        ]);
        $tarea = Tarea::create($request->all());
        $tarea->etiquetas()->attach($request->etiqueta_id);

        return redirect('/tarea');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function show(Tarea $tarea)
    {
        return view('tareas.showTarea',compact('tarea'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarea $tarea)
    {
        $etiquetas = Etiqueta::all();
        return view('tareas.formTareas',compact('tarea', 'etiquetas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarea $tarea)
    {
        $request->validate([
            'tarea' => 'required|min:5|max:255',
            'descripcion' => ['required','min:5'],
            'tipo' => 'required',
        ]);

        Tarea::where('id', $tarea->id)->update($request->except(['_token', '_method', 'etiqueta_id']));

        $tarea->etiquetas()->sync($request->etiqueta_id);

        /*$tarea->tarea = $request->tarea;
        $tarea->descripcion = $request->descripcion;
        $tarea->tipo = $request->tipo;
        $tarea->save();*/

        return redirect('/tarea');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return redirect('/tarea');
    }
}
