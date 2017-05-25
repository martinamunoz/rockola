<?php
if (strcmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0)
{
    throw new Exception('Request method must be POST!');
}
else
{
	if(!is_null($_POST))
	{
		echo "Recibido lince";
		$json =  file_get_contents('php://input');
		file_put_contents('RECIBIDO.txt', $json);
	}
}
?>