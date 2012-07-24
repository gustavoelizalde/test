function setHome(){
	Cufon('footer', { fontFamily: 'Gotham Medium', hover:true });
}
	
function getMap(lat,lon){
	/////////////////////// Prototypes
	google.maps.Map.prototype.markers = new Array();
    
	google.maps.Map.prototype.addMarker = function(marker) {
	  	this.markers[this.markers.length] = marker;
	};
	
	/////////////////////// Sizes
	var height = $(window).height();
	var width = $(window).width();
	$('#map_canvas').css('width',width);
	$('#map_canvas').css('height',height);
	$('header').css('width',$(document).width()-10);
	Cufon('.action a', { fontFamily: 'Gotham Medium', hover:true });
	
	///////////////////////// Google Map
	var map;
	var infowindow;
	var directionsDisplay;
	var directionsService;
    
	google.maps.event.addDomListener(window, 'load', initialize);
	
	function initialize(){
    	var myOptions = {
			zoom: 12,  
			mapTypeControl: false,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
      		},
        	mapTypeId: google.maps.MapTypeId.ROADMAP
		};
        
		map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
		directionsDisplay = new google.maps.DirectionsRenderer();
		directionsDisplay.setMap(map);
		
		if(lat == null || lon == null){ ///////// Si no viene posicion en especial
			if(navigator.geolocation){
				navigator.geolocation.getCurrentPosition(
					function(position){
						var pos = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
						map.setCenter(pos);
						savePosition(position.coords.latitude,position.coords.longitude);
					}, function() {
						handleNoGeolocation(true);
					}
				);
			}else{
				// Browser doesn't support Geolocation
				handleNoGeolocation(false);
			}
		}else{ ////////////// Si viene un punto en especial			
			if(navigator.geolocation){
				navigator.geolocation.getCurrentPosition(
					function(position){
						var pos_point = new google.maps.LatLng(lat,lon);
						var pos_geo = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
			
						directionsService = new google.maps.DirectionsService();
						
						var request = {
							origin : pos_geo,
							destination : pos_point,
							travelMode: google.maps.TravelMode.DRIVING
						};
						
						directionsService.route(request, function(result, status) {
							if (status == google.maps.DirectionsStatus.OK) {
								directionsDisplay.setDirections(result);
							}
						});
						
						map.setCenter(pos_geo);
						
					}, function() {
						handleNoGeolocation(true);
					}
				);
			}else{
				// Browser doesn't support Geolocation
				handleNoGeolocation(false);
			}
		}
		
		///// Add markets
		$.ajax({
			url: 'getPuntos.php',
			dataType: "json"
		}).done(function(data){
			//// Marcadores Test
			var marks = data;
			
			//// Add Marcadores
			for(var i=0; i<marks.length; i++){
				var mark = marks[i];
				var texto = "<h2>"+mark.titulo+"</h2><p><b>Dirección: </b>"+mark.direccion+"<br><b>Teléfono: </b>"+mark.telefono+"<br><b>Horario: </b>"+mark.horario+"<br><b>Contacto: </b>"+mark.contacto+"<br><b>Email: </b>"+mark.email+"<br></p>"
				map.addMarker(createMarker(texto,mark.latitud, mark.longitud));
			};
			
			function createMarker(name, _lat, _lon) {
				var latlng = new google.maps.LatLng(_lat,_lon);
				var marker = new google.maps.Marker({position: latlng, map: map});
				google.maps.event.addListener(marker, "click", function() {
					if (infowindow) infowindow.close();
					infowindow = new google.maps.InfoWindow({content: name});
					infowindow.open(map, marker);
				});
				if(lat == _lat && lon == _lon){
					infowindow = new google.maps.InfoWindow({content: name});
					infowindow.open(map, marker);
				}
				return marker;
			}
		});
	}

	function handleNoGeolocation(errorFlag){
    	if (errorFlag){
        	var content = 'Error: The Geolocation service failed.';
        }else {
        	var content = 'Error: Your browser doesn\'t support geolocation.';
        }

        var options = {
        	map: map,
          	position: new google.maps.LatLng(60, 105),
          	content: content
        };

        var infowindow = new google.maps.InfoWindow(options);
        map.setCenter(options.position);
	}
}

function getPuntos(){
	var object = null;
	$.ajax({
	  	url: 'getPuntos.php',
		dataType: "json"
	}).done(function(data){
  		object = data;
		alert(object);
	});
	alert(object);
}

function savePosition(_latitud,_longitud){
	$.ajax({
  		url: 'save_position.php',
		type: 'POST',
  		data:{
			latitud : _latitud,
			longitud : _longitud
		}
	});
}

function setList(){
	Cufon('.lista ul li h2', { fontFamily: 'Gotham Medium', hover:true });
	Cufon('a.btn_simple', { fontFamily: 'Gotham Medium', hover:true });
	//$('#locales').css('height',getSize().alto);
}

function setDetail(){
	Cufon('article h1', { fontFamily: 'Gotham Medium', hover:true });
	Cufon('a.tel', { fontFamily: 'Gotham Medium', hover:true });
}

function getSize(){
	var _screen = {};
	var _alto = $(window).height();
	var _ancho = $(window).width();
	_screen = {alto:_alto,ancho:_ancho};
	return _screen;
}