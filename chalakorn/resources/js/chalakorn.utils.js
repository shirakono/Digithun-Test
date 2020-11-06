function sweetAlert(Icon, Title, Text)
{
	Swal.fire({
		icon: Icon,
		title: Title,
		text: Text
	});
}

function sweetAlertTime(Icon, Title, Text, Page, TimerEnable = true, TimerInt = 3000)
{
	Swal.fire({
		icon: Icon,
		title: Title,
		text: Text,
		timer: TimerInt,
		timerProgressBar: TimerEnable,
		onClose: () => {
			window.location = '/' + Page; 
		}
	}).then((result) => {
		if (result.dismiss === Swal.DismissReason.timer) 
		{
			window.location = '/' + Page; 
		}
	});
}

function sendHttpRequest(e, t, n, r) 
{
    "function" == typeof n && (r = n, n = {});
    var i = "/api/" + t;
    $.ajax({
        method: e,
        url: i,
        data: n,
        dataType: "json"
    }).done(function(e) {
        "function" == typeof r && r(e)
    }).fail(function(e, t, n) {
        try {
            var i = JSON.parse(e.responseText);
            void 0 !== i.status ? "function" == typeof r && r(i) : "function" == typeof r && r({
                status: "fail",
                message: "This service is unavailable."
            })
        } catch (e) {
            "function" == typeof r && r({
                status: "fail",
                message: "This service is unavailable."
            })
        }
    })
}

function toggleButton(e) {
    e.attr("disabled") ? e.removeAttr("disabled") : e.attr("disabled", !0)
}