<?php 

$server = "localhost";
$user = "root";
$pass = "Avery1";
$bd = "averygalen";

//Creamos la conexión
$conexion = mysqli_connect($server, $user, $pass,$bd) 
or die("Ha sucedido un error inexperado en la conexion de la base de datos");

//generamos la consulta
$sql = "SELECT carreras.id_resinto, carreras.NombreCarrera,cursos.nombreCurso, docente.NombreDocente,aula.NumeroAula ,
aula.NumeroPiso,horarios.dias ,horarios.Hora from  cursos JOIN carreras on cursos.id_carrera=carreras.id_carrera JOIN docente on cursos.id_docente=cursos.id_docente JOIN aula on cursos.id_aula=aula.id_aula JOIN horarios on cursos.id_horario=horarios.id_horario";
mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($conexion, $sql)) die();

$clientes = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
    $id=$row['id_resinto'];
     $carrera=$row['NombreCarrera'];
    $nombre=$row['nombreCurso'];
     $Docente=$row['NombreDocente'];
      $aula=$row['NumeroAula'];
       $NumPiso=$row['NumeroPiso'];
       $dias=$row['dias'];
       $horario=$row['Hora'];
    
    

    $clientes[] = array('id_resinto'=>$id,'NombreCarrera'=>$carrera,'nombreCurso'=> $nombre,'NombreDocente'=>$Docente,'NumeroAula'=>$aula,'NumeroPiso'=>$NumPiso,'dias'=>$dias,'Hora'=>$horario);

}
    
//desconectamos la base de datos
$close = mysqli_close($conexion) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  

//Creamos el JSON
$json_string = json_encode($clientes);
echo $json_string;

//Si queremos crear un archivo json, sería de esta forma:
/*
$file = 'clientes.json';
file_put_contents($file, $json_string);
*/
    

?>