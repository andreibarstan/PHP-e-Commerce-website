$(document).ready(function() { //execute after the page is loaded
    //trigger transition when mouse hover over div
    $('.col3').hover(
        function(){
        $(this).animate({
            marginTop: "-=1%"
        },200);
    }, //return to initial position when mouse does not hover over
        function(){
            $(this).animate({
                marginTop: "0%"
            },200);
        }
    );
});