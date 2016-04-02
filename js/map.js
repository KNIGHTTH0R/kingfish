// Provide your access token
L.mapbox.accessToken = 'pk.eyJ1IjoibGljayIsImEiOiI0MjQ3YjI2NGVjY2IyYzVkZTU2ODk4MzhlNTJlNTk5MyJ9.aMrRUwEV0A2QYoGUlAk1Jw';
// Create a map in the div #map
/* L.mapbox.map('map', 'lick.7c45cff6'); */

var map = L.mapbox.map('map', 'mapbox.streets').setView([44.56, -123], 12);