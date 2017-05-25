<?php
require("conexion.php");
$idPlaylist=2;
$query="SELECT cancion.idCancion, cancion.nombre FROM cancion JOIN contiene ON cancion.idCancion=contiene.idCancion WHERE contiene.idPlaylist='$idPlaylist'";
$row=mysql_query($query,$conexion);
file_put_contents('recibido.txt',mysql_error());
echo "<table>";  
echo "<tr>";  
echo "<th>idCancion</th>";  
echo "<th>Nombre</th>";  
echo "</tr>"; 
while($r=mysql_fetch_row($row))
{
	
	echo "<tr>";  
	echo "<td> $r[0] </td>";  
	echo "<td> $r[1] </td>";  
	echo "</tr>";  
}
echo "</table>";  
?>
