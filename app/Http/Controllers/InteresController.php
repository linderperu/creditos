<?php

namespace SisCredito\Http\Controllers;

use Illuminate\Http\Request;
use SisCredito\Http\Requests;
use SisCredito\Interes;
use Illuminate\Support\Facades\Redirect;
use SisCredito\Http\Requests\InteresFormRequest;

use DB;

class InteresController extends Controller
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
    		$interes=DB::table('interes')
			->where('tipopago','LIKE','%'.$query.'%')				
    		->orderBy('idinteres','asc')
    		->paginate(3);
    		return view('mantenimiento.interes.index',["interes"=>$interes,"searchText"=>$query]);

    	}   
     }
    public function create()
    {
    	return view("mantenimiento.interes.create");
    }
    public function store(InteresFormRequest $request)
    {   
    	$interes=new Interes;
    	$interes->tipopago=$request->get('tipopago');
    	$interes->interes=$request->get('interes');
    	  	
    	$interes->save();
    	return Redirect::to('mantenimiento/interes');
	}
	
    public function show($id)
    {
    	return view("mantenimiento.interes.show",["interes"=>Interes::findOrFail($id)]);
    }
    public function edit($id)
    {
    	return view("mantenimiento.interes.edit",["interes"=>Interes::findOrFail($id)]);
	}
    public function update(InteresFormRequest $request,$id)
    {
    	$interes=Interes::findOrFail($id);
        $interes->tipopago=$request->get('tipopago');
    	$interes->interes=$request->get('interes');
    	  	
    	$interes->update();
    	return Redirect::to('mantenimiento/interes');
    }
    public function destroy($id)
    {
    	$interes=Interes::findOrFail($id);
    	$interes->destroy();
    	return Redirect::to('mantenimiento/interes');
    }
}
