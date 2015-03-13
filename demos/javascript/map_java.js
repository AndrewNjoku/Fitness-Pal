
// This example uses the autocomplete feature of the Google Places API.
// It allows the user to find all GYM and fitness center in a given place.
//It then displays markers for all the GYM and fitness centre returned,
// with on-click details for each GYM and fitness center in UK.
var map, places, infoWindow;
var markers = [];
var autocomplete;
var countryRestrict = { 'country': 'uk' };
var MARKER_PATH = 'https://maps.gstatic.com/intl/en_us/mapfiles/marker_green';
var hostnameRegexp = new RegExp('^https?://.+?/');
var countries = {
  'uk': {
    center: new google.maps.LatLng(54.8, -4.6),
    zoom: 6
  }
};
function initialize() {
  var myOptions = {
    zoom: countries['uk'].zoom,
    center: countries['uk'].center,
    mapTypeControl: false,
    panControl: false,
    zoomControl: false,
    streetViewControl: false
  };
  map = new google.maps.Map(document.getElementById('map-canvas'), myOptions);
  infoWindow = new google.maps.InfoWindow({
      content: document.getElementById('info-content')
      });
  // Create the autocomplete object and associate it with the UI input control.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
      {
        //types: ['(cities)'],
		//types: ['(name)'],
        componentRestrictions: countryRestrict
      });
  places = new google.maps.places.PlacesService(map);
  google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged);
  
  google.maps.event.addDomListener(document.getElementById('country'), 'change',
      setAutocompleteCountry);
}
// When the user selects a his or her place of search, get the place details and
// zoom the map in.
function onPlaceChanged() {
  var place = autocomplete.getPlace();
  if (place.geometry) {
    map.panTo(place.geometry.location);
    map.setZoom(12);
    search();
  } else {
    document.getElementById('autocomplete').placeholder = 'Enter a city';
  }
}
// Search for GYM in the UK, within the viewport of the map.
function search() {
  var search = {
    bounds: map.getBounds(),
    types: ['gym']
  };
  places.nearbySearch(search, function(results, status) {
    if (status == google.maps.places.PlacesServiceStatus.OK) {
      clearResults();
      clearMarkers();
      // Create a marker for each GYM and fitness center found, and
      // assign a letter of the alphabetic to each marker icon.
      for (var i = 0; i < results.length; i++) {
        var markerLetter = String.fromCharCode('A'.charCodeAt(0) + i);
        var markerIcon = MARKER_PATH + markerLetter + '.png';
        // Use marker animation to drop the icons incrementally on the map.
        markers[i] = new google.maps.Marker({
          position: results[i].geometry.location,
          animation: google.maps.Animation.DROP,
          icon: markerIcon
        });
        // If the user clicks a GYM and fitness center marker, show the details of that GYM and fitness center
        // in an info window.
        markers[i].placeResult = results[i];
        google.maps.event.addListener(markers[i], 'click', showInfoWindow);
        setTimeout(dropMarker(i), i * 100);
        addResult(results[i], i);
      }
    }
  });
}
function clearMarkers() { 
  for (var i = 0; i < markers.length; i++) {
    if (markers[i]) {
      markers[i].setMap(null);
    }
  }
  markers = [];
}
// center and zoom the map when the user hit search button 
function setAutocompleteCountry() {
  var country = document.getElementById('country').value;
  if (country == 'all') {
    autocomplete.setComponentRestrictions([]);
    map.setCenter(new google.maps.LatLng(54.8, -4.6));
    map.setZoom(2);
  } else {
    autocomplete.setComponentRestrictions({ 'country': country });
    map.setCenter(countries[country].center);
    map.setZoom(countries[country].zoom);
  }
  clearResults();
  clearMarkers();
}
function dropMarker(i) {
  return function() {
    markers[i].setMap(map);
  };
}
function addResult(result, i) {
  var results = document.getElementById('results');
  var markerLetter = String.fromCharCode('A'.charCodeAt(0) + i);
  var markerIcon = MARKER_PATH + markerLetter + '.png';
  var tr = document.createElement('tr');
  tr.style.backgroundColor = (i % 2 == 0 ? '#F0F0F0' : '#FFFFFF');
  tr.onclick = function() {
    google.maps.event.trigger(markers[i], 'click');
  };
  var iconTd = document.createElement('td');
  var nameTd = document.createElement('td');
  var icon = document.createElement('img');
  icon.src = markerIcon;
  icon.setAttribute('class', 'placeIcon');
  icon.setAttribute('className', 'placeIcon');
  var name = document.createTextNode(result.name);
  iconTd.appendChild(icon);
  nameTd.appendChild(name);
  tr.appendChild(iconTd);
  tr.appendChild(nameTd);
  results.appendChild(tr);
}
function clearResults() {
  var results = document.getElementById('results');
  while (results.childNodes[0]) {
    results.removeChild(results.childNodes[0]);
  }
}
// Get the place details for a GYM and fitness center. Show the information in an info window,
// anchored on the marker for the GYM and fitness centre that the user selected.
function showInfoWindow() {
  var marker = this;
  places.getDetails({placeId: marker.placeResult.place_id},
      function(place, status) {
        if (status != google.maps.places.PlacesServiceStatus.OK) {
          return;
        }
        infoWindow.open(map, marker);
        buildIWContent(place);
      });
}
// Load the place information into the HTML elements used by the info window.
function buildIWContent(place) {
  document.getElementById('iw-icon').innerHTML = '<img class="gymIcon" ' +
      'src="' + place.icon + '"/>';
  document.getElementById('iw-url').innerHTML = '<b><a href="' + place.url +
      '">' + place.name + '</a></b>';
  document.getElementById('iw-address').textContent = place.vicinity;
  
  if (place.formatted_phone_number) {
    document.getElementById('iw-phone-row').style.display = '';
    document.getElementById('iw-phone').textContent =
        place.formatted_phone_number;
		document.getElementById('iw-phone-row').style.display = 'none';
  } else {
    document.getElementById('iw-phone-row').style.display = 'none';
 }
  // Assign a five-star rating to the GYM and fitness centre, using a black star ('&#10029;')
  // to indicate the rating the GYM and fitness centrehas earned, and a white star ('&#10025;')
  // for the rating points not achieved.
  if (place.rating) {
    var ratingHtml = '';
    for (var i = 0; i < 5; i++) {
      if (place.rating < (i + 0.5)) {
        ratingHtml += '&#10025;';
      } else {
        ratingHtml += '&#10029;';
      }
    document.getElementById('iw-rating-row').style.display = '';
    document.getElementById('iw-rating').innerHTML = ratingHtml;
    }
  } else {
    document.getElementById('iw-rating-row').style.display = 'none';
  }
  // The regexp isolates the first part of the URL (domain plus subdomain)
  // to give a short URL for displaying in the info window.
  if (place.website) {
    var fullUrl = place.website;
    var website = hostnameRegexp.exec(place.website);
    if (website == null) {
      website = 'http://' + place.website + '/';
      fullUrl = website;
    }
    document.getElementById('iw-website-row').style.display = '';
    document.getElementById('iw-website').textContent = website;
  } else {
    document.getElementById('iw-website-row').style.display = 'none';
  }
}
