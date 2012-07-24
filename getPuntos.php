<?php include("inc_php.php"); ?><?php

$puntos = array();

$sql = sprintf(
	"SELECT 
	  puntos_venta.puntos_venta_id,
	  puntos_venta.pueblo,
	  puntos_venta.punto_venta,
	  puntos_venta.telefono,
	  puntos_venta.direccion,
	  puntos_venta.horario,
	  puntos_venta.contacto,
	  puntos_venta.email,
	  puntos_venta.latitud,
	  puntos_venta.longitud,
	  puntos_venta.activo
	FROM
	  puntos_venta
	WHERE
	  puntos_venta.activo = 1"
);

mysql_select_db($database_localhost,$localhost);
$result = mysql_query($sql,$localhost) or die(mysql_error());

$i=0;

while($row = mysql_fetch_array($result))
{
	$puntos[$i]['id'] = $row["puntos_venta_id"];
	$puntos[$i]['pueblo'] = htmlentities($row["pueblo"]);
	$puntos[$i]['titulo'] = htmlentities($row["punto_venta"]);
	$puntos[$i]['telefono'] = htmlentities($row["telefono"]);
	$puntos[$i]['direccion'] = htmlentities($row["direccion"]);
	$puntos[$i]['horario'] = htmlentities($row["horario"]);
	$puntos[$i]['contacto'] = htmlentities($row["contacto"]);
	$puntos[$i]['email'] = htmlentities($row["email"]);
	$puntos[$i]['latitud'] = htmlentities($row["latitud"]);
	$puntos[$i]['longitud'] = htmlentities($row["longitud"]);
	$puntos[$i]['activo'] = htmlentities($row["activo"]);
	
	$i++;
}
mysql_free_result($result);

echo json_encode($puntos);

?>