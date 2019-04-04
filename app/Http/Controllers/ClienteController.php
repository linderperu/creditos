<?php

namespace SisCredito\Http\Controllers;

use Illuminate\Http\Request;

use SisCredito\Http\Requests;
use SisCredito\Persona;
use Illuminate\Support\Facades\Redirect;
use SisCredito\Http\Requests\PersonaFormRequest;
use DB;
class ClienteController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');
    }
    public function index(Request $request)
    {
    	if ($request)
    	{
    		$query=trim($request->get('searchText'));
    		$personas=DB::table('persona')
			->where('nombres','LIKE','%'.$query.'%')
			->where('condicion','=','NORMAL')
			->orwhere('dniruc','LIKE','%'.$query.'%')
			->where('condicion','=','NORMAL')				
    		->orderBy('nombres','asc')
    		->paginate(7);
    		return view('mantenimiento.clientes.index',["personas"=>$personas,"searchText"=>$query]);

    	}   
     }
    public function create()
    {
    	return view("mantenimiento.clientes.create");
    }
    public function store(PersonaFormRequest $request)
    { //Cliente es el modelo Cliente.php
		$persona= new Persona;
		$persona->tipo_persona='Cliente';
		$persona->nombres=$request->get('nombres');
		$persona->tipo_documento=$request->get('tipo_documento');
    	$persona->dniruc=$request->get('dniruc');
    	$persona->celular=$request->get('celular');
    	$persona->correo=$request->get('correo');
    	$persona->direccion=$request->get('direccion');
    	$persona->distrito=$request->get('distrito');
    	$persona->provincia=$request->get('provincia');
		$persona->departamento=$request->get('departamento');
		$persona->condicion='NORMAL';
    	
    	$persona->save();
    	return Redirect::to('mantenimiento/clientes');
    }
    public function show($id)
    {
    	return view("mantenimiento.clientes.show",["persona"=>Persona::findOrFail($id)]);
    }
    public function edit($id)
    {
    	return view("mantenimiento.clientes.edit",["persona"=>Persona::findOrFail($id)]);
	}
    public function update(PersonaFormRequest $request,$id)
    {
    	$persona=Persona::findOrFail($id);
		$persona->tipo_persona='Cliente';
		$persona->nombres=$request->get('nombres');
		$persona->tipo_documento=$request->get('tipo_documento');
    	$persona->dniruc=$request->get('dniruc');
    	$persona->celular=$request->get('celular');
    	$persona->correo=$request->get('correo');
    	$persona->direccion=$request->get('direccion');
    	$persona->distrito=$request->get('distrito');
    	$persona->provincia=$request->get('provincia');
		$persona->departamento=$request->get('departamento');
		$persona->condicion='NORMAL';
    	
    	$persona->update();
    	return Redirect::to('mantenimiento/clientes');
    }
    public function destroy($id)
    {
			
    	$persona=Persona::findOrFail($id);
    	$persona->condicion='MOROSO';
    	$persona->update();
    	return Redirect::to('mantenimiento/clientes');
    }
}
