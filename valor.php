<?
$cuentaVueltas = $_REQUEST['cuentaVueltas'];
$temperatura = $_REQUEST['temperatura'];
$humedad = $_REQUEST['humedad'];
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Estacion Martin</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  </head>
  <body>
    <h1>Estacion Martin</h1>

    <p>Temperatura: <? echo $temperatura; ?></p>
    <p>Humedad: <? echo $humedad; ?> </p>
    <p>Vueltas: <? echo $cuentaVueltas; ?></p>

  </body>
</html>
