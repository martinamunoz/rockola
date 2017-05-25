<?php
if(!($conexion=mysql_connect('localhost', 'root', '14270165')))
{
	exit();
}
else
{
		if(!mysql_select_db('servidor', $conexion))
		{
			echo "Error al seleccionar BD";
		}
}
?>