<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="assets/js/jquery-3.4.1.min.js"></script>
        <title>My Google Map</title>
        <style>
            #map {
                height: 400px;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <h1>My Google Map</h1>
        <div id="map"></div>
    <script>
        const CFG_URL_IMAGES = 'http://localhost/maps-api/assets/images';
        const CFG_URL_ICON = 'http://localhost/maps-api/assets/images/icons';
        var api_url = 'http://localhost/maps-api/get_info.php';

        var g_clat = 0;
        var g_clng = 0;

        //centerPos
        if(g_clat==0 && g_clng==0){
            centerPos = new google.maps.LatLng(36.08361111, 140.09638888);
        }else{
            centerPos = new google.maps.LatLng(g_clat, g_clng);
        }

        // Data source list
        function initMap() {
            mapOptions = {
                componentRestrictions: {country:'jp'},
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };

            // new map
            var map = new google.maps.Map(document.getElementById('map'), options);

            // Add marker
            var icon = new google.maps.MarkerImage(CFG_URL_ICON + '/house9_google.png',
                new google.maps.Size(55, 32)
            );
            var marker = new google.maps.Marker({
                position: {lat: 42.466763, lng: -70.949493},
                map: map,
                icon: icon
            });

            //maker click to show summary info
            google.maps.event.addListener(marker, 'click', function() {
                $.get(api_url, function(data, status, xhr) {
                    var infoWindow = new google.maps.InfoWindow({
                        content: data
                    });
                    infoWindow.open(map, marker);
                })
            });
        }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAp74vTnoq1evX8zDSTFnvvRt6s4FgO6V8&callback=initMap">
    </script>
    </body>
</html>