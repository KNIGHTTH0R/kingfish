// Provide your access token
L.mapbox.accessToken = 'pk.eyJ1IjoibGljayIsImEiOiI0MjQ3YjI2NGVjY2IyYzVkZTU2ODk4MzhlNTJlNTk5MyJ9.aMrRUwEV0A2QYoGUlAk1Jw';
// Create a map in the div #map
/* L.mapbox.map('map', 'lick.7c45cff6'); */

var geocoder = L.mapbox.geocoder('mapbox.places'), map = L.mapbox.map('map', 'lick.pj0o7dkc');

geocoder.query('151 NW Monroe Ave Suite 107, Corvallis, OR', showMap);

function showMap(err, data) {
	if (data.lbounds) {
		map.fitBounds(data.lbounds);
	} else if (data.latlng) {
		map.setView([data.latlng[0], data.latlng[1]], 16);
	}
}