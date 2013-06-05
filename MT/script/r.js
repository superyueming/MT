function register(d) {
    $.ajax({
        type: "POST",
        url: "logic/register.php",
        data: d,
        dataType: "text",
        success: function (data) {
            alert(data);
        }
    });
}

function login(d) {
    d.type = 1;
    $.ajax({
        type: "POST",
        url: "logic/login.php",
        data: d,
        success: function (data) {
            alert(data);
        }
    });
}

function logout(d) {
    d.type = 2;
    $.ajax({
        type: "POST",
        url: "logic/login.php",
        data: d,
        success: function (data) {
            alert(data);
            window.location.reload();
        }
    });
}

function edit(d) {
    $.ajax({
        type: "POST",
        url: "logic/editUser.php",
        data: d,
        success: function (data) {
            alert(data);
            window.location.reload();
        }
    });
}

function addLoc(d) {
    $.ajax({
        type: "POST",
        url: "logic/locationAdd.php",
        data: d,
        success: function (data) {
            alert(data);
        }
    });
}

function editLoc(d) {
    $.ajax({
        type: "POST",
        url: "logic/locationEdit.php",
        data: d,
        success: function (data) {
            alert(data);
        }
    });
}

function followLoc(d) {alert('go');
    $.ajax({
        type: "POST",
        url: "logic/locationFollow.php",
        data: d,
        success: function (data) {
            alert(data);
        }
    });
}

function addActivity(d) {
    $.ajax({
        type: "POST",
        url: "logic/activityAdd.php",
        data: d,
        success: function (data) {
            alert(data);
        }
    });
}

function editActivity(d) {
    $.ajax({
        type: "POST",
        url: "logic/activityEdit.php",
        data: d,
        success: function (data) {
            alert(data);
        }
    });
}

function followActivity(d) {
    $.ajax({
        type: "POST",
        url: "logic/activityFollow.php",
        data: d,
        success: function (data) {
            alert(data);
        }
    });
 }