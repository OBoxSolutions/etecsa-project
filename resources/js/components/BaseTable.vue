<template>
    <table class="base-table">
        <tr>
            <th>Municipio</th>
            <th>Centro</th>
            <th>NerLDNE(%)</th>
            <th>NerLDIE(%)</th>
        </tr>
        <tr
            v-for="(call, index) in calls"
            :key="call + index"
            :class="{ danger: (isInDanger('ldne', call.NerLDNE) || isInDanger('ldie', call.NerLDIE)) }"
        >
            <td>{{ call.municipality }}</td>
            <td>{{ call.center }}</td>
            <td>{{ call.NerLDNE }}</td>
            <td>{{ call.NerLDIE }}</td>
        </tr>
    </table>
</template>

<script>
import isInDanger from "./utils/isInDanger";

export default {
    name: "BaseTable",
    props: {
        calls: {
            type: Array,
            default: () => []
        }
    },
    methods: {
        isInDanger(indicator, ner) {
            return isInDanger(indicator, ner);
        }
    }
};
</script>

<style scoped>
.base-table {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

.base-table td,
.base-table th {
    border: 1px solid #ddd;
    padding: 8px;
}

.base-table tr:hover {
    background-color: #ddd;
}

.base-table th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: var(--primary-color);
    color: white;
}

.danger {
    background-color: var(--danger);
    color: white;
}

.danger:hover {
    background-color: var(--danger-darker) !important;
    color: white !important;
}
</style>
