

$(document).ready(function () {
    setInterval(function () {
        $( ".panel-list" ).load(window.location.href + " .panel-list" );
    }, 1000);
});

