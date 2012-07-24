<?php include("inc_head.php"); ?>
<body class="home">
  <div id="container">
  	  <header><a href="index.php"><img src="img/sellos.png" width="284" height="66" alt="Sellos &amp; comprobantes"></a></header>
  	  <a class="search" href="mapa.php"><span>Buscar</span></a>
<footer><span class="tel">787-289-8753</span><span></span><a href="mailto:info@sellosycomprobantes.com">info@sellosycomprobantes.com</a></footer>
</div>
  
<?php include("inc_scripts.php"); ?> 

<script>
$(document).ready(function(e) {
		setHome();
    });
	
	$(window).resize(function(e) {
        setHome();   
    });
	
   $(window).resize( function(){
   		var height = $(window).height();
    	var width = $(window).width();

    if(width>height) {
      	// Landscape
      	//alert('Landscape');
    } else {
      	// Portrait
      	//alert('Portrait');
    }
});	
</script>


</body>
</html>