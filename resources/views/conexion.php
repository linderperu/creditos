

 <?php  
                                    
$conexion = new PDO('mysql:host=mysql3001.mochahost.com;dbname=linder_dbfinanciera','linder_r00t','.@Uno2Tres@.');
date_default_timezone_set('America/Lima');
$conexion->exec('SET CHARACTER SET utf8');
   $consulta = $conexion->query("SELECT * FROM roles order by nombre asc");
   while ($fila=$consulta->fetch(PDO::FETCH_OBJ)) {                    
   echo '<option value="'.$fila->idrol.'">'.ucwords($fila->nombre).  '</option> ';
}?>





 ?>