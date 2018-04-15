'use strict';


import $ from 'jquery';
import 'bootstrap/dist/js/bootstrap'

window.$ = $;

$(document).ready(function () {
    var $wrapper = $('.js-rep-log-table');
    $("#show-alert").on('click', function(event) {
        console.log("dans show alert event")
        $('.alert').alert()
    });
    // var repLogApp = new RepLogApp($wrapper);
    $('.dropdown-toggle').dropdown();

    $(".close").click(() => {
        $("#alert1").alert("close");
    });

    $(".like-article").on("click", (e) => {
        e.preventDefault();
        let $link = $(e.currentTarget);
        $link.toggleClass('fa-heart-o').toggleClass('fa-heart');

        $.ajax({
            method: 'POST',
            url: $link.attr('href')
        }).done(function(data) {
            $('.js-like-article-count').html(data.hearts);
        })
    });
});
