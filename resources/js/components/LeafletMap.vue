<template>
    <div class="map" id="map"></div>
</template>

<script>
import coordinates from "./coordinates";
import isInDanger from "./utils/isInDanger";

export default {
    name: "LeafletMap",
    data() {
        return {
            map: null,
            greenIcon: null,
            redIcon: null,
            coordinates: [],
            markers: []
        };
    },
    props: {
        calls: {
            type: Array,
            default: () => []
        }
    },
    mounted() {
        this.map = L.map("map").setView([22.40694, -79.96472], 9);

        this.greenIcon = L.icon({
            iconUrl: "images/map-marker.svg",

            iconSize: [38, 95], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62], // the same for the shadow
            popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
        });

        this.redIcon = L.icon({
            iconUrl: "images/map-marker-alert.svg",

            iconSize: [48, 105], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62], // the same for the shadow
            popupAnchor: [-3, -76], // point from which the popup should open relative to the iconAnchor
            className: "alert-marker"
        });

        this.formatCoordinates();

        L.tileLayer(
            "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}",
            {
                attribution:
                    'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: "mapbox/streets-v11",
                tileSize: 512,
                zoomOffset: -1,
                accessToken: process.env.MIX_MAPBOX_TOKEN
            }
        ).addTo(this.map);
    },
    watch: {
        calls() {
            this.removeMarkers();
            this.makeMarkers();
        }
    },
    methods: {
        formatCoordinates() {
            this.coordinates = coordinates
                .map(coordinate => {
                    if (!this.isCoordinate(coordinate.Coordenadas)) return null;
                    return {
                        center: coordinate.Centro,
                        key: coordinate.Clave,
                        coordinate: coordinate.Coordenadas.split(",")
                    };
                })
                .filter(coordinate => coordinate);
        },
        makeMarkers() {
            this.calls.forEach(call => {
                const coordinate = this.coordinates.find(
                    coordinate => coordinate.key === call.centro
                );
                if (!coordinate) return;
                let marker;
                if (
                    isInDanger("ldne", call.NerLDNE) ||
                    isInDanger("ldie", call.NerLDIE)
                ) {
                    marker = L.marker(coordinate.coordinate, {
                        icon: this.redIcon
                    }).addTo(this.map);
                } else {
                    marker = L.marker(coordinate.coordinate, {
                        icon: this.greenIcon
                    }).addTo(this.map);
                }
                marker.bindPopup(this.popupMaker(call));
                this.markers.push(marker);
            });
        },
        popupMaker(call) {
            let popup = "Centro: ";
            call.nombre ? (popup += `<b>${call.nombre}</b>`) : "Santa Clara";
            popup += "<br>";
            popup += "Municipio: ";
            call.municipio
                ? (popup += `<b>${call.municipio}</b>`)
                : "Villa Clara";
            popup += "<br>";
            call.NerLDNE
                ? (popup += `NER LDNE: <b>${call.NerLDNE}</b><br>`)
                : "";
            call.NerLDIE
                ? (popup += `NER LDIE: <b>${call.NerLDIE}</b><br>`)
                : "";
            return popup;
        },
        removeMarkers() {
            for (let i = 0; i < this.markers.length; i++) {
                this.map.removeLayer(this.markers[i]);
                this.markers.splice(i, 1);
            }
        },
        isCoordinate(coordinateToCheck) {
            const regex = /[0-9]+.[0-9]+,-?[0-9]+.[0-9]+/;
            return regex.test(coordinateToCheck);
        }
    }
};
</script>

<style scoped>
.map {
    height: 100vh;
    width: 100vw;
}

.alert-marker {
    animation: palpitation 4s infinite;
}

@keyframes palpitation {
    0% {
        width: 48px;
        height: 105px;
    }
    50% {
        width: 52px;
        height: 115px;
    }
    100% {
        width: 48px;
        height: 105px;
    }
}
</style>
