const mymap = L.map("map").setView([51.505, -0.09], 13);

const greenIcon = L.icon({
    iconUrl: "map-marker.svg",

    iconSize: [38, 95], // size of the icon
    shadowSize: [50, 64], // size of the shadow
    iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
    shadowAnchor: [4, 62], // the same for the shadow
    popupAnchor: [-3, -76], // point from which the popup should open relative to the iconAnchor
});

const redIcon = L.icon({
    iconUrl: "map-marker-alert.svg",

    iconSize: [48, 105], // size of the icon
    shadowSize: [50, 64], // size of the shadow
    iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
    shadowAnchor: [4, 62], // the same for the shadow
    popupAnchor: [-3, -76], // point from which the popup should open relative to the iconAnchor
    className: "alert-marker",
});

const greenMarker = L.marker([51.5, -0.09], { icon: greenIcon }).addTo(mymap);

setTimeout(() => {
    mymap.removeLayer(greenMarker);
    L.marker([51.5, -0.09], { icon: redIcon }).addTo(mymap);
}, 3000);

L.marker([51.7, -0.09], { icon: redIcon }).addTo(mymap);

L.tileLayer(
    "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}",
    {
        attribution:
            'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: "mapbox/streets-v11",
        tileSize: 512,
        zoomOffset: -1,
        accessToken:
            "pk.eyJ1IjoidGF1cm9tYWNoaWFuIiwiYSI6ImNrdGQ2cTduOTBjb24yb3BwdmkwZXNpeWIifQ.dpvMWahJDqk3hwLs6IaqkQ",
    }
).addTo(mymap);
