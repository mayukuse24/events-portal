
// 17.447347, 78.348785
var map;
var infoWindow;

var markersData = [
   {
      lat: 40.6386333,
      lng: -8.745,
      name: "hjk"
   },
   {
      lat: 40.59955,
      lng: -8.7498167,
      name: "iop"
   },
   {
      lat: 40.6247167,
      lng: -8.7129167,
      name: "jkl"
   },
   {
      lat: 40.6247167,
      lng: -8.7129167,
      name: "viviv"
   } 
];

// for (var i = 0; i < data.length; i++) {

//     markers.push(marker);

// }

function initialize() {
   var mapOptions = {
      center: new google.maps.LatLng(40.601203,-8.668173),
      zoom: 9,
      mapTypeId: 'roadmap',
   };

   map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

   infoWindow = new google.maps.InfoWindow();

   google.maps.event.addListener(map, 'click', function() {
      infoWindow.close();
   });

   displayMarkers();
}
google.maps.event.addDomListener(window, 'load', initialize);


function displayMarkers(){

   var bounds = new google.maps.LatLngBounds();
   
   for (var i = 0; i < markersData.length; i++)
   {

         var latlng = new google.maps.LatLng(markersData[i].lat, markersData[i].lng);   
         var name = markersData[i].name;

         createMarker(latlng, name);

         bounds.extend(latlng);  
   }

   map.fitBounds(bounds);
}

function createMarker(latlng, name){
   var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      title: name,
      // icon: markerIcon,
      animation: google.maps.Animation.DROP
   });

   google.maps.event.addListener(marker, 'click', function() {
      
      var iwContent = '<div class="mylabel">' + name +
         '</div>';
      
      infoWindow.setContent(iwContent);
      marker.setAnimation(google.maps.Animation.BOUNCE);
      infoWindow.open(map, marker);
   });

   google.maps.event.addListener(infoWindow,'closeclick',function() {
        marker.setAnimation(google.maps.Animation.DROP);
    });
}