<?php include("inc_php.php"); ?><?php

session_start();

$lat_user = $_SESSION["latitud_user"];
$lon_user = $_SESSION["longitud_user"];

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
	$puntos[$i]['pueblo'] = $row["pueblo"];
	$puntos[$i]['titulo'] = $row["punto_venta"];
	$puntos[$i]['telefono'] = $row["telefono"];
	$puntos[$i]['direccion'] = $row["direccion"];
	$puntos[$i]['horario'] = $row["horario"];
	$puntos[$i]['contacto'] = $row["contacto"];
	$puntos[$i]['email'] = $row["email"];
	$puntos[$i]['latitud'] = $row["latitud"];
	$puntos[$i]['longitud'] = $row["longitud"];
	$puntos[$i]['activo'] = $row["activo"];
	
	$i++;
}
mysql_free_result($result);

?><?php include("inc_head.php"); ?>
<body class="lista">
	<div id="container">
    	<div id="locales" style="padding-bottom:40px;">
            <ul>
                <?php for($i=0; $i<count($puntos); $i++){ ?>
                <li>
                    <h2><?php echo $puntos[$i]["titulo"]; ?></h2>
                    <p><?php echo $puntos[$i]["direccion"]; ?> - <?php echo $puntos[$i]["email"]; ?></p>
                    <div class="action"><a class="tel" href="tel:<?php echo $punto["telefono"]; ?>"><span><?php echo $puntos[$i]["telefono"]; ?></span></a><a class="more" href="detalle.php?id=<?php echo $puntos[$i]["id"]; ?>"><img src="img/next.png" width="16" height="15"></a></div>
                </li>
                <?php } ?>
            </ul>
        </div>
        <div class="nav" style="position:fixed !important;"><a class="btn_simple" href="mapa.php">Ver mapa</a></div>
	</div>

<?php include("inc_scripts.php"); ?> 
	
<script>
	$(document).ready(function(e) {
			setList();
    });
	
	$(window).resize(function(e) {
        	setList();
    });
</script>

</body>
</html>