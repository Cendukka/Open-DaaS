$(document).ready(function () {
    let sidebarCollapseBool = false;
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar, #content').toggleClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        if (!sidebarCollapseBool){
            sidebarCollapseBool = true;
        }else{
            sidebarCollapseBool = false;
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

    //User create page's functions
    function microlocation(){
        var $userType = $("#user_type").val();
        if($userType === "2" && $userType != null){
            $("#microlocation").hide();
            $("#toimisto").show();
        }
        else{
            $("#microlocation").show();
            $("#toimisto").hide();
        }
    }
    function source(){
        $("#username").val($("#first_name").val()+'.'+$("#last_name").val());
        $("#email").val($("#first_name").val()+'.'+$("#last_name").val()+"@testdomain.fi");
    }

    microlocation();
    source();
    $('#user_type').on('change',microlocation);
    $('#first_name').on('change',source);
    $('#last_name').on('change',source);



});
<!-- When the user clicks on the button, scroll to the top of the document -->
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}





