<template>
    <div class="map" id="map"></div>
</template>

<script>
import coordinates from "./coordinates";

export default {
    name: "LeafletMap",
    data() {
        return {
            map: null,
            greenIcon: null,
            redIcon: null
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

        L.marker([22.40694, -79.96472], { icon: this.greenIcon }).addTo(
            this.map
        );
        L.marker([22.406, -79.96472], { icon: this.redIcon }).addTo(this.map);

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
                    "pk.eyJ1IjoidGF1cm9tYWNoaWFuIiwiYSI6ImNrdGQ2cTduOTBjb24yb3BwdmkwZXNpeWIifQ.dpvMWahJDqk3hwLs6IaqkQ"
            }
        ).addTo(this.map);
    },
    computed: {
        coordinates() {
            return coordinates
                .map(coordinate => {
                    if (!this.isCoordinate(coordinate.Coordenadas)) return null;
                    return {
                        center: coordinate.Centro,
                        key: coordinate.Clave,
                        coordinate: coordinate.Coordenadas.split(",")
                    };
                })
                .filter(coordinate => coordinate);
        }
    },
    methods: {
        makeMarkers() {
            this.calls.forEach(call => {
                const coordinate = this.coordinates.find(
                    coordinate => coordinate.center === call.center
                );
                if (this.isInDanger(call.indicator, call.ner)) {
                    L.marker(coordinate.coordinate, {
                        icon: this.redIcon
                    }).addTo(this.map);
                } else {
                    L.marker(coordinate.coordinate, {
                        icon: this.greenIcon
                    }).addTo(this.map);
                }
            });
        },
        isCoordinate(coordinateToCheck) {
            const regex = /[0-9]+.[0-9]+, -?[0-9]+.[0-9]+/;
            return regex.test(coordinateToCheck);
        },
        isInDanger(indicator, ner) {
            if (indicator === "ldne" && ner < 97.1) {
                return true;
            }
            if (indicator === "ldie" && ner < 92) {
                return true;
            }
            return false;
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
