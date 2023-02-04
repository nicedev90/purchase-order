window.addEventListener('DOMContentLoaded', () => {
	const mina = document.querySelector('#mina')
	mina.addEventListener('change', getCategorias)
})


const getCategorias = (e) => {
	const target = e.target
	target.toggleAttribute('selected')
	const id = e.target.value

	// console.log(id)

	window.location.replace('http://localhost/purchase-order/administrador/crear/'+id)
	console.log(target)
}