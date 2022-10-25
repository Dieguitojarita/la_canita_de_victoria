<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Gate;

class ReservaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // Obtener todos los registros 
        $reservas = Reserva::all();

         // enviar a la vista
        return view('reservas.index', compact('reservas'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $datosReserva = $request->except('_token');
        // if($request->hasFile('foto'))
        // {
        //     $datosReserva['foto'] = $request->file('foto')->store('uploads', 'public');
        // }
        // Reserva::insert($datosReserva);

        // return redirect()->route('reservas.index')->with('exito', '¡El registro se ha creado satisfactoriamente!');

        $request->validate([
            'nombre' => 'required', 'descripcion' => 'required', 'unidades' => 'required', 'precio' => 'required', 'foto' => 'required|image|mimes:jpg,png,svg|max:1024'
        ]);
        $Reserva = $request->all();
        
        if($foto = $request->file('foto')){
            $rutaFoto = 'imagen/';
            $fotoReserva = date('YmdHis'). "." . $foto->getClientOriginalExtension();
            $foto->move($rutaFoto, $fotoReserva);
            $Reserva['foto'] = "$fotoReserva";
        }
        Reserva::create($Reserva);
        return redirect()->route('reservas.index')->with('exito', '¡El registro se ha creado satisfactoriamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserva  $Reserva
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $Reserva = Reserva::findOrFail($id);
        
        return view('reservas.show', compact('Reserva'));                                        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reserva  $Reserva
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('administrador'))
        {
            // este signfica abortar -- abort(403);
            return redirect()->route('reservas.index');
        }
        $Reserva = Reserva::findOrFail($id);
        

        return view('reservas.edit', compact('Reserva'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserva  $Reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Reserva = Reserva::findOrFail($id);
        $datosReserva = $request->except('_token', '_method');
        if($request->hasFile('foto'))
        {
            Storage::delete('public/' . $Reserva->foto);
            $datosReserva['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        $Reserva->where('id' , $id)->update($datosReserva);
        return redirect()->route('reservas.index')->with('exito', '¡El registro se ha modificado satisfactoriamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserva  $Reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('administrador'))
        {
            // este signfica abortar -- abort(403);
            return redirect()->route('reservas.index');
        }
        $Reserva = Reserva::findOrFail($id);
        if(Storage::delete('public/' . $Reserva->foto))
        {
            $Reserva->delete();
        }
        $Reserva->delete();
        return redirect()->route('reservas.index');
    }
}
