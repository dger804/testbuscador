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
        var request ={
            location: latlng,
            radius:500,
            types:['hospital']
        };
        infowindow = new google.maps.InfoWindows();
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch(request, callback);  
        } 

        function callbak(results, status){
            if(status == google.maps.places.PlacesServiceStatus.ok){
                for (var i = 0;i < results.length; i++){
                    createMarker(results[i]);
                }
            }
        }

        function createMarker(place){
            var placeLoc = place.geometry.location;
            var marker = new google.maps.Marker({
                map:map,
                position: place.geometry.location

            });
            google.maps.event.addListener(marker, 'click', function(){
                infowindow.setContent(place.name);
                infowindow.open(map, this);
            });
        }

        google.maps.evente.addDomListener(window, 'load',initialize);
        autocomplete = new google.maps.places.Autocomplete(address, myOptions) 

        


    </script>
    </head>   
    <body onload="initialize()" onunload="GUnload()" >    
        <?php 
        session_start();
        if(!isset($_SESSION['userid'])){
            header("location:login.php");
        }else{
        ?>
           <div class="login-help">
                <p><a href="logout.php">>>SALIR<<</a></p>
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
