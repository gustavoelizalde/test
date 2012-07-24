<?php include("inc_php.php"); ?><?php

session_start();

$lat_user = $_SESSION["latitud_user"];
$lon_user = $_SESSION["longitud_user"];

$id = $_GET["id"];

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
	  puntos_venta.puntos_venta_id = ".intval($id)
);

mysql_select_db($database_localhost,$localhost);
$result = mysql_query($sql,$localhost) or die(mysql_error());

while($row = mysql_fetch_array($result))
{
	$punto['id'] = $row["puntos_venta_id"];
	$punto['pueblo'] = $row["pueblo"];
	$punto['titulo'] = $row["punto_venta"];
	$punto['telefono'] = $row["telefono"];
	$punto['direccion'] = $row["direccion"];
	$punto['horario'] = $row["horario"];
	$punto['contacto'] = $row["contacto"];
	$punto['email'] = $row["email"];
	$punto['latitud'] = $row["latitud"];
	$punto['longitud'] = $row["longitud"];
	$punto['activo'] = $row["activo"];
}
mysql_free_result($result);

?><?php include("inc_head.php"); ?>
<body class="detail">
  	<div id="container">
    	<article>
        	<hgroup>
            	<h1><?php echo $punto["titulo"]; ?></h1>
                <h3><?php echo $punto["direccion"]; ?></h3>
            </hgroup>
           	<div class="action">
            	<a class="tel" href="tel:<?php echo $punto["telefono"]; ?>"><span><?php echo $punto["telefono"]; ?></span></a><a class="adress" href="lista.php"><span>Direcciones</span></a><a class="mapa" href="mapa.php?id=<?php echo $punto["id"]; ?>"><span>Mapa</span></a>
            </div>
            <div class="sepdoble"></div>
            <h3>Horario: <?php echo $punto["horario"]; ?></h3>
            <p>Contacto: <?php echo $punto["contacto"]; ?></p>
        </article>
	</div>
<?php include("inc_scripts.php"); ?> 

<script>
	$(document).ready(function(e) {
			setDetail();
    });
	
	$(window).resize(function(e) {
        	//
    });
</script>


</body>
</html>