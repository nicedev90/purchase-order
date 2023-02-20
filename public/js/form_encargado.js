window.addEventListener('DOMContentLoaded', () => {

	// funcion para cargar categorias en form
	const mina = document.querySelector('#mina')
	mina.addEventListener('change', getCategorias)

	// manejar items del form
	const btnAgregar = document.querySelector('#btnAgregar')
	btnAgregar.addEventListener('click', addItem)

	const btnEliminar = document.querySelector('#btnEliminar')
	btnEliminar.addEventListener('click', deleteItemRow)

	// manejar archivos adjuntos del form
	const formCrear = document.querySelector('#form_crear')
	formCrear.addEventListener('submit', checkFiles)

	const addAdjunto = document.querySelector('#add_adjunto')
	addAdjunto.addEventListener('click', addRowAdjunto)

	const deleteAdjunto = document.querySelector('#delete_adjunto')
	deleteAdjunto.addEventListener('click', deleteRowAdjunto)

	// cargar primer adjunto
	const adjunto1 = document.querySelector('#adjunto1')
	adjunto1.addEventListener('change', readFile)


})

const checkFiles = (e) => {
	const formul = e.target
	if (formul.classList.contains('invalidado')) {
		alert('error en tamaño de archivo')
		e.preventDefault()

	}

	
}

// funcion para traer categorias desde la base de datos
const getCategorias = (e) => {
	const target = e.target
	target.toggleAttribute('selected')
	const id = e.target.value
	// console.log(id)
	
	// location.href = 'https://clonsaingenieria.cl/purchase-order/encargados/crear/'+id
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
	// const btnDelAdjunto = document.querySelector('#delete_adjunto')
	// btnDelAdjunto.removeAttribute('hidden')


	// const firstFile = document.querySelector('#adjunto_1')
	// firstFile.removeAttribute('hidden')


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

        <div id="file_size" class="btn col-md-1">

        </div>
        
        <div id="validar_adjunto" class="btn col-md-2">

        </div>
	  `

	 fileRow.innerHTML = fileDetails
	 listaAdjunto.append(fileRow)
	
	// console.log(fileRow)
	

	const adjunto5 = document.querySelector('#adjunto_5')
	if (adjunto5) {
		const addAdjunto = document.querySelector('#add_adjunto')
		addAdjunto.removeEventListener('click', addRowAdjunto)
		alert('No puede agregar mas de 5 archivos')
	} 


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
	const f_validar = f_size.nextElementSibling

	if (archivo) {
		let size = fixedSize(archivo.size)

		f_name.classList.add('bg-light')
		f_size.classList.add('bg-light')
		f_name.innerText = archivo.name
		f_size.innerText = size

		// let sizeFile = size.split(' ')
		// sizeFile = sizeFile[0]

		f_validar.innerHTML = validateFile(archivo.size)
		// console.log(sizeFile)
	}
}

const validateFile = (size) => {
	if (size > 3000000) {
		const formCrear = document.querySelector('#form_crear')
	formCrear.classList.add('invalidado')
	console.log(formCrear)

		return `<div class="btn btn-danger">
					<i class="bi lead bi-check-circle"></i>
					Es mayor a 5 MB 
				</div>`

	} else {
		const formCrear = document.querySelector('#form_crear')
	formCrear.classList.remove('invalidado')
	console.log(formCrear)

		return `<div class="btn btn-success">
					<i class="bi lead bi-check-circle"></i>
					Correcto 
				</div>`
	}

	
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

const deleteItemRow = () => {
	const rowSelected = document.querySelectorAll('.itemSelected')
	rowSelected.forEach(item => item.remove())
}

const addItem = () => {
	
	let num_item = 2
	let first_item = lista.lastChild.id
	if (first_item >=1) {
		num_item = +first_item+1
		// console.log(numer)
	}

	const orden = document.querySelector('#num_os')
	const n_orden = orden.value

	const usuario = document.querySelector('#usuario')
	const user = usuario.value

	const status = document.querySelector('#estado')
	const estado = status.value

	const mina = document.querySelector('#mina')
	const n_mina = mina.value

	const categoria = document.querySelector('#categoria')
	const n_cat = categoria.value


	const itemRow = document.createElement('div')
	itemRow.setAttribute('id', num_item)
	itemRow.classList.add('row','mb-3')

	const content = `
				<input type="hidden" name="item[${num_item}][usuario]" value="${user}">
				<input type="hidden" name="item[${num_item}][num_os]" value="${n_orden}">
				<input type="hidden" name="item[${num_item}][estado]" value="${estado}">

				<input type="hidden" name="item[${num_item}][mina]" value="${n_mina}">
				<input type="hidden" name="item[${num_item}][categoria]" value="${n_cat}">

        <div class="col-md-1 position-relative">
            <input type="text" name="item[${num_item}][item]" class="form-control-plaintext text-center" id="numItem" value="${num_item}" required readonly>
            <div class="valid-tooltip">
                Correcto
            </div>
        </div>

        <div class="col-md-1 position-relative">
            <input name="item[${num_item}][cantidad]" type="number" class="form-control" id="cantidad1" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Introduce un número" required autocomplete="off">
            <div class="valid-tooltip">
                Correcto
            </div>
        </div>
                        
        <div class="col-md-2 position-relative">
            <select name="item[${num_item}][unidad]" class="form-select" id="validationTooltip04" required>
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
            <input name="item[${num_item}][descripcion]" type="text" class="form-control" id="" value="" data-bs-toggle="tooltip" data-bs-placement="top" title="Llena este campo descripción" required autocomplete="off">
            <div class="valid-tooltip">
            Correcto
            </div>
        </div>

        <div class="col-md-2 position-relative">
            <input name="item[${num_item}][proveedor]" type="text" class="form-control" id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo proveedor" required autocomplete="off">
            <div class="valid-tooltip">
                Correcto
            </div>
        </div>
    `
 
    itemRow.innerHTML = content
    lista.append(itemRow) 
    // console.log(itemRow)
    setItemBtn()
}

const setItemBtn = () => {
	const selectItem = document.querySelectorAll('#numItem')
	selectItem.forEach(item => {
		item.addEventListener('click', selectItemRow)
	})
}

const selectItemRow = (e) => {
	const row = e.target.parentElement.parentElement
	row.classList.toggle('selected-row')
	row.classList.toggle('itemSelected')
	// console.log(row)
}