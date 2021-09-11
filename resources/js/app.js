require("./bootstrap");
const leaflet = require("./leaflet");

/**
 * The following block of code imports vue components automatically
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

import Vue from "vue";
window.Vue = Vue;

const files = require.context("./", true, /\.vue$/i);
files.keys().map(key =>
    Vue.component(
        key
            .split("/")
            .pop()
            .split(".")[0],
        files(key).default
    )
);

/**
 * Creates a vue instance
 */

const app = new Vue({
    el: "#app"
});

module.exports = app;
