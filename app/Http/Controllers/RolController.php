<?php

namespace SisCredito\Http\Controllers;

use Illuminate\Http\Request;
use SisCredito\Http\Requests;
use SisCredito\Rol;
use Illuminate\Support\Facades\Redirect;
use SisCredito\Http\Requests\RolFormRequest;
use DB;
class RolController extends Controller
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
    		$roles=DB::table('roles')
			->where('nombre','LIKE','%'.$query.'%')
			->where('condicion','1')  		
    		->orderBy('idrol','desc')
    		->paginate(3);
    		return view('mantenimiento.roles.index',["roles"=>$roles,"searchText"=>$query]);

    	}   
     }
    public function create()
    {
    	return view("mantenimiento.roles.create");
    }
    public function store(RolFormRequest $request)
    {   
    	$roles=new Rol;
    	$roles->nombre=$request->get('nombre');
    	$roles->descripcion=$request->get('descripcion');
    	$roles->condicion='1';    	
    	$roles->save();
    	return Redirect::to('mantenimiento/roles');
	}
	
    public function show($id)
    {
    	return view("mantenimiento.roles.show",["roles"=>Rol::findOrFail($id)]);
    }
    public function edit($id)
    {
    	return view("mantenimiento.roles.edit",["roles"=>Rol::findOrFail($id)]);
	}
    public function update(RolFormRequest $request,$id)
    {
    	$roles=Rol::findOrFail($id);
        $roles->nombre=$request->get('nombre');
    	$roles->descripcion=$request->get('descripcion');
		$roles->condicion=$request->get('condicion');
    	$roles->update();
    	return Redirect::to('mantenimiento/roles');
    }
    public function destroy($id)
    {
    	$roles=Rol::findOrFail($id);
    	$roles->condicion='0';
    	$roles->update();
    	return Redirect::to('mantenimiento/roles');
	}


}
