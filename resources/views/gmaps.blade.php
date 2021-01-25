<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My Map</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Fonts -->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
       
       <script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBkNIoF3aKhZTq1NkHhiZjc4mF8izj7Fhc'></script>
       
       
       <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>

        

 
        
        <!-- Styles -->
        <style type="text/css">
            #mymap {
                border:1px solid red;
                width: 900px;
                height: 600px;
            }
        </style>
    </head>
    <body>
       <h1>Registro de Actividades "Taller de Grado I"</h1>
        <select name="celular" id="idNombre" >
        <?php
            
            foreach ($nombres as $nombre){
                
        ?>
                <option value=<?= $nombre->nombre?>>
                <?= $nombre->nombre?>
                </option>
            
            <?php }?>
        
        </select>


       <button  onclick= 'obtenerRuta()'> Mostrar Caminata </button>
       <div id="mymap"></div>
           <script type="text/javascript">
   
    var map;
    mostrarMapa();

    function presiona(){
        alert('hola');
        console.log(puntos);

    }

  
    function obtenerRuta(){
       // var x= $( "#idNombre" ).val();
        var e = document.getElementById('idNombre');
        var i= e.selectedIndex;
        var name = e.options[i].value;

        $.ajax({
            type: "POST",
            url: 'rutas',
            ///hora data: { nombre: name,hora: _token: '{{csrf_token()}}' },
            data: { nombre: name, _token: '{{csrf_token()}}' },
            success: function (data) {
            //console.log(data);
                mostrarRuta(data.rutas);
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);

            },
        });
        /*
        $.post('rutas',
        {nombre:name  

        },
         function(data,status){
        for (var clave in data.rutas )    
            console.log(data.rutas [clave]);
        //console.log(data.status); 
        });
*/
        
    }

    function mostrarMapa(){
        map = new google.maps.Map(document.getElementById('mymap'), {
            zoom: 12,
            center: {lat: -17.79345808196531, lng: -63.178986399999985},
            mapTypeId: 'terrain'
            });

    }



     function mostrarRuta(puntos){

  
   

        /*var mymap = new GMaps({
         el: '#mymap',
         lat: -17.79345808196531,
          lng: -63.178986399999985,
         zoom:14
        });*/
 /*       var map = new google.maps.Map(document.getElementById('mymap'), {
            zoom: 12,
            center: {lat: -17.79345808196531, lng: -63.178986399999985},
            mapTypeId: 'terrain'
            });
*/
        var pto= new Array();
        
        for (var punto of puntos )    
            //console.log(punto.lat);
            pto.push( {lat: punto.lat, lng: punto.lng} );

 /*       $.each( registros, function( index, value ){
            puntos.push( {lat: value.lat, lng: value.lng} );
        /*  mymap.addMarker({
            lat: value.lat,
            lng: value.lng,
            title: value.nombre,
            click: function(e) {
                alert('This is '+value.nombre+', gujarat from India.');
            }
                    });
//        });

*/
    var flightPath = new google.maps.Polyline({
          path: pto,
          geodesic: true,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

    flightPath.setMap(map);

   }


 

 </script>
    </body>
</html>