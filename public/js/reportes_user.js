window.addEventListener('DOMContentLoaded', () => {
	const btnCompra = document.querySelector('#btn_compra')
	btnCompra?.addEventListener('click', getReporteCompra)

	const btnFondos = document.querySelector('#btn_fondos')
	btnFondos?.addEventListener('click', getReporteFondos)

	let filterInput = document.querySelector('#filterInput')
filterInput?.addEventListener('keyup', filterNames)

})



const filterNames = () => {
	let filterValue = document.querySelector('#filterInput').value.toUpperCase()

	let container = document.querySelector('#usuarios')
	let names = container.querySelectorAll('option.user-item')

	// console.log(names)

	for (let i = 0; i < names.length; i++) {
		let a = names[i]
		console.log(a)

		if (a.innerHTML.toUpperCase().indexOf(filterValue) > -1 ) {
			names[i].style.display = ''
			names[i].setAttribute('selected','')
		} else {
			names[i].style.display = 'none'
		}
	}
}


const getReporteCompra = (e) => {
	let btn = e.target
	let user = document.querySelector('#usuarios').value
	let mes = document.querySelector('#mes').value
	
	let urlRoot 		= btn.getAttribute('data-url')
	let controller	= btn.getAttribute('data-controller')
	let method 			= btn.getAttribute('data-method')
	let tipo 			= btn.getAttribute('data-tipo')

	console.log(btn)

	if (user && mes) {
		location.href = `${urlRoot}/${controller}/${method}/${user}/${mes}`
	} else {
		const warningModal = document.querySelector('#warning_modal')
		const modalWarning = new bootstrap.Modal(warningModal)
		modalWarning.show()
	}
}

const getReporteFondos = (e) => {
	let btn = e.target
	let user = document.querySelector('#usuarios').value
	let mes = document.querySelector('#mes').value
	
	let urlRoot 		= btn.getAttribute('data-url')
	let controller	= btn.getAttribute('data-controller')
	let method 			= btn.getAttribute('data-method')


	console.log(btn)
	
	if (user && mes) {
		location.href = `${urlRoot}/${controller}/${method}/${user}/${mes}`
	} else {
		const warningModal = document.querySelector('#warning_modal')
		const modalWarning = new bootstrap.Modal(warningModal)
		modalWarning.show()
	}
}

