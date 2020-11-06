$("#register-form").submit(function(e) {
    e.preventDefault();
    var t = $(e.currentTarget),
        n = t.find("button");
    toggleButton(n), sendHttpRequest("POST", "register", t.serializeArray(), function(e) {
        if (e.Code == 200) {
            sweetAlertTime("success", "Chalakorn", e.Message, "./login");
        } else {
            toggleButton(n);
            sweetAlert("error", "Chalakorn", e.Message);
            $('#password').val('');
        }
    })
});