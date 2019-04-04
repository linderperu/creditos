<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>|Credicash|</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">

<!-- escript creado para imprimir -->
    <link rel="stylesheet" href="{{asset('css/imprimir.css')}}">

    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="{{asset('img/logo.png')}}" class="brandlogo-image" alt="Credicash"></span>
          <!-- logo for regular state and mobile devices -->
       <span class="logo-lg"><img src="{{asset('img/logo.png')}}" class="brandlogo-image" alt="Credicash"></span>
       </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
               <li class="dropdown user user-menu">
                  <a href="{{asset('procesos/reportes')}}">                     
                      
                      <i class="fa fa-bell-o fa-lg" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Reportes: ingresos a caja"></i>                 

                     
                  
                  </a>
                    
              </li>
               <!-- User Account: style can be found in dropdown.less -->
                 <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user fa-lg" aria-hidden="true"></i>  
                      <?php            
                      $conexion = new PDO('mysql:host=localhost;dbname=dbfinanciera','root','');
                        date_default_timezone_set('America/Lima');
                        $conexion->exec('SET CHARACTER SET utf8');
                        $user=auth()->user()->idrol;
                       $consulta = $conexion->query("SELECT nombre FROM roles WHERE idrol=$user");
                      // dd($consulta);
                      $a=0;
                        while ($fila=$consulta->fetch(PDO::FETCH_OBJ)) {                    
                         $a=$fila->nombre;
                         }?>

                       <small class="bg-red" > <label id="mona">{{auth()->user()->name}}/{{$a}}</label></small>
                        <small >↓</small>
                        <i class="fa fa-unsorted" aria-hidden="true"></i> 
                    </a>
                    <ul class="dropdown-menu">
                       <!-- User image -->
                          <li class="user-header">
                            <p>Derechos reservados Credicash
                          <small>www.youtube.com/credicash</small>
                          <span class="logo-lg"><img src="{{asset('img/kallpa.jpg')}}" class="brandlogo-image" alt="Credicash"></span>
                           </p>
                          </li>
                  
                     <!-- Menu Footer-->
                     <li class="user-footer">
                    
                      <div class="pull-right">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                      <h2> <small class="bg-black"> {{ __('Cerrar sesión') }} </small></h2>
                         </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                         @csrf
                         </form>
                      </div>
                      </li>
                    </ul>
                 </li>
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Mantenimiento</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{asset('mantenimiento/clientes')}}"<i class="fa fa-circle-o"></i> Clientes</a></li>
                @if ($a>'0')
                  @if($a=='Cajero'|| $a=='Administrador')                
                <li><a href="{{asset('mantenimiento/roles')}}"><i class="fa fa-circle-o"></i> Roles</a></li>
                @endif
                @endif
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Caja (Egresos/Ingresos)</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">

                  @if ($a>'0')
                  @if($a=='Cajero'|| $a=='Administrador')
                <li><a href="{{asset('procesos/caja')}}"><i class="fa fa-circle-o"></i> Apertura Caja</a></li>
                <li><a href="{{asset('procesos/ingresos')}}"><i class="fa fa-circle-o"></i>Ingreso a Caja</a></li>
                <li><a href="{{asset('procesos/egresos')}}"><i class="fa fa-circle-o"></i>Salida de Caja</a></li>
                @else
                <li><a href="{{asset('procesos/caja')}}"><i class="fa fa-circle-o"></i> Apertura Caja</a></li>
                @endif
                @endif
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Créditos/Cobros</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">

                  @if ($a>'0')
                  @if($a=='Cajero'|| $a=='Administrador')
                  <li><a href="{{asset('procesos/credito')}}"><i class="fa fa-circle-o"></i> Crédito</a></li>
                  <li><a href="{{asset('procesos/cobro')}}"><i class="fa fa-circle-o"></i> Cobranza</a></li>
                  @else
                  <li><a href="{{asset('procesos/cobro')}}"><i class="fa fa-circle-o"></i> Cobranza</a></li>
                  <li><a href="{{asset('procesos/credito')}}"><i class="fa fa-circle-o"></i> Crédito</a></li>
                   @endif
                @endif

                
                
              </ul>
            </li>
                       
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                
               
                <li>
                  @if ($a>'0')
                    @if($a=='Administrador')
                    @if (Route::has('register'))
                            <a class="fa fa-user fa-lg" href="{{ route('register') }}">{{ __('  Registro de Usuarios') }}</a>
                    @endif
                    </li>
                  @endif
                  @endif
                
              </ul>
            </li>
             <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box box-info">              
                    <div class="box box-solid box-default"> 
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                  <h6 class="box-title" >Sistema de Créditos</h6>  

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
                          <h3>@include('flash::message')</h3>
		                          <!--Contenido-->
                              @yield('contenido')
		                          <!--Fin Contenido-->
                           </div>
                        </div>
		                    
                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.1.7
        </div>
        <strong>Copyright &copy; 2018-2025 <a href="www.lyersac.com">SisWeb</a>.</strong> David Huaman Porras - Soporte técnico - CEL. 952066910 <a href="tel:+51952066910">Click para llamar</a>
      </footer>

      
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    <script src="{{asset('js/scriptprint.js')}}"></script>
  </body>
</html>
