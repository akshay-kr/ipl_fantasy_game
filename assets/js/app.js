$(document).ready(function () {
    BASE_URL = $("#baseurl").val();
    $(".pick").on("click", function () {
        var player_id = $(this).attr("player_id");
        $.ajax({
            type: 'POST',
            url: BASE_URL + "manage/select",
            data: {player_id: player_id},
            success: function (response) {
                if (response) {
                    alert(response);
                }
            }
        });
    });

});
