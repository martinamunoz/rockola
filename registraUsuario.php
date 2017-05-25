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
			require("conexion.php");
			$query="SELECT idEvento FROM evento WHERE idEvento = $idEvento";
			$row=mysql_query($query, $conexion);
			if (!mysql_num_rows($row)>0) 
			{
				//No existe evento en el sistema.
				die('Consulta no válida: ' . mysql_error());
			}
			else
			{
				//Existe evento.
				$query="SELECT IMEI FROM usuario WHERE IMEI = $imei";
				$row=mysql_query($query, $conexion);
				if (!mysql_num_rows($row)>0) 
				{
					//No existe usuario en el sistema.
					$query="INSERT INTO usuario (IMEI, idEvento) VALUES ($imei, $idEvento)";
					$row=mysql_query($query, $conexion);
				}
				else
				{
					//Existe usuario, se cambia su evento actual sin importar donde se encuentra.
					$query="UPDATE INTO usuario SET idEvento='$idEvento' WHERE IMEI = $imei";
					$row=mysql_query($query, $conexion);
				}
				$query="INSERT INTO asistea (IMEI, idEvento) VALUES ($imei, $idEvento)";
				$row=mysql_query($query, $conexion);
				echo json_encode($decoded);
			}
			mysql_close($conexion);
		}
	}
}
		
?>
