$(document).ready(function () {
    BASE_URL = $("#baseurl").val();
    $(".pick").on("click", function () {
        var player_id = $(this).attr("player_id");
        var squad = $("#squad").val();
        if (!squad) {
            alert("Please select the strategy.");
        } else {
            $.ajax({
                url: BASE_URL + "manage/select",
                type: 'POST',
                data: {player_id: player_id},
                dataType: 'json',
                success: function (response) {
                    if (response.error) {
                        alert(response.error);
                    } else {
                        $("#budget").text("$" + response.budget + "m");
                        $(".pick[player_id=" + player_id + "]").addClass('disabled');
                        $("#team").html("").html(response.html);
                    }
                }
            });
        }
    });


    $(document.body).on('click', '.remove', function () {
        var player_id = $(this).attr("player_id");
        $.ajax({
            url: BASE_URL + "manage/remove",
            type: 'POST',
            data: {player_id: player_id},
            dataType: 'json',
            success: function (response) {
                if (response) {
                    $("#budget").text("$" + response.budget + "m");
                    $(".pick[player_id=" + player_id + "]").removeClass('disabled');
                    $("#team").html("").html(response.html);
                }
            }
        });
    });

    $("#squad").on('change', function () {
        var squad = $("#squad").val();
        $.ajax({
            url: BASE_URL + "manage/changeSquad",
            type: 'POST',
            data: {squad: squad},
            dataType: 'text',
            success: function (response) {
                if (response) {
                    location.reload();
                }
            }
        });
    });

    $(document.body).on('click', '#saveName', function () {
        var name = $("#team_name").val();
        if (name != "") {
            $.ajax({
                url: BASE_URL + "manage/setName",
                type: 'POST',
                data: {name: name},
                dataType: 'text',
                success: function (response) {
                    if (response) {
                        $("#team_name").attr('disabled', 'disabled');
                        $("#saveName").attr('value', 'EDIT');
                        $("#saveName").attr('id', 'editName');
                    }
                }
            });
        } else {
            alert("Please enter a team name.");
        }
    });

    $(document.body).on('click', '#editName', function () {
        $("#team_name").removeAttr('disabled');
        $("#editName").attr('value', 'SAVE');
        $("#editName").attr('id', 'saveName');
        
    });

    $("#filter").on('change', function () {
        var filter = $("#filter").val();
        window.location.href = BASE_URL + "manage/index/?filter=" + filter;
    });
});
