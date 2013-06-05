function doclickSubmit(e) {
    var user = $("#user").val();
    var psw = $("#psw").val();

    ajax2(user, psw);

}

function ajax1(user, psw) {
    $.ajax({
        type: "POST",
        url: "logic/login.php",
        data: { user: user, psw: psw },
        success: function (data) {
            if (data == "ok")
                alert("µÇÂ¼³É¹¦");
            else
                alert(data);

        }
    });
}

function ajax2(user, psw) 
{
    $.ajax({
        type: "POST",
        url: "logic/regedit.php",
        data: {},
        success: function (data) {
            alert(data);
        }
    });
 }

