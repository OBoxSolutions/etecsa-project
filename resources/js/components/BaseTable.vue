<template>
    <table class="base-table">
        <tr>
            <th>Company</th>
            <th>Contact</th>
            <th>Country</th>
        </tr>
        <tr>
            <td>Alfreds Futterkiste</td>
            <td>Maria Anders</td>
            <td>Germany</td>
        </tr>
        <tr>
            <td>Berglunds snabbköp</td>
            <td>Christina Berglund</td>
            <td>Sweden</td>
        </tr>
        <tr>
            <td>Centro comercial Moctezuma</td>
            <td>Francisco Chang</td>
            <td>Mexico</td>
        </tr>
        <tr>
            <td>Ernst Handel</td>
            <td>Roland Mendel</td>
            <td>Austria</td>
        </tr>
        <tr>
            <td>Island Trading</td>
            <td>Helen Bennett</td>
            <td>UK</td>
        </tr>
        <tr>
            <td>Königlich Essen</td>
            <td>Philip Cramer</td>
            <td>Germany</td>
        </tr>
        <tr>
            <td>Laughing Bacchus Winecellars</td>
            <td>Yoshi Tannamuri</td>
            <td>Canada</td>
        </tr>
        <tr>
            <td>Magazzini Alimentari Riuniti</td>
            <td>Giovanni Rovelli</td>
            <td>Italy</td>
        </tr>
        <tr>
            <td>North/South</td>
            <td>Simon Crowther</td>
            <td>UK</td>
        </tr>
        <tr>
            <td>Paris spécialités</td>
            <td>Marie Bertrand</td>
            <td>France</td>
        </tr>
    </table>
</template>

<script>
export default {
    name: "BaseTable"
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
