<?php
function SweetAlertTime($icon, $title, $text, $timer, $redirect) {
	echo "<script>
		Swal.fire({
			icon: '".$icon."',
			title: '".$title."',
			text: '".$text."',
			timer: ".$timer.",
			timerProgressBar: true,
			onClose: () => {
				window.location = '".$redirect."'; 
			}
		}).then((result) => {
			if (result.dismiss === Swal.DismissReason.timer) {
				window.location = '".$redirect."'; 
			}
		});
	</script>";
}
?>