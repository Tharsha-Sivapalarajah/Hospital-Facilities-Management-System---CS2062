 "use strict"

//position of user
var pos;




//this function is responsible for getting user location and  pinning near by locations.
function showPosition(position){
  pos={lat:position.coords.latitude,lng:position.coords.longitude};
  if(pos){
    
    let loc1 = { lat: 19.76, lng: 20.49};
        let map = new google.maps.Map(document.getElementById("map"), {
          zoom: 10,
          center: loc1,
          //center: pos,
        });
    for (var i = 0; i < geoJson.length; i++) {
      //geoJson[i]['distance']=geoJson[i]['Latitude'] + userLat;
      geoJson[i]['distance']=getDistance(geoJson[i]['Lat'],geoJson[i]['Lon']);
      
    }
    
    //sort the array based on distance
    geoJson.sort((a,b)=>(a.distance -b.distance));

    //display least 3
    displayLocation(geoJson[0],map);
    displayLocation(geoJson[1],map);
    displayLocation(geoJson[2],map);

    //console.log(geoJson);

}
}




//initaiate the map
function initMap() {
    
    
    // get the current location
    if(navigator.geolocation){
      navigator.geolocation.getCurrentPosition(showPosition);

  
     }



}

// for every location setiing up
function displayLocation(location,map) {
      

  const latLng = new google.maps.LatLng(location.Lat, location.Lon);
  const marker=new google.maps.Marker({
  position: latLng,
  map,
  title: "Vaccination Center",
});

  const infowindow = new google.maps.InfoWindow({
    content:` <div>
                      <h3>${location['Name']}</h3>
                      <p>${location['Info']}</p>
              </div>`,
  });

  marker.addListener("click", () => {
    infowindow.open({
      anchor: marker,
      map,
      shouldFocus: false,
    });
  });


}
//convert degree to radian
function deg2rad(deg){
  var pi = Math.PI;
  return deg * (pi/180);
}
//function to get distance between vac coordinate and user
function getDistance(latitude1,longitude1) {
  var earthRadius = 6371; // Radius of the earth in km
  var dLat = deg2rad(pos.lat-latitude1);  // deg2rad below
  var dLon = deg2rad(pos.lng-longitude1); 
  var a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(latitude1)) * Math.cos(deg2rad(pos.lat)) * 
    Math.sin(dLon/2) * Math.sin(dLon/2)
    ; 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  var d = earthRadius * c; 
   
  return d;
}