<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/estilo.css" media="all">
        
        <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWCHf6u-G9HZNxSFUgJk32_kSzPOc_eSI&sensor=false">            
        </script>
    
    </head>   
    
    <body onload="initialize()" onunload="GUnload()">    
        <?php 
        session_start();
        //include_once "conexion.php";
        if(!isset($_SESSION['userid'])){
            header("location:login.php");
        }else{
            
        ?>
        
       <script type="text/javascript"> 
        var map; 
        var geocoder; 
        var centerChangedLast; 
        var reverseGeocodedLast; 
        var currentReverseGeocodeResponse; 
        function initialize() { 
        var latlng = new google.maps.LatLng(11.011513148990913,-74.83911499999999); 
        var myOptions = { 
        zoom: 11, 
        center: latlng, 
        mapTypeId: google.maps.MapTypeId.ROADMAP 
        }; 
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions); 
        geocoder = new google.maps.Geocoder(); 
        setupEvents(); 
        centerChanged(); 
        } 

        function setupEvents() { 
        reverseGeocodedLast = new Date(); 
        centerChangedLast = new Date(); 

        setInterval(function() { 
        if((new Date()).getSeconds() - centerChangedLast.getSeconds() > 1) { 
        if(reverseGeocodedLast.getTime() < centerChangedLast.getTime()) 
        reverseGeocode(); 
        } 
        }, 1000); 

        google.maps.event.addListener(map, 'zoom_changed', function() { 
        document.getElementById("zoom_level").innerHTML = map.getZoom(); 
        }); 

        google.maps.event.addListener(map, 'center_changed', centerChanged); 

        google.maps.event.addDomListener(document.getElementById('crosshair'),'dblclick', function() { 
        map.setZoom(map.getZoom() + 1); 
        }); 

        } 

        function getCenterLatLngText() { 
        return '(' + map.getCenter().lat() +', '+ map.getCenter().lng() +')'; 
        } 

        function centerChanged() { 
        centerChangedLast = new Date(); 
        var latlng = getCenterLatLngText(); 
        var lat = map.getCenter().lat(); 
        var lng = map.getCenter().lng(); 
        document.getElementById('lat').innerHTML = lat; 
        document.getElementById('lng').innerHTML = lng; 
        document.getElementById('formatedAddress').innerHTML = ''; 
        currentReverseGeocodeResponse = null; 
        } 

        function reverseGeocode() { 
        reverseGeocodedLast = new Date(); 
        geocoder.geocode({latLng:map.getCenter()},reverseGeocodeResult); 
        } 

        function reverseGeocodeResult(results, status) { 
        currentReverseGeocodeResponse = results; 
        if(status == 'OK') { 
        if(results.length == 0) { 
        document.getElementById('formatedAddress').innerHTML = 'None'; 
        } else { 
        document.getElementById('formatedAddress').innerHTML = results[0].formatted_address; 
        } 
        } else { 
        document.getElementById('formatedAddress').innerHTML = 'Error'; 
        } 
        } 

        function geocode() { 
        var address = document.getElementById("address").value; 
        geocoder.geocode({ 
        'address': address, 
        'partialmatch': true}, geocodeResult); 
        } 

        function geocodeResult(results, status) { 
        if (status == 'OK' && results.length > 0) { 
        map.fitBounds(results[0].geometry.viewport); 
        } else { 
        alert("Geocode was not successful for the following reason: " + status); 
        } 
        } 

        function addMarkerAtCenter() { 
        var marker = new google.maps.Marker({ 
        position: map.getCenter(), 
        map: map 
        }); 

        var text = 'Lat/Lng: ' + getCenterLatLngText(); 
        if(currentReverseGeocodeResponse) { 
        var addr = ''; 
        if(currentReverseGeocodeResponse.size == 0) { 
        addr = 'None'; 
        } else { 
        addr = currentReverseGeocodeResponse[0].formatted_address; 
        } 
        text = text + '<br>' + 'Dirección: <br>' + addr; 
        } 

        var infowindow = new google.maps.InfoWindow({ content: text }); 

        google.maps.event.addListener(marker, 'click', function() { 
        infowindow.open(map,marker); 
        }); 
        } 
    </script>   
           <div class="login-help">
                <p><a href="logout.php">Salir</a></p>
           </div>     
           <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
            <div id="map"> 
            <div id="map_canvas"></div> 
            <div id="crosshair"></div> 
            
            <div class="container"> 
            <p><input type="text" id="address" placeholder="Escribe aquí tu lugar..." value="" class="input"> 
               <input type="button" value="Buscar" onclick="geocode()" class="button">
               <input type="button" value="Insertar marcador" onclick="addMarkerAtCenter()" class="button">
            </p> 
            
            </div> 
            <div class="coordinates"> 
                <em class="lat">Latitud</em> 
                <em class="lon">Longitud</em> 
            <span id="lat"></span> 
            <span id="lng"></span> 
            </div> 
                <div class="address"> 
                <span id="formatedAddress">-</span> 
                </div> 
              <span id="zoom_level"></span> 
              

        <?php 
        }
        ?>
    </body>
</html>
