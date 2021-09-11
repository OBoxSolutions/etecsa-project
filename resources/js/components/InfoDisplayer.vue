<template>
    <div>
        <leaflet-map></leaflet-map>
        <div
            class="btn-group position-fixed top-0 end-0 mt-3 ml-3"
            role="group"
            aria-label="Basic example"
        >
            <button
                type="button"
                class="btn btn-primary"
                :class="{ active: active === 'map' }"
            >
                Mapa
            </button>
            <button
                type="button"
                class="btn btn-primary"
                :class="{ active: active === 'table' }"
            >
                Tabla
            </button>
        </div>
    </div>
</template>

<script>
import LeafletMap from "./LeafletMap.vue";

export default {
    data() {
        return {
            active: "map"
        };
    },
    components: {
        LeafletMap
    },
    name: "InfoDisplayer"
};
</script>

<style scoped lang="scss">
.btn-group {
    z-index: 1000;
    margin-right: 3em;
}

.active {
    background-color: #1b4c75;
    color: white;
}
</style>
