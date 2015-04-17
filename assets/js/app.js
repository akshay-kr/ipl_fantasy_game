$(document).ready(function () {
    BASE_URL = $("#baseurl").val();
    $(".pick").on("click", function () {
        var player_id = $(this).attr("player_id");
        $.ajax({
            url: BASE_URL + "manage/select",
            type: 'POST',
            data: {player_id: player_id},
            dataType: 'json',
            success: function (response) {
                if (response) {
                    $("#budget").text("$"+response.budget+"m");
                    $("#team").html("").html(response.html);
                }
            }
        });
    });

});
