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
			$user = $decoded['user'];
			$pass = $decoded['pass'];
			require("conexion.php");
			$query = "SELECT cuilt FROM cliente WHERE pass = $pass AND user = '$user'";
			$row = mysql_query($query, $conexion);
			if (!mysql_num_rows($row)>0) 
			{
				//No existe cliente en el sistema o contraseña incorrecta.
				die('Cliente o contraseña incorrecta');
			}
			else
			{
				echo "Login OK";
			}
			mysql_close($conexion);
		}
	}
}
		
?>
