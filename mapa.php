<?php include("inc_php.php"); ?><?php

session_start();

$lat_user = $_SESSION["latitud_user"];
$lon_user = $_SESSION["longitud_user"];

$id = $_GET["id"];

$puntos = array();

$sql = sprintf(
	"SELECT
	  puntos_venta.latitud,
	  puntos_venta.longitud
	FROM
	  puntos_venta
	WHERE
	  puntos_venta.puntos_venta_id = ".intval($id)
);

mysql_select_db($database_localhost,$localhost);
$result = mysql_query($sql,$localhost) or die(mysql_error());

while($row = mysql_fetch_array($result))
{
	$punto['latitud'] = $row["latitud"];
	$punto['longitud'] = $row["longitud"];
}
mysql_free_result($result);

?><?php include("inc_head.php"); ?>
<body class="mapa">
  <div id="container">
  	  <div id="map_canvas"></div>
  	  <header><a href="index.php"><img src="img/sellos_m.png" width="191" height="46" alt="Sellos &amp; comprobantes"></a></header>
  	  
      <div class="action"><a class="active" href="mapa.php">ver mapa</a><a href="lista.php">ver lista</a></div>
      
      
</div>
  
<?php include("inc_scripts.php"); ?> 

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script>
$(document).ready(function(e) {
	<?php if($punto['latitud'] != "" && $punto['longitud'] != ""){ ?>
	getMap(<?php echo $punto['latitud']; ?>,<?php echo $punto['longitud']; ?>);
	<?php }else{ ?>
	getMap();
	<?php } ?>
});

$(window).resize(function(e) {
	var height = $(window).height();
	var width = $(window).width();
	//alert(width);
	$('#map_canvas').css('width',width);
	$('#map_canvas').css('height',height);
	$('#map_canvas').css('width',width);
	$('header').css('width',width);
});
</script>


</body>
</html>