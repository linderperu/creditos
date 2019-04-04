<?php

namespace SisCredito\Http\Controllers;

use Illuminate\Http\Request;

use SisCredito\Http\Requests;
use SisCredito\Caja;
use SisCredito\User;
use SisCredito\Detallecaja;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use SisCredito\Http\Requests\DetallecajaFormRequest;
use Carbon\Carbon;

use DB;

class ReportesController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');
    }
    public function index(Request $request)
    {
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
   
			$usuario=auth()->user()->id;			
			$rol=auth()->user()->idrol;
		//	dd($usuario);

if($rol!='3'){

			if ($rol=='1'){
				$f1=Carbon::today();
				$detallecaja=DB::table('detallecaja as d')
				->join('caja as ca','d.idcaja','=','ca.idcaja')   				               
				->select('d.iddetallecaja','d.idcaja','d.monto','d.tipo','ca.fechaapertura','d.descripcion','d.iduser')				
				->where('d.iduser',[$usuario])
				->where('ca.fechaapertura',$f1)								
				->orderBy('d.tipo','desc','d.iddetallecaja')							
				->paginate(200);

			}elseif($rol=='2'){
				$detallecaja=DB::table('detallecaja as d')
				->join('caja as ca','d.idcaja','=','ca.idcaja')   				               
				->select('d.iddetallecaja','d.idcaja','d.monto','d.tipo','ca.fechaapertura','d.descripcion','d.iduser')
				->whereBetween('ca.fechaapertura', [$f1,$f2])								
				->orderBy('d.tipo','desc','d.iddetallecaja')							
				->paginate(200);

			}
			$empleado=DB::table('users')->get();
			 return view('procesos.reportes.index',["detallecaja"=>$detallecaja,"empleado"=>$empleado]);
			 
		}else{
			 return redirect( '/procesos/caja');

		}




		}

		
}

