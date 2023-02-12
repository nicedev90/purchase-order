window.addEventListener('DOMContentLoaded', () => {
	const mina = document.querySelector('#mina')
	mina.addEventListener('change', getCategorias)

	const btnAgregar = document.querySelector('#agregar')
	btnAgregar.addEventListener('click', addItem)

	const btnEliminar = document.querySelector('#btnEliminar')
	btnEliminar.addEventListener('click', eliminarRow)
})

const eliminarRow = () => {
	const rowSel = document.querySelectorAll('.itemSelected')
	rowSel.forEach(item => item.remove())
}

const getCategorias = (e) => {
	const target = e.target
	target.toggleAttribute('selected')
	const id = e.target.value
	// console.log(id)

	location.href = 'http://localhost/purchase-order/usuarios/crear/'+id

}

const lista = document.querySelector('#lista')

const addItem = () => {
	
	let contar = 2
	let numer = lista.lastChild.id
	if (numer >=1) {
		contar = +numer+1
		// console.log(numer)
	}

	const mina = document.querySelector('#mina')
	const n_mina = mina.value

	const categoria = document.querySelector('#categoria')
	const n_cat = categoria.value

	const usuario = document.querySelector('#usuario')
	const user = usuario.value

	const orden = document.querySelector('#numero_orden')
	const n_orden = orden.innerText

	const nuevoDiv = document.createElement('div')
	nuevoDiv.setAttribute('id', contar)
	nuevoDiv.classList.add('row','mb-3')

	const content = `
				<input type="hidden" name="item[${contar}][usuario]" value="${user}">
				<input type="hidden" name="item[${contar}][num_os]" value="${n_orden}">

				<input type="hidden" name="item[${contar}][mina]" value="${n_mina}">
				<input type="hidden" name="item[${contar}][categoria]" value="${n_cat}">

        <div class="col-md-1 position-relative">
            <input type="text" name="item[${contar}][item]" class="form-control-plaintext text-center" id="numItem" value="${contar}" required readonly>
            <div class="valid-tooltip">
                Correcto
            </div>
        </div>

        <div class="col-md-1 position-relative">
            <input name="item[${contar}][cantidad]" type="number" class="form-control" id="cantidad1" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Introduce un número" required autocomplete="off">
            <div class="valid-tooltip">
                Correcto
            </div>
        </div>
                        
        <div class="col-md-2 position-relative">
            <select name="item[${contar}][unidad]" class="form-select" id="validationTooltip04" required>
                <option selected disabled value="">Selecciona...</option>
                <option>Metro</option>
                <option>Kilo</option>
                <option>Litro</option>
            </select>
            <div class="invalid-tooltip">
            Por favor selecciona una unidad.
            </div>
        </div>

        <div class="col-md-6 position-relative">
            <input name="item[${contar}][descripcion]" type="text" class="form-control" id="" value="" data-bs-toggle="tooltip" data-bs-placement="top" title="Llena este campo descripción" required autocomplete="off">
            <div class="valid-tooltip">
            Correcto
            </div>
        </div>

        <div class="col-md-2 position-relative">
            <input name="item[${contar}][proveedor]" type="text" class="form-control" id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo proveedor" required autocomplete="off">
            <div class="valid-tooltip">
                Correcto
            </div>
        </div>
    `
 
    nuevoDiv.innerHTML = content
    lista.append(nuevoDiv) 
    // console.log(nuevoDiv)
    setBtn()
}

const setBtn = () => {
	const selectItem = document.querySelectorAll('#numItem')
	selectItem.forEach(item => {
		item.addEventListener('click', selRow)
	})
}

const selRow = (e) => {
	const par = e.target.parentElement.parentElement
	par.classList.toggle('selected-row')
	par.classList.toggle('itemSelected')
	// console.log(par)
}