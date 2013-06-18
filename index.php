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
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=places"></script>
        <script type="text/javascript"> 
        var map;
        var infowindow; 
        
        function initialize() { 
        var latlng = new google.maps.LatLng(11.011513148990913,-74.83911499999999); 
        var myOptions = { 
        zoom: 12, 
        center: latlng, 
        mapTypeId: google.maps.MapTypeId.ROADMAP 
        }; 
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions); 
        
        var input=(document.getElemetById('tarjet'));
        var searchBox=new googe.maps.places.searchBox(input);
        var markers = [];

        google.maps.event.addListener(searchBox, 'places_changed', function() {
        var places = searchBox.getPlaces();

        for (var i = 0, marker; marker = markers[i]; i++) {
          marker.setMap(null);
        }

        markers = [];
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0, place; place = places[i]; i++) {
          var image = {
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(25, 25)
          };

          var marker = new google.maps.Marker({
            map: map,
            icon: image,
            title: place.name,
            position: place.geometry.location
          });

          markers.push(marker);

          bounds.extend(place.geometry.location);
        }

        map.fitBounds(bounds);
      });

      google.maps.event.addListener(map, 'bounds_changed', function() {
        var bounds = map.getBounds();
        searchBox.setBounds(bounds);
      });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
        
        


    </script>
    </head>   
    <body >    
        <?php 
        session_start();
        if(!isset($_SESSION['userid'])){
            header("location:login.php");
        }else{
        ?>
           <div class="login-help">
                <p><a href="logout.php">>>SALIR<<</a></p>
           </div>   
            <div id="panel">
              <input id="target" type="text" placeholder="Search Box">
            </div>
           
            <div id="map"> 
            <div id="map_canvas"></div> 
             
            

            <div class="container"> 
            <p><input type="text" id="address" placeholder="Escribe aquí tu lugar..." value="" class="input"> 
               <input type="button" value="Buscar" onclick="geocode()" class="button">
               <input type="button" value="Insertar marcador" onclick="addMarkerAtCenter()" class="button">
            </p>
            </div> 
            
                 
               
         <?php 
        }
        ?>
    </body>
</html>
