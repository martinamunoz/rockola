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
		if(!is_null($decoded))
		{
			$imei = $decoded['imei'];
			$idEvento = $decoded['idEvento'];
			$idCancion = $decoded['idCancion'];
			$tipoVoto = $decoded['tipoVoto'];
			file_put_contents('recibido.txt',$json);
			include 'conexion.php';
			$query="SELECT IMEI FROM usuario WHERE IMEI='$imei' AND idEvento=$idEvento";
			$row=mysql_query($query, $conexion);
			if (!mysql_num_rows($row)>0) 
			{
				//No existe evento en el sistema o usuario no se encuentra en dicho evento.
				die('Consulta no válida');
			}
			else
			{
				//Existe evento en el sistema o usuario se encuentra en dicho evento. (Hay que arreglar esto después para mostrar un mensaje de que se debe escanear el código QR).
				$query="SELECT idVotosCancion FROM votoscancion WHERE idEvento=$idEvento AND idCancion=$idCancion";
				$row=mysql_query($query, $conexion);
				if (!mysql_num_rows($row)>0) 
				{
					//Todavia no se ha creado el registro de votos para esa cancion.
					if($tipoVoto==1)
					{
						//Voto positivo.
						$query="INSERT INTO votoscancion (negativos, positivos, nReproducciones, idCancion, idEvento) VALUES (0,1,0,$idCancion,$idEvento)";
					}
					if($tipoVoto==-1)
					{
						//Voto negativo.
						$query="INSERT INTO votoscancion (negativos, positivos, nReproducciones, idCancion, idEvento) VALUES (1,0,0,$idCancion,$idEvento)";
					}
					$row=mysql_query($query, $conexion);
					if (!$row) 
					{
						die('Consulta no válida');
					}
				} 
				//Se haya creado o no el registro de votos para esa cancion.
				$query="SELECT votoscancion.idVotosCancion FROM votoscancion JOIN realizavoto ON votoscancion.idVotosCancion=realizavoto.idVotosCancion AND votoscancion.idEvento=$idEvento";
				file_put_contents('logError.txt',mysql_error());
				$row=mysql_query($query,$conexion);
				if (!mysql_num_rows($row)>0) 
				{
					//Dicho usuario todavia no voto esa canción.
					$r = mysql_fetch_assoc($row);
					$query="INSERT INTO realizavoto (IMEI, idVotosCancion) VALUES ('$imei',". $r['idVotosCancion']. ")";
					echo "OK";
				}
				else
				{
					//Dicho usuario todavia ya voto esa canción.
					echo "Usuario ya votó";
				}
				mysql_close($conexion);
			}
		}
	}
}
?>
