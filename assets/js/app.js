$(document).ready(function () {
    BASE_URL = $("#baseurl").val();

    $("#register").on("click", function () {
        var username = $("#username").val();
        var password = $("#password").val();
        if (username == "") {
            alert("Please enter username.");
        }
        else if (password == "") {
            alert("Please enter password");
        } else {
            $.ajax({
                url: BASE_URL + "user/register",
                type: 'POST',
                data: {username: username, password: password},
                dataType: 'text',
                success: function (response) {
                    if (response) {
                        alert(response);
                    } else {
                        $("#username").val("");
                        $("#password").val("");
                        alert("Successfully registered. Please login.");
                    }
                }
            });
        }
    });

    $("#login").on("click", function () {
        var username = $("#username").val();
        var password = $("#password").val();
        if (username == "") {
            alert("Please enter username.");
        }
        else if (password == "") {
            alert("Please enter password");
        } else {
            $.ajax({
                url: BASE_URL + "user/login",
                type: 'POST',
                data: {username: username, password: password},
                dataType: 'text',
                success: function (response) {
                    if (response == 1) {
                        window.location.href = BASE_URL + "manage/index";
                    } else {
                        alert(response);
                    }
                }
            });
        }
    });

    $("#logout").on("click", function () {
        $.ajax({
            url: BASE_URL + "user/logout",
            type: 'POST',
            data: {},
            dataType: 'text',
            success: function (response) {
                if (response == 1) {
                    window.location.href = BASE_URL + "user/index";
                } else {
                    alert("Something went wrong!!!!");
                }
            }
        });

    });

    $("#save").on("click", function () {
        var team_name = $("#team_name").val();
        if (team_name == "") {
            alert("Please enter a team name.")
        } else {
            $.ajax({
                url: BASE_URL + "manage/save",
                type: 'POST',
                data: {team_name: team_name},
                dataType: 'text',
                success: function (response) {
                    if (response) {
                        alert(response);
                    } else {
                        alert('Saved Successfully');
                    }
                }
            });
        }

    });

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

    $(document.body).on('click', '#checkName', function () {
        var name = $("#team_name").val();
        if (name != "") {
            $.ajax({
                url: BASE_URL + "manage/checkName",
                type: 'POST',
                data: {name: name},
                dataType: 'text',
                success: function (response) {
                    if (response) {
                        alert(response);
                    }else{
                        alert("Team name is available.");
                        $("#team_name").attr('disabled', 'disabled');
                        $("#checkName").attr('value', 'EDIT');
                        $("#checkName").attr('id', 'editName');
                    }
                }
            });
        } else {
            alert("Please enter a team name.");
        }
    });

    $(document.body).on('click', '#editName', function () {
        $("#team_name").removeAttr('disabled');
        $("#editName").attr('value', 'CHECK AVAILABILITY');
        $("#editName").attr('id', 'checkName');

    });

    $("#filter").on('change', function () {
        var filter = $("#filter").val();
        window.location.href = BASE_URL + "manage/index/?filter=" + filter;
    });
});
