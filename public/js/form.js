window.addEventListener('DOMContentLoaded', () => {
	const mina = document.querySelector('#mina')
	mina.addEventListener('change', getCategorias)

})


const getCategorias = (e) => {
	const target = e.target
	target.toggleAttribute('selected')
	const id = e.target.value
	// console.log(id)

	location.href = 'http://localhost/purchase-order/administrador/crear/'+id

}

