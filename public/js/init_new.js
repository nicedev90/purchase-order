window.addEventListener('DOMContentLoaded', () => {
	checkModal()
})

const checkModal = () => {
	const successModal = document.querySelector('#success_modal')
	// console.log(successModal)
	if (successModal) {
		const modalSuccess = new bootstrap.Modal(successModal)
		modalSuccess.show()
	}
}

const btnInit = document.querySelector('#btn_init')

btnInit?.addEventListener('click', (e) => {
	let btn = e.target
	let tipo = document.querySelector('input[name="tipo"]:checked')
	let id = document.querySelector('#mina').value
	
	let urlRoot 		= btn.getAttribute('data-url')
	let controller	= btn.getAttribute('data-controller')
	let method 			= btn.getAttribute('data-method')

	if (tipo && id) {
		tipo = tipo.value.toLowerCase()
		location.href = `${urlRoot}/${controller}/${method}/${tipo}/${id}`
	} else {

		const warningModal = document.querySelector('#warning_modal')
		const modalWarning = new bootstrap.Modal(warningModal)
		modalWarning.show()
	}

})

