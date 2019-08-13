$(document).ready(function () {
    let sidebarCollapseBool = false;
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar, #content').toggleClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        if (!sidebarCollapseBool){
            sidebarCollapseBool = true;
            $('#sidebar, #content').toggleClass('stay');
        }else{
            sidebarCollapseBool = false;
            $('#sidebar, #content').toggleClass('stay');
        }
    });


    //When the user scrolls down 30px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
            document.getElementById("toTop").style.display = "block";
        } else {
            document.getElementById("toTop").style.display = "none";
        }
    }
});
<!-- When the user clicks on the button, scroll to the top of the document -->
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
