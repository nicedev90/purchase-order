window.addEventListener('DOMContentLoaded', () => {

	const mina = document.querySelector('#mina')
	mina.addEventListener('change', loadCateg)
})


const loadCateg = (e) => {
	const select = e.target
	const centro_costo = e.target.value
	let urlRoot 		= select.getAttribute('data-url')
	let controller	= select.getAttribute('data-controller')
	let method 			= select.getAttribute('data-method').toLowerCase()

	if (centro_costo) {
		location.href = `${urlRoot}/${controller}/${method}/${centro_costo}`
	} 
}


