const btnInit = document.querySelector('#btn_init')

btnInit.addEventListener('click', (e) => {
	let tipo = document.querySelector('input[name="tipo"]:checked')
	const id = document.querySelector('#mina').value
	if (tipo && id) {
		tipo = tipo.value.toLowerCase()

		location.href = `http://localhost/purchase-order/usuarios/crear/${tipo}/${id}`
	} else {

		const warningModal = document.querySelector('#warning_modal')
		const modalWarning = new bootstrap.Modal(warningModal)

		modalWarning.show()
	}

})