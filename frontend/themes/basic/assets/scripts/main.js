$( document ).ready(function() {
    console.log( "ready!" );

    //bootstrap 3 force click menu override
    $('.dropdown-toggle').on('click', function () {
        window.location = $(this).attr('href');
    });
});