$(function() {
    $('body').on('click', '.notification_id', function(e){
        e.preventDefault();
        $notificationID = $(this).attr("data-txt");
        $modal_title  = $('#modal-title');
        $modal_body  = $('#modal-body');

        $.ajax({
            url: $("#base_url").val()+'/faculty/getNotificationById/'+$notificationID,
            type: 'GET',
            success: function(response){
                response = $.parseJSON(response);
                $modal_title.html(response[0].title);
                $modal_body.html(response[0].message);
                $modal_title.addClass("md-show");
            },
            error: function (xhr, status, err){
                console.log(err.responseText);
            }
        });
    });
    
    $(".md-close").click(function(){
        $("#modal-1").removeClass("md-show");
    });
});