<template>
    <div>
        <leaflet-map v-show="active === 'map'" :calls="calls"></leaflet-map>
        <div class="base-table_wrapper" v-show="active === 'table'">
            <base-table class="base-table" :calls="calls"></base-table>
        </div>

        <div
            v-if="loading"
            class="spinner-border position-fixed spinner text-primary"
            role="status"
        ></div>

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
import axios from "axios";
import LeafletMap from "./LeafletMap.vue";

export default {
    data() {
        return {
            active: "map",
            calls: [],
            loading: false,
            firstLoad: true
        };
    },
    components: {
        LeafletMap
    },
    name: "InfoDisplayer",
    mounted() {
        this.getData();
        setInterval(this.getData, process.env.MIX_TIME_INTERVAL || 1800000);
    },
    methods: {
        activate(toActivate) {
            this.active = toActivate;
        },
        async getData() {
            try {
                if (this.firstLoad) {
                    this.loading = true;
                    this.firsLoad = false;
                }
                const response = await axios.get("api/calls");
                this.calls = response.data.data;
            } catch (error) {
                console.log(error);
            }
            this.loading = false;
        }
    }
};
</script>

<style scoped lang="scss">
.btn-group {
    z-index: 1000;
    margin-right: 3em;
}

.spinner {
    z-index: 1000;
    margin: auto;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    text-align: center;
    width: 96px;
    height: 96px;
    border: 0.5em solid currentColor;
    border-right-color: transparent;
}

@media screen and (min-width: 768px) {
    .base-table_wrapper {
        margin: 3em;
    }
}

.base-table {
    margin-top: 5em;
}

.active {
    background-color: #1b4c75;
    color: white;
}
</style>
