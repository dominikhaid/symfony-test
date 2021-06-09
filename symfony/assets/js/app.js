// app.js
import "../styles/global.scss";

const $ = require("jquery");

// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
window.bootstrap = require("bootstrap");

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');
