<?php

namespace SisCredito\Http\Controllers;

use Illuminate\Http\Request;
use SisCredito\Http\Requests;
use SisCredito\Cobro;
use SisCredito\Credito;
use SisCredito\Caja;
use SisCredito\Detallecaja;
use Illuminate\Support\Facades\Redirect;
use SisCredito\Http\Requests\CobroFormRequest;

use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

use DB;
class CobroController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');
    }
    public function index(Request $request)
    {		
			if(! is_null ($request->fechahoy) && ! empty($request->fechahoy)){	$f1=$request->fechahoy;	}
					else{	$f1=Carbon::now('America/Lima')->toDateString();	}			
			if($request){

				$f2=trim($request->get('estadop'));
				$query=trim($request->get('searchText'));
				$query2=trim($request->get('searchText2'));

if($query=="" && $query2==""){
		if(	$f2=="1"){
			$cobro=DB::table('cobro as c')
			->join('credito as cre','c.idcredito','=','cre.idcredito')
			->join('persona as p','p.idpersona','=','c.idpersona')
			->join('users as u','u.id','=','c.idempleado')
			->select('c.idcobro','c.idcredito','c.idpersona','p.nombres','p.dniruc','c.idempleado','cre.monto','c.fechapago','c.fechadeposito','c.montoapagar','c.montocobrado','c.saldo','c.cuota','c.estadocuota','c.observaciones','u.name')
			->where('c.fechapago',$f1)
			->where('c.estadocuota','Pendiente')		
			->orderBy('c.idcredito','desc')
			->paginate(30);
		

		}elseif($f2=="2"){
		
			$cobro=DB::table('cobro as c')
			->join('credito as cre','c.idcredito','=','cre.idcredito')
			->join('persona as p','p.idpersona','=','c.idpersona')
			->join('users as u','u.id','=','c.idempleado')
			->select('c.idcobro','c.idcredito','c.idpersona','p.nombres','p.dniruc','c.idempleado','cre.monto','c.fechapago','c.fechadeposito','c.montoapagar','c.montocobrado','c.saldo','c.cuota','c.estadocuota','c.observaciones','u.name')
			->where('c.fechapago',$f1)
			->where('c.estadocuota','Cancelada')		
			->orderBy('c.idcredito','desc')
			->paginate(30);
		

		}elseif($f2=="3"){
		
			$cobro=DB::table('cobro as c')
			->join('credito as cre','c.idcredito','=','cre.idcredito')
			->join('persona as p','p.idpersona','=','c.idpersona')
			->join('users as u','u.id','=','c.idempleado')
			->select('c.idcobro','c.idcredito','c.idpersona','p.nombres','p.dniruc','c.idempleado','cre.monto','c.fechapago','c.fechadeposito','c.montoapagar','c.montocobrado','c.saldo','c.cuota','c.estadocuota','c.observaciones','u.name')
			->where('c.fechapago',$f1)
			->where('c.estadocuota','Faltante')		
			->orderBy('c.idcredito','desc')
			->paginate(30);	

		}elseif($f2==""){			
			$cobro=DB::table('cobro as c')
			->join('credito as cre','c.idcredito','=','cre.idcredito')
			->join('persona as p','p.idpersona','=','c.idpersona')
			->join('users as u','u.id','=','c.idempleado')
			->select('c.idcobro','c.idcredito','c.idpersona','p.nombres','p.dniruc','c.idempleado','cre.monto','c.fechapago','c.fechadeposito','c.montoapagar','c.montocobrado','c.saldo','c.cuota','c.estadocuota','c.observaciones','u.name')
			->where('c.fechapago',$f1)
			->orderBy('u.name','asc')
			->paginate(500);
				}
				}else{
					if ($query!=""){
						$cobro=DB::table('cobro as c')
						->join('credito as cre','c.idcredito','=','cre.idcredito')
						->join('persona as p','p.idpersona','=','c.idpersona')
						->join('users as u','u.id','=','c.idempleado')
						->select('c.idcobro','c.idcredito','c.idpersona','p.nombres','p.dniruc','c.idempleado','cre.monto','c.fechapago','c.fechadeposito','c.montoapagar','c.montocobrado','c.saldo','c.cuota','c.estadocuota','c.observaciones','u.name')
						->where('p.nombres','LIKE','%'.$query.'%')
						->orwhere('p.dniruc','LIKE','%'.$query.'%')					
						->orderBy('c.cuota','asc')				
						->paginate(30);

					}
					if ($query2!=""){
						$cobro=DB::table('cobro as c')
						->join('credito as cre','c.idcredito','=','cre.idcredito')
						->join('persona as p','p.idpersona','=','c.idpersona')
						->join('users as u','u.id','=','c.idempleado')
						->select('c.idcobro','c.idcredito','c.idpersona','p.nombres','p.dniruc','c.idempleado','cre.monto','c.fechapago','c.fechadeposito','c.montoapagar','c.montocobrado','c.saldo','c.cuota','c.estadocuota','c.observaciones','u.name')
						->where('u.name','LIKE','%'.$query2.'%')
						->where('c.fechapago','<=',$f1)
						->where('c.estadocuota','Pendiente')
						->orWhere('c.estadocuota','Faltante')								
						->orderBy('p.nombres','asc')				
						->paginate(100);

					}
				}
				return view('procesos.cobro.index',["cobro"=>$cobro,"searchText"=>$query,"searchText2"=>$query2,"fechahoy"=>$f1,"estadop"=>$f2]);	
			}	
	}
	/* fin de codigo*/	
    public function create()
    {
				return view("procesos.cobro.create");

    }
    public function store(CobroFormRequest $request)
    { //Cliente es el modelo Cliente.php
		
    }
    public function show($id)
    {
    	return view("procesos.cobro.show",["cobro"=>Cobro::findOrFail($id)]);
    }
	public function edit($id) {
	
		$fechita=Carbon::now();
		$ff1=Carbon::today();;
		
		$cajacre = DB::table('caja')
		->select('idcaja')
		->where('estado','=','Abierto')
		->whereBetween('fechaapertura', [$ff1,$fechita])
		->where('idempleado',auth()->user()->id)->get();

		$var=count($cajacre);
			//dd($var);
		if($var=='0'){
			flash('No tiene caja abierto para cobro....! ')->warning();
			return redirect('procesos/cobro');
			}
			else
			{	
				$cobro=DB::table('cobro as c')
				->join('credito as cre','c.idcredito','=','cre.idcredito')
				->join('persona as p','p.idpersona','=','c.idpersona')
				->join('users as u','u.id','=','c.idempleado')
				->select('c.idcobro','c.idcredito','c.idpersona','p.nombres','c.idempleado','cre.monto','c.fechapago','c.fechadeposito','c.montoapagar','c.montocobrado','c.saldo','c.cuota','c.estadocuota','c.observaciones','u.name')
				->where('c.idcobro', '=',$id)->first();			

			return view('procesos.cobro.edit',["cobro"=>$cobro]);
		//return view("procesos.cobro.edit",["cobro"=>Cobro::findOrFail($id)]);
	}
	}
    public function update(CobroFormRequest $request,$id)
    {

			try{
				DB::beginTransaction();
					$cobro=Cobro::findOrFail($id);					
					$saldo=	$cobro->saldo;
					$mc=$request->get('montocobrado');
					$na=$request->get('montoapagar');
					$mcob=$cobro->montocobrado;
					$mapa=$cobro->montoapagar;
		if($cobro->estadocuota=='Faltante'){$mc=$mc+$mcob;}		       	
					$mytime=Carbon::now('America/Lima');
					$cobro->idempleado=auth()->user()->id;
					$cobro->montocobrado=$mc;
					$cobro->fechadeposito=$mytime->toDateTimeString();
					$saldo=$saldo - $request->get('montocobrado');
					$cobro->saldo=$saldo;
					$cobro->observaciones=$request->get('observaciones');
					$sal=$na-$mc;
	//	dd($saldo,'pagado ' ,$mc);

				if($sal > 0){
					$cobro->estadocuota='Faltante';
				}else{	$cobro->estadocuota='Cancelada';}	
				$cobro->update();		        
			//INGRESAMOS A CAJA TODOS LOS COBROS	

			$f2 = auth()->user()->id;
			$f1= date('Y-m-d');
			$caja=DB::table('caja')
			->select('idcaja','fechaapertura')
			->where('fechaapertura',$f1)
			->where('estado',"Abierto")
			->where('idempleado',$f2)
			->get();
		//	dd($f2,'  la consulta  ',$caja[0]->idcaja);
		$detallecaja=new Detallecaja;
		$detallecaja->monto=$request->get('montocobrado');
		$detallecaja->tipo="I";
		$detallecaja->descripcion="Pago de Cuota";
		$detallecaja->idcaja=$caja[0]->idcaja;
		$detallecaja->iduser=auth()->id();    	  	
		$detallecaja->save();
		
		flash('Cuota pagada exitosamente....! ')->success();
		DB::commit();	
	//dd($request->get('montocobrado'),auth()->user()->id,DB::commit(),$caja[0]->idcaja);
			return Redirect::to('procesos/cobro');
			}
			catch(ErrorException $e){
				DB::rollback();
				echo $e->getMessage();
			}
		}
    public function destroy($id)
    {
    	$cobro=Cobro::findOrFail($id);
    	$cobro->estadocuota='Coactivo';
			$cobro->update();
			


			
    	return Redirect::to('procesos/cobro');
    }
}
