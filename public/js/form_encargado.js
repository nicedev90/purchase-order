window.addEventListener('DOMContentLoaded', () => {

	// funcion para cargar categorias en form
	const mina = document.querySelector('#mina')
	mina.addEventListener('change', getCategorias)

	// manejar items del form
	const btnAgregar = document.querySelector('#agregar')
	btnAgregar.addEventListener('click', addItem)

	const btnEliminar = document.querySelector('#btnEliminar')
	btnEliminar.addEventListener('click', eliminarRow)

	// manejar archivos adjuntos del form
	const formCrear = document.querySelector('#form_crear')
	formCrear.addEventListener('submit', checkFiles)

	const addAdjunto = document.querySelector('#add_adjunto')
	addAdjunto.addEventListener('click', addRowAdjunto)

	const deleteAdjunto = document.querySelector('#delete_adjunto')
	deleteAdjunto.addEventListener('click', deleteRowAdjunto)



	

})

const checkFiles = () => {

}

// funcion para traer categorias desde la base de datos
const getCategorias = (e) => {
	const target = e.target
	target.toggleAttribute('selected')
	const id = e.target.value
	// console.log(id)
	location.href = 'http://localhost/purchase-order/encargados/crear/'+id
}

// funciones para archivos adjuntos de la orden de compra
const listaAdjunto = document.querySelector('#lista_adjunto')

const deleteRowAdjunto = () => {
	const fileSel = document.querySelectorAll('.fileSelected')
	fileSel.forEach(item => item.remove())
}

const addRowAdjunto = () => {
	// mostrar boton de eliminar archivos
	const btnDelAdjunto = document.querySelector('#delete_adjunto')
	btnDelAdjunto.removeAttribute('hidden')


	const firstFile = document.querySelector('#adjunto_1')
	firstFile.removeAttribute('hidden')


	let numFile, contador =2
	let lastNum = listaAdjunto.lastChild.id

	if (lastNum) {
		numFile = lastNum.slice(8)
	} 
	
	if (numFile >= 1) {
		contador = +numFile+1
		// console.log(contador)
	}
	
	const fileRow = document.createElement('div')
	fileRow.classList.add('col','my-1')
	fileRow.setAttribute('id', `adjunto_${contador}`)


	const fileDetails = `
		<div id="numAdjunto" class="btn fw-bold col-md-1">
			${contador}
		</div>
        <label for="adjunto${contador}" class="col-md-1"> 
            <span class="btn btn-primary">Cargar. <i class="bi bi-paperclip"></i>
            </span>
        </label>

        <input type='file' name="adjunto[${contador}]" id="adjunto${contador}" class="item_adjunto" hidden>
        
        <div id="file_name" class="btn col-md-5">

        </div>

        <div id="file_size" class="btn col-md-2">

        </div>
        
        <div class="btn col-md-1 btn-success">
        	<i class="bi bi-check-circle"></i>
        </div>
	  `

	 fileRow.innerHTML = fileDetails
	 listaAdjunto.append(fileRow)
	
	// console.log(fileRow)
	
	initFiles()
	setFileBtn()

}

const initFiles = () => {
	const adjuntos = document.querySelectorAll('.item_adjunto')
	adjuntos.forEach(file => {
		file.addEventListener('change', readFile)
	})
}

const readFile = (e) => {
	const archivo = e.target.files[0]

	const f_name = e.target.nextElementSibling
	const f_size = f_name.nextElementSibling

	let size = fixedSize(archivo.size)

	f_name.innerText = archivo.name
	f_size.innerText = size
	// console.log(f_size)
}

const fixedSize = (size) => {

	let unidad = ['B','KB','MB']
	let i = 0

	for (i; size > 1024; i++) {
		size /= 1024
	}
	// if (size > 1024) {
	// 	let fixedSize = size /= 1024

	return size.toFixed(1) + ' ' + unidad[i]
	
}

const setFileBtn = () => {
	const fileBtn = document.querySelectorAll('#numAdjunto')
	fileBtn.forEach(btn => {
		btn.addEventListener('click', selectFile)
	})
}

const selectFile = (e) => {
	const row = e.target.parentElement
	row.classList.toggle('selected-file')
	row.classList.toggle('fileSelected')
	// console.log(par)
}


// funciones para items de orden de compra
const lista = document.querySelector('#lista')

const eliminarRow = () => {
	const rowSel = document.querySelectorAll('.itemSelected')
	rowSel.forEach(item => item.remove())
}

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
				<input type="hidden" name="item[${contar}][estado]" value="En Proceso">

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