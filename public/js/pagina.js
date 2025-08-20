$(document).ready(function() {
    if($('.carousel')!=undefined) {
        $('.carousel').carousel()
    }

    if($('#sidebarCollapse')!=undefined) {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    }
});


