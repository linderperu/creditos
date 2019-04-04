<?php

namespace SisCredito\Http\Controllers;

use Illuminate\Http\Request;

use SisCredito\Http\Requests;
use SisCredito\Caja;
use SisCredito\Detallemoneda;
use SisCredito\Detallecaja;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use SisCredito\Http\Requests\CajaFormRequest;
use Carbon\Carbon;
use Laracast\Flash\Flash;
//use Flash;
use DB;
use PDF;


use Response;
use Illuminate\Support\Collection;


class CajaController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');
    }
    public function index(Request $request)
    {
		$f1 = $f2 = date('Y-m-d');
		
//aqui recibe los datos de la fecha
	if(! is_null ($request->fechaInicial) && ! empty($request->fechaInicial)&& ! is_null($request->fechaFinal)||!empty($request->fechaFinal)){

		$f1=$request->fechaInicial;
		$f2=$request->fechaFinal;

		//dd($f1,"final fecha",$f2);
	}
	else{
		$f2=Carbon::now('America/Lima')->toDateString();
		$f1=Carbon::today();
	//	$f1=$f1->subDay(10);		

	
	}
//dd($f1); aqui mostramos codigo de depuracion
	$userr=auth()->user()->idrol;
	if ($userr =='2'||$userr =='3'){
		if($request){
				$query=trim($request->get('searchText'));	

					$f1=trim($f1);
					$f2=trim($f2);
			$caja=DB::table('caja as c')
			->join('users as e','c.idempleado','=','e.id')
			->join('roles as r','r.idrol','=','e.idrol')						
			->select('c.idcaja','e.name','r.nombre','e.email','c.montoapertura','c.montocierre','c.montocorregido','c.fechaapertura','c.fechacierre','c.estado', 'c.observaciones')
			->whereBetween('fechaapertura', [$f1,$f2])			
			->orderBy('c.idcaja','desc')
			->paginate(7);
			//->where('c.estado','=','Abierto')
	//
	  } 

	}else{
	//dd($f1);	
		if($request){
			$query=trim($request->get('searchText'));	

			$f1=trim($f1);
			$f2=trim($f2);
			$caja=DB::table('caja as c')
			->join('users as e','c.idempleado','=','e.id')
			->join('roles as r','r.idrol','=','e.idrol')						
			->select('c.idcaja','e.name','r.nombre','e.email','c.montoapertura','c.montocierre','c.montocorregido','c.fechaapertura','c.fechacierre','c.estado', 'c.observaciones')
			->whereBetween('fechaapertura', [$f1,$f2])			
			->where('c.idempleado',auth()->user()->id)
			->orderBy('c.idcaja','desc')			
			->paginate(7);
			
			
	  } 
	 }
	 $cajaid = DB::table('caja')
	 ->select('idcaja')
	 ->where('fechaapertura','=', date('Y-m-d'))
	 ->where('idempleado',auth()->user()->id)->get();
	$query3=0;
	 foreach ($cajaid as $ca){
		$ID=$ca->idcaja;
		$query1 = DB::table('detallecaja')	
					->where('idcaja','=',$ID)
					->where('tipo','=','I')
					->where('iduser',auth()->user()->id)
					->sum('monto');

				$query2 = DB::table('detallecaja')	
					->where('idcaja','=',$ID)
					->where('tipo','=','E')
					->where('iduser',auth()->user()->id)
					->sum('monto');
					
					$query3=$query1-$query2;
					

	 }
	
	 return view('procesos.caja.index',["caja"=>$caja,"searchText"=>$query,"fechaInicial"=>$f1,"fechaFinal"=>$f2,'query3'=>$query3]);

}
	/* fin de codigo*/	    	
     
    public function create()
		{ 
		//	$fechita= new Carbon ('yesterday');
		$fechita=Carbon::now();
			$ff1="12/01/2018";
			
			$cajacre = DB::table('caja')
			->select('idcaja')
			->where('estado','=','Abierto')
			->whereBetween('fechaapertura', [$ff1,$fechita])
			->where('idempleado',auth()->user()->id)->get();

			$var=count($cajacre);

			if($var=='0'){
			return view("procesos.caja.create");
				}
				else
				{
					flash('Caja abierta ...cierra buscando con fechas pasadas')->important();
					return redirect('procesos/caja');
				}

    }
    public function store(CajaFormRequest $request)
	{ //Caja es el modelo Caja.php
		try{
			DB::beginTransaction();
			$caja= new Caja();
			$caja->idempleado=auth()->user()->id;
			$caja->montoapertura=$request->get('montoapertura');
			/*$caja->montocierre='0';
			$caja->montocorregido='0';*/
			
			$caja->fechaapertura=Carbon::now('America/Lima')->toDateString();
		//	$caja->fechacierre='';
			$caja->estado='Abierto';
			$caja->observaciones=$request->get('observaciones');			
			$caja->save();

			$idcaja=$caja->idcaja;
			$moneda= new Detallemoneda();
			$moneda->idcaja=$idcaja;
			$moneda->diezcentimos=$request->get('diezcentimos');
			$moneda->veintecentimos=$request->get('veintecentimos');
			$moneda->cincuentacentimos=$request->get('cincuentacentimos');
			$moneda->unsol=$request->get('unsol');
			$moneda->dossoles=$request->get('dossoles');
			$moneda->cincosoles=$request->get('cincosoles');
			$moneda->diezsoles=$request->get('diezsoles');
			$moneda->veintesoles=$request->get('veintesoles');
			$moneda->cincuentasoles=$request->get('cincuentasoles');
			$moneda->ciensoles=$request->get('ciensoles');
			$moneda->doscientos=$request->get('doscientos');
			$moneda->save();

			$detallecaja= new Detallecaja();			
			$detallecaja->monto=$request->get('montoapertura');
			$detallecaja->tipo="I";
			$detallecaja->descripcion='Apertura de caja';
			$detallecaja->idcaja=$idcaja;
			$detallecaja->iduser=auth()->id();    	  	
    		$detallecaja->save();

			DB::commit();


		}catch(\Exception $e)
		{
			DB::rollback();

		}    	
		return Redirect::to('procesos/caja');

    }
    public function show($id)
    { 
    	return view("procesos.caja.show",["caja"=>Caja::findOrFail($id)]);
    }
		public function edit($id)		
    {
					$query1 = DB::table('detallecaja')	
						->where('idcaja','=',$id)
						->where('tipo','=','I')
						->sum('monto');
	
					$query2 = DB::table('detallecaja')	
						->where('idcaja','=',$id)
						->where('tipo','=','E')
						->sum('monto');
						
					$query3=$query1-$query2;

    	return view("procesos.caja.edit",["caja"=>Caja::findOrFail($id),'query3'=>$query3]);
	}
    public function update(CajaFormRequest $request,$id)
    {
    	$caja=Caja::findOrFail($id);
		/*$caja->iddetallemoneda=$request->get('iddetallemoneda');
    	$caja->idempleado=$request->get('idempleado');
    	$caja->montoapertura=$request->get('montoapertura');*/
    	$caja->montocierre=$request->get('montocierre');
    	/*$caja->montocorregido=$request->get('montocorregido');
    	$caja->fechaapertura=$request->get('fechaapertura');
		$caja->fechacierre=Carbon::now()->toTimeString();*/
		$caja->fechacierre=Carbon::now('America/Lima')->toDateString();
    	$caja->estado='Cerrado';
    	$caja->observaciones=$request->get('observaciones');
    	
    	$caja->update();
    	return Redirect::to('procesos/caja');
    }
    public function destroy($id)
    {
    	$caja=Caja::findOrFail($id);
    	$caja->estado='INACTIVO';
    	$caja->update();
    	return Redirect::to('procesos/caja');
		}
		
}
