<script>
	let btn_salir=document.querySelector(".btn-exit-system");
		btn_salir.addEventListener('click', function(e){
			e.preventDefault();
				Swal.fire({
			title: '¿Quieres Salir del Sistema?',
			text: "La Sesion Actual se Cerrará y Saldras del Sistema",
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Sí, Salir!',
			cancelButtonText: 'No, Cancelar'
		}).then((result) => {
			if (result.value) {
				let url='<?php echo SERVERURL;?>Ajax/loginAjax.php';
				let token='<?php echo $lc->encryption($_SESSION['token_sdu']);?>';
				let email='<?php echo $lc->encryption($_SESSION['email_sdu']);?>';

				let datos = new FormData();
				datos.append("token", token);
				datos.append("email", email);

			fetch(url,{
				method: 'POST',
				body: datos
			})
			.then(respuesta => respuesta.json())
			.then(respuesta => {
				return alertas_ajax(respuesta);
			});
			}
		});
		});
</script>