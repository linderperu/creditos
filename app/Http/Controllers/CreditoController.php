<?php

namespace SisCredito\Http\Controllers;

use Illuminate\Http\Request;

use SisCredito\Http\Requests;
use SisCredito\Cobro;
use SisCredito\User;
use SisCredito\Credito;
use SisCredito\Caja;
use SisCredito\Detallecaja;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use SisCredito\Http\Requests\CreditoFormRequest;
use Carbon\Carbon;

use DB;

use Response;
use Illuminate\Support\Collection;


class CreditoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $f1 = carbon::today();
        $f2 = carbon::now();

	if(! is_null ($request->fechaInicial) && ! empty($request->fechaInicial)&& ! is_null($request->fechaFinal)||!empty($request->fechaFinal)){
		$f1=$request->fechaInicial;
		$f2=$request->fechaFinal;
	}		
		if($request){
            $query=trim($request->get('searchText'));
            $query2=trim($request->get('elecText'));
           
          // dd($f1);
            if($query==""){                

                $credito=DB::table('credito as c')
                ->join('persona as p','c.idpersona','=','p.idpersona') 
                ->join('users as u','u.id','=','c.idempleado')                  
                ->select('c.idcredito','p.dniruc','p.nombres','c.idempleado','c.monto','c.idcajero','c.tipopago','c.interes','c.fechacredito','c.numerocuotas','c.cuotas','c.tipocredito','c.prenda','u.name')
                ->whereBetween('c.fechacredito', [$f1, $f2])
                ->orderBy('c.idcredito','desc')
                ->paginate(100);
            }elseif($query2=='Prendario'){
                //sdd($f1,'aaa',$f2);
                $credito=DB::table('credito as c')
                ->join('persona as p','c.idpersona','=','p.idpersona')
                ->join('users as u','u.id','=','c.idempleado')                
                ->select('c.idcredito','p.dniruc','p.nombres','c.idempleado','c.monto','c.idcajero','c.tipopago','c.interes','c.fechacredito','c.numerocuotas','c.cuotas','c.tipocredito','c.prenda','u.name')
                ->where('c.tipocredito','LIKE','%'.$query2.'%')
                ->orderBy('c.idcredito','desc')
                ->paginate(100);

            }elseif($query2=='Efectivo')
            {
                $credito=DB::table('credito as c')
                ->join('persona as p','c.idpersona','=','p.idpersona') 
                ->join('users as u','u.id','=','c.idempleado')                
                ->select('c.idcredito','p.dniruc','p.nombres','c.idempleado','c.monto','c.idcajero','c.tipopago','c.interes','c.fechacredito','c.numerocuotas','c.cuotas','c.tipocredito','c.prenda','u.name')
                ->where('c.tipocredito','LIKE','%'.$query2.'%')
                ->orderBy('c.idcredito','desc')
                ->paginate(100);
            }
            elseif($query1 !="")
          {
            $credito=DB::table('credito as c')
            ->join('persona as p','c.idpersona','=','p.idpersona') 
            ->join('users as u','u.id','=','c.idempleado')                
            ->select('c.idcredito','p.dniruc','p.nombres','c.idempleado','c.monto','c.idcajero','c.tipopago','c.interes','c.fechacredito','c.numerocuotas','c.cuotas','c.tipocredito','c.prenda','u.name')
            ->where('c.tipocredito','LIKE','%'.$query1.'%')
            ->orderBy('c.idcredito','desc')
            ->paginate(100);
         }        
			return view('procesos.credito.index',["credito"=>$credito,"searchText"=>$query,"elecText"=>$query2,"fechaInicial"=>$f1,"fechaFinal"=>$f2]);
		  }
}
	/* fin de codigo*/   	
     
    public function create()
    { 
      $usuario= auth()->user()->idrol;
       // dd($usuario);
       $query3=0;
    if ($usuario=='3'){

     $personas=DB::table('persona')->where('tipo_persona','=','Cliente')->orderBy('nombres','asc')->get();
     $interes=DB::table('interes')->get();
     $empleado=DB::table('users')->get();
     return view("procesos.credito.create",["personas"=>$personas,"empleado"=>$empleado,"query3"=>$query3]);
    }else{
        $fechita=Carbon::now();
        $ff1=Carbon::today();    
        $cajacre = DB::table('caja')
        ->select('idcaja')
        ->where('estado','=','Abierto')
        ->whereBetween('fechaapertura', [$ff1,$fechita])
        ->where('idempleado',auth()->user()->id)->get();
    foreach ($cajacre as $ca){
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
                   
                   $query3=$query1-$query2;}

    $var=count($cajacre);
    //dd($var);
    if($var=='0'){
        flash('No tiene caja abierto....! ')->warning();
        return redirect('procesos/caja');
        }
        else
        {
            $personas=DB::table('persona')->where('tipo_persona','=','Cliente')->orderBy('nombres','asc')->get();
            // $interes=DB::table('interes')->get();
             $empleado=DB::table('users')->get();
            return view("procesos.credito.create",["personas"=>$personas,"empleado"=>$empleado,"query3"=>$query3]);
        }
}    	
    }
    public function store(CreditoFormRequest $request)
    { //Credito es el modelo Credito.php
        
		try{
			DB::beginTransaction();
            $credito= new Credito;
            $credito->idpersona=$request->get('idpersona');
            $credito->idempleado=$request->get('idempleado');
            $credito->idcajero=$request->get('idcajero');
            $credito->monto=$request->get('monto');
            $credito->tipopago=$request->get('tipopago');
            $credito->interes=$request->get('interes');
			$mytime=Carbon::now('America/Lima');
			$credito->fechacredito=$mytime->toDateTimeString();	
            $credito->numerocuotas=$request->get('numerocuotas');
            $credito->cuotas=$request->get('cuotas');
            $credito->tipocredito="Efectivo";
            $credito->prenda=$request->get('prenda');			
            $credito->save();

            $ncuotas=$request->get('numerocuotas');
            $monto=$request->get('monto');
            $inte=$request->get('interes');
            $apagar=$request->get('cuotas');
            $monto=$monto+$inte*$monto/100;
            $cont=0;                       
            $idcre=$credito->idcredito;
            $fechapago=Carbon::parse($request->get('fechapcuota'));

           // $fechapago=$fechapago->subDay(1);            
            //$fechapago= $apagar=$request->get('fechapcuota');
           // dd($ncuotas);
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//Egreso de Caja

$ff2 = auth()->user()->id;
$ff1= date('Y-m-d');
$caja=DB::table('caja')
->select('idcaja','fechaapertura')
->where('fechaapertura',$ff1)
->where('estado',"Abierto")
->where('idempleado',$ff2)
->get();
//dd($f2,'  la consulta  ',$caja[0]->idcaja);

$detallecaja=new Detallecaja;
$detallecaja->monto=$request->get('monto');
$detallecaja->tipo="E";
$detallecaja->descripcion="Egreso por préstamo";
$detallecaja->idcaja=$caja[0]->idcaja;
$detallecaja->iduser=auth()->id();    	  	
$detallecaja->save();

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            while($cont<$ncuotas)
                {    
                if($request->get('tipopago')=='Diario')
                {
                    $cobro= new Cobro();
			        $cobro->idcredito=$idcre;
			        $cobro->idpersona=$request->get('idpersona');
			        $cobro->idempleado=$request->get('idempleado');		
                    $cobro->montoapagar=$request->get('cuotas');  
                    if(strtoupper($fechapago->format('l'))=='SATURDAY'){$fechapago= $fechapago->addDay(1);}
                  //dd(strtoupper($fechapago->format('l')));
			        $cobro->fechapago= $fechapago;
			        $cobro->saldo=$monto -$apagar*$cont;
                    $cobro->cuota=$cont+1;
                    if ($fechapago<$mytime->toDateTimeString()){
                        $cobro->estadocuota="Cancelada";
                    }                   
                    else
                    {
                        $cobro->estadocuota="Pendiente";
                    }

                    $fechapago= $fechapago->addDay(1);
                   
          /*  $cobro->observaciones=$request->get('observaciones');*/
                }
                elseif($request->get('tipopago')=='Semanal'){
                    
                    $cobro= new Cobro();
			        $cobro->idcredito=$idcre;
			        $cobro->idpersona=$request->get('idpersona');
			        $cobro->idempleado=$request->get('idempleado');		
			        $cobro->montoapagar=$request->get('cuotas');
                    $cobro->fechapago= $fechapago->addWeek(1);
			        $cobro->saldo=$monto -$apagar*$cont;
		        	$cobro->cuota=$cont+1;
                    $cobro->estadocuota="Pendiente";
                   // $fechapago=$fechapago->addWeek(1);
          /*  $cobro->observaciones=$request->get('observaciones');*/
                }	
                else{

                    $cobro= new Cobro();
			        $cobro->idcredito=$idcre;
			        $cobro->idpersona=$request->get('idpersona');
			        $cobro->idempleado=$request->get('idempleado');		
			        $cobro->montoapagar=$request->get('cuotas');
                    $cobro->fechapago= $fechapago->addMonth(1);
			        $cobro->saldo=$monto -$apagar*$cont;
		        	$cobro->cuota=$cont+1;
                    $cobro->estadocuota="Pendiente";
                   // $fechapago=$fechapago->addMonth(1);
          /*  $cobro->observaciones=$request->get('observaciones');*/ 
                }
                $cobro->save();
                $cont=$cont+1;
        }
        
        DB::commit();
        flash('Credito aprobado exitosamente....! ')->success();
        
		}catch(\Illuminate\Database\QueryException $e)
		{
            DB::rollback();
            flash('Algo ocurrio, error, vuelva a generar credito ....! ')->warning();
            return $e->getBindings();

		}    	
		return Redirect::to('procesos/credito');
    }
    public function show($id)
    {
    	return view("procesos.credito.show",["credito"=>Credito::findOrFail($id)]);
    }
    public function edit($id)
    {
    	return view("procesos.credito.edit",["credito"=>Credito::findOrFail($id)]);
	}
    public function update(CreditoFormRequest $request,$id)
    {/*
    	$cobro=Credito::findOrFail($id);
		
        $credito->idpersona=$request->get('idpersona');
        $credito->idempleado=$request->get('idempleado');
        $credito->idcajero=$request->get('idcajero');
        $credito->monto=$request->get('monto');
        $credito->tipopago=$request->get('tipopago');
        $credito->idinteres=$request->get('idinteres');
        /*$credito->montocierre='0';
        $credito->montocorregido='0';
        $mytime=Carbon::now('America/Lima');
        $credito->fechacredito=$mytime->toDateTimeString();
    //	$credito->fechacierre='';
        $credito->numerocuotas=$request->get('numerocuotas');	
        $credito->cuotas=$request->get('cuotas');
        $credito->tipocredito=$request->get('tipocredito');
        $credito->prenda=$request->get('prenda');	
    	
    	$credito->update();*/
    	return Redirect::to('procesos/credito');
    }
    public function destroy($id)
    {   
        $ff2 = auth()->user()->id;
        $ff1= date('Y-m-d');
        $caja=DB::table('caja')
        ->select('idcaja','fechaapertura')
        ->where('fechaapertura',$ff1)
        ->where('estado',"Abierto")
        ->where('idempleado',$ff2)
        ->get();
                
        //dd($f2,'  la consulta  ',$caja[0]->idcaja);
        $credito=Credito::findOrFail($id);
        $detallecaja=new Detallecaja;
        $detallecaja->monto=$credito->monto;
        $detallecaja->tipo="I";
        $detallecaja->descripcion="Error de Crédito elimina cajera:::::" . auth()->user()->name.":::Devolución a caja";
        $detallecaja->idcaja=$caja[0]->idcaja;
        $detallecaja->iduser=auth()->id();    	  	
        $detallecaja->save();   	   	
        $credito->delete();
        DB::table('cobro')->where('idcredito', '=', $id)->delete();
            
       
        
        

    	
	
    	return Redirect::to('procesos/credito');
    }
}
