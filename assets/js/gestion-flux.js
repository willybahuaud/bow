jQuery(document).ready(function($){
    $(document).on('click','.delete',function(){

        var id_flux = $(this).parent('ul').attr('data-flux');

        $.ajax({
            type: "POST",
            url: "ajax_requests.php",
            data: "id="+id_flux,
            success: function(msg){
                $('ul[data-flux="'+id_flux+'"]').remove();
            }
        });
    });

    $(document).on('click','#logout',function(){
        $.ajax({
            type: "POST",
            url: "/bow/ajax/logout.php",
            success: function(msg){
                window.location.reload();
            }
        });
    });

});