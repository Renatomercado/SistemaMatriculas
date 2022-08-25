let map = L.map('map').setView([-32.995790, -71.266827],12)

//Agregar tilelAyer mapa base desde openstreetmap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

document.getElementById('select-location').addEventListener('change',function(e){
  let coords = e.target.value.split(",");
  map.flyTo(coords,17);
})

// Agregar coordenadas para dibujar una polilinea
var coord_camino = [
    [-32.981033, -71.277505],
    [-32.980196, -71.276808],
    [-32.979359, -71.276111],
    [-32.979701, -71.275607],
    [-32.980043, -71.275843],
    [-32.981492, -71.276809],
];

var camino = L.polyline(coord_camino, {
    color: 'red'
}).addTo(map);

// Agregar un marcador
var marker_cerro = L.circleMarker(L.latLng(-32.992160, -71.164834), {
    radius: 6,
    fillColor: "#ff0000",
    color: "blue",
    weight: 2,
    opacity: 1,
    fillOpacity: 0.6,
}).addTo(map);

var marker_abuela = L.circleMarker(L.latLng(-32.992160, -71.164834),{
    radius: 6,
    fillColor: "#ff0000",
    color: "blue",
    weight: 2,
    opacity: 1,
    fillOpacity: 0.6,
}).addTo(map);

var marker_miriam = L.circleMarker(L.latLng(-32.988412, -71.266365),{
    radius: 6,
    fillColor: "#ff0000",
    color: "blue",
    weight: 2,
    opacity: 1,
    fillOpacity: 0.6,
}).addTo(map);

var marker_gema = L.circleMarker(L.latLng(-32.979777, -71.276865),{
    radius: 6,
    fillColor: "#ff0000",
    color: "blue",
    weight: 2,
    opacity: 1,
    fillOpacity: 0.6,
}).addTo(map);

var marker_ivan = L.circleMarker(L.latLng(-32.998081, -71.230985),{
    radius: 6,
    fillColor: "#ff0000",
    color: "blue",
    weight: 2,
    opacity: 1,
    fillOpacity: 0.6,
}).addTo(map);

var marker_betty = L.circleMarker(L.latLng(-32.992466, -71.164571),{
    radius: 6,
    fillColor: "#ff0000",
    color: "blue",
    weight: 2,
    opacity: 1,
    fillOpacity: 0.6,
}).addTo(map);

var marker_gonzalo = L.circleMarker(L.latLng(-33.016900, -71.540701),{
    radius: 6,
    fillColor: "#ff0000",
    color: "blue",
    weight: 2,
    opacity: 1,
    fillOpacity: 0.6,
}).addTo(map);

var marker_pia = L.circleMarker(L.latLng(-33.619632, -71.612461),{
    radius: 6,
    fillColor: "#ff0000",
    color: "blue",
    weight: 2,
    opacity: 1,
    fillOpacity: 0.6,
}).addTo(map);

var marker_ale = L.circleMarker(L.latLng(-33.007570, -71.265156),{
    radius: 6,
    fillColor: "#ff0000",
    color: "blue",
    weight: 2,
    opacity: 1,
    fillOpacity: 0.6,
}).addTo(map);

var marker_leo = L.circleMarker(L.latLng(-33.026368, -71.548994),{
    radius: 6,
    fillColor: "#ff0000",
    color: "blue",
    weight: 2,
    opacity: 1,
    fillOpacity: 0.6,
}).addTo(map);



// Agregar la leyenda
const legend = L.control.Legend({
    position: "bottomright",
    collapsed: false,
    symbolWidth: 24,
    opacity:1,
    column:1,
    legends: [
        {
            label: "Villa Las Americas",
            type: "circle",
            radius: 6,
            color: "blue",
            fillColor: "#FF0000",
            fillOpacity: 0.6,
            weight: 2,
            layers: [marker_cerro],
            layers: [marker_abuela],
            layers: [marker_ale],
            layers: [marker_betty],
            layers: [marker_gema],
            layers: [marker_gonzalo],
            layers: [marker_ivan],
            layers: [marker_pia],
            layers: [marker_leo],
            inactive: false,
        }, {
            label: "Limite villa las americas",
            type: "polyline",
            color: "#FF0000",
            fillColor: "#FF0000",
            weight: 2,
            layers: camino
        }, {
            label: "Poligono",
            type: "polygon",
            sides: 5,
            color: "#FF0000",
            fillColor: "#FF0000",
            weight: 2
        }]
}).addTo(map);