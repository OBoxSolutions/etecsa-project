<template>
    <div>
        <leaflet-map v-if="active === 'map'"></leaflet-map>
        <base-table v-else class="base-table"></base-table>
        <div
            class="btn-group position-fixed top-0 end-0 mt-3 ml-3"
            role="group"
            aria-label="Basic example"
        >
            <button
                type="button"
                class="btn btn-primary"
                :class="{ active: active === 'map' }"
                @click="activate('map')"
            >
                Mapa
            </button>
            <button
                type="button"
                class="btn btn-primary"
                :class="{ active: active === 'table' }"
                @click="activate('table')"
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
            active: "map",
            calls: []
        };
    },
    components: {
        LeafletMap
    },
    name: "InfoDisplayer",
    methods: {
        activate(toActivate) {
            this.active = toActivate;
        },
        async getData() {
            try {
                const response = await axios.get();
            } catch (error) {}
        }
    }
};
</script>

<style scoped lang="scss">
.btn-group {
    z-index: 1000;
    margin-right: 3em;
}

.base-table {
    margin-top: 5em;
}

.active {
    background-color: #1b4c75;
    color: white;
}
</style>
