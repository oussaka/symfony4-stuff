'use strict';

import $ from 'jquery';
import 'bootstrap-sass';
// require('bootstrap-sass');

window.$ = $;

$(document).ready(function () {
    var $wrapper = $('.js-rep-log-table');
    $("#show-alert").on('click', function(event) {
        console.log("dans show alert event")
        $('.alert').alert()
    });
    // var repLogApp = new RepLogApp($wrapper);
    $('.dropdown-toggle').dropdown();

    console.log("oXXXopp");
});
