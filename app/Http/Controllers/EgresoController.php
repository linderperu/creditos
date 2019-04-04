<?php

namespace SisCredito\Http\Controllers;

use Illuminate\Http\Request;


use SisCredito\Http\Requests;
use SisCredito\Caja;
use SisCredito\Detallecaja;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use SisCredito\Http\Requests\DetallecajaFormRequest;
use Carbon\Carbon;

use DB;

class EgresoController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');
    }
    public function index(Request $request)
    {
    	$f2=$request->fechaFinal;

	if(! is_null ($request->fechaInicial) && ! empty($request->fechaInicial)&& ! is_null($request->fechaFinal)||!empty($request->fechaFinal)){

		$f1=$request->fechaInicial;
		

	}else{
        $f1 = $f2=Carbon::now('America/Lima')->toDateString();

    }
		
		if($request){

           
            $query2=trim($request->get('elecText'));
            $f1=trim($request->get('fechaInicial'));
			$f2=trim($request->get('fechaFinal'));
			$usuario=auth()->id();
                $detallecaja=DB::table('detallecaja as d')
				->join('caja as ca','d.idcaja','=','ca.idcaja')   				               
				->select('d.iddetallecaja','d.idcaja','d.monto','d.tipo','ca.fechaapertura','d.descripcion','d.iduser')
				->where('d.tipo',[$query2])
				->where('d.iduser',[$usuario])
                ->whereBetween('ca.fechaapertura', [$f1, $f2])
                ->orderBy('ca.fechaapertura','desc')
                ->paginate(10);
	

			
		 return view('procesos.egresos.index',["detallecaja"=>$detallecaja,"elecText"=>$query2,"fechaInicial"=>$f1,"fechaFinal"=>$f2]);
		}
}
  /* fin de codigo*/		
	  
    public function create()
    {

		
			$fechita=Carbon::now();
			$ff1=Carbon::today();
			
			$cajacre = DB::table('caja')
			->select('idcaja')
			->where('estado','=','Abierto')
			->whereBetween('fechaapertura', [$ff1,$fechita])
			->where('idempleado',auth()->user()->id)->get();

			$var=count($cajacre);
//dd($var);
			if($var=='0'){
				flash('No tiene caja abierto....! ')->warning();
				return redirect('procesos/egresos');
				}
				else
				{
					return view("procesos.egresos.create");
					
				}

    }
    public function store(DetallecajaFormRequest $request)
    {   
			$f2 = auth()->user()->id;
			$f1= date('Y-m-d');
			$caja=DB::table('caja')
			->select('idcaja','fechaapertura')
			->where('fechaapertura',$f1)
			->where('estado',"Abierto")
			->where('idempleado',$f2)
			->get();
			

//dd($f2,'  la consulta  ',$caja[0]->idcaja);

 		$detallecaja=new Detallecaja;
		$detallecaja->monto=$request->get('monto');
		$detallecaja->tipo="E";
		$detallecaja->descripcion=$request->get('descripcion');
		$detallecaja->idcaja=$caja[0]->idcaja;
		$detallecaja->iduser=auth()->id();    	  	
    	$detallecaja->save();
		return Redirect::to('procesos/egresos');
		
		
	}
	
    public function show($id)
    {
    	return view("procesos.egresos.show",["ing"=>Detallecaja::findOrFail($id)]);
    }
    public function edit($id)
    {
    	return view("procesos.egresos.edit",["ing"=>Detallecaja::findOrFail($id)]);
	}
    public function update(DetallecajaFormRequest $request,$id)
    {
		$detallecaja=Detallecaja::findOrFail($id);
		
		$detallecaja->monto=$request->get('monto');
		$detallecaja->descripcion=$request->get('descripcion');
    	$detallecaja->iduser=auth()->id();    	  	  
    	$detallecaja->update();
    	return Redirect::to('procesos/egresos');
    }
    public function destroy($id)
    {
    	$detallecaja=Detallecaja::findOrFail($id);
    	$detallecaja->destroy();
    	return Redirect::to('procesos/egresos');
    }
}