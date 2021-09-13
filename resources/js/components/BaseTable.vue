<template>
    <table class="base-table">
        <tr>
            <th>Municipio</th>
            <th>Centro</th>
            <th>Indicador</th>
            <th>NER</th>
        </tr>
        <tr v-for="(call, index) in calls" :key="call + index">
            <td>{{ call.municipality }}</td>
            <td>{{ call.center }}</td>
            <td>{{ call.indicator }}</td>
            <td>{{ call.ner }}</td>
        </tr>
    </table>
</template>

<script>
export default {
    name: "BaseTable",
    props: {
        calls: {
            type: Array,
            default: () => []
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

.base-table tr:nth-child(even) {
    background-color: #f2f2f2;
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
</style>
