window.addEventListener('DOMContentLoaded', () => {
	const btnSearch = document.querySelector('#btn-search')
	btnSearch?.addEventListener('click', getReporteCaja)

})


const getReporteCaja = (e) => {
	let btn = e.target
	let mina = document.querySelector('#mina').value
	let mes = document.querySelector('#mes').value
	
	let urlRoot 		= btn.getAttribute('data-url')
	let controller	= btn.getAttribute('data-controller')
	let method 			= btn.getAttribute('data-method')


	console.log(btn)

	if (mina && mes) {
		location.href = `${urlRoot}/${controller}/${method}/${mina}/${mes}`
	} else {
		const warningModal = document.querySelector('#warning_modal')
		const modalWarning = new bootstrap.Modal(warningModal)
		modalWarning.show()
	}
}


