<?php

if (strcmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0)
{
    throw new Exception('Request method must be POST!');
}
 else
 {
	if(!is_null($_POST))
	{
		$json =  file_get_contents('php://input');
		$decoded=json_decode($json, true);
		file_put_contents('PLAYLIST.txt',$json);
		echo "OK";
		if(!is_null($decoded))
		{
			/*$imei = $decoded[0]['imei'];
			$idEvento = $decoded[0]['idEvento'];
			require("conexion.php");
			$query="SELECT IMEI FROM usuario WHERE (IMEI = '$imei' AND idEvento = '$idEvento')";
			$row=mysql_query($query, $conexion);
			if (!$row) 
			{
				//No existe evento en el sistema o usuario no se encuentra en dicho evento.
				die('Consulta no válida: ' . mysql_error());
			}
			else
			{
				$query="SELECT idPlaylist FROM evento WHERE idEvento = '$idEvento'";
				$row=mysql_query($query, $conexion);
				if (!mysql_num_rows($row)>0) 
				{
					//No existe evento en el sistema.
					die('Consulta no válida: ' . mysql_error());
				}
				else
				{
					//Existe evento.
					$r = mysql_fetch_row($row); //Para obtener idPlaylist del evento.
					$query="SELECT cancion.idCancion, cancion.nombre FROM cancion JOIN contiene ON cancion.idCancion=contiene.idCancion WHERE contiene.idPlaylist='$r[0]'";
					$row=mysql_query($query,$conexion);
					if (!mysql_num_rows($row)>0) 
					{
						//Playlist no contiene canciones.
						die('Consulta no válida: ' . mysql_error());
					}
					else
					{
						//Playlist contiene canciones.
						while ($r = mysql_fetch_assoc($row)) 
						{
							$canciones[] = array('idCancion' => $r["idCancion"], 'nombre' => $r["nombre"]);
							
						}
						echo json_encode($canciones);
					}
				}
			}
			mysql_close($conexion);*/
		}

	}
}
?>
