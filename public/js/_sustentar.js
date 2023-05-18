window.addEventListener('DOMContentLoaded', () => {

	const btnReturn = document.querySelector('#btn-return')
	btnReturn?.addEventListener('click', (e) => {
		// console.log(e)
		window.history.back()
	})

	// manejar items del form
	const btnAddItem = document.querySelector('#add_item')
	btnAddItem?.addEventListener('click', addItem)

	const btnDeleteItem = document.querySelector('#delete_item')
	btnDeleteItem?.addEventListener('click', deleteItemRow)

	// manejar archivos adjuntos del form
	const formCrear = document.querySelector('#form_crear')
	formCrear?.addEventListener('submit', checkFiles)

	const addAdjunto = document.querySelector('#add_adjunto')
	addAdjunto?.addEventListener('click', addRowAdjunto)

	const deleteAdjunto = document.querySelector('#delete_adjunto')
	deleteAdjunto?.addEventListener('click', deleteRowAdjunto)

	// cargar primer adjunto
	const adjunto1 = document.querySelector('#adjunto1')
	adjunto1?.addEventListener('change', readFile)

})



const checkFiles = (e) => {
	const formul = e.target
	if (formul.classList.contains('was-validated') && formul.classList.contains('invalidado')) {
		const errorModal = document.querySelector('#error_modal')
		const modal = new bootstrap.Modal(errorModal)
		modal.show()

		e.preventDefault()
	} 

	if (formul.classList.contains('was-validated') && formul.classList.contains('valid-files')) {	
		// const warningModal = document.querySelector('#warning_modal')
		// const modalWarning = new bootstrap.Modal(warningModal)

		// modalWarning.show()

		e.target.submit()
	}
}



// funciones para archivos adjuntos de la orden de compra
const listaAdjunto = document.querySelector('#lista_adjunto')

const deleteRowAdjunto = () => {
	const fileSel = document.querySelectorAll('.fileSelected')
	fileSel.forEach(item => {
		const formCrear = document.querySelector('#form_crear')
		if (formCrear.classList.contains('invalidado')) {
			formCrear.classList.remove('invalidado')
			// console.log(formCrear)
		}

		item.remove()
	})
}

const addRowAdjunto = () => {

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
    <div id="numAdjunto" class="btn fw-bold"> ${contador} </div>
    <label for="adjunto${contador}" class="col-md-2"> 
      <span class="btn btn-primary">Cargar. <i class="bi bi-paperclip"></i> </span>
    </label>

    <input type='file' name="adjunto[${contador}]" id="adjunto${contador}" class="item_adjunto" hidden>
    <div id="file_name" class="btn col-12 text-sm col-md-4"></div>
    <div id="file_size" class="btn col-md-2"></div>
    <div id="validar_adjunto" class="btn col-md-3"></div>
	  `

	 fileRow.innerHTML = fileDetails
	 listaAdjunto.append(fileRow)
	// console.log(fileRow)

	const adjunto5 = document.querySelector('#adjunto_5')

	if (adjunto5) {
		const addAdjunto = document.querySelector('#add_adjunto')
		addAdjunto.removeEventListener('click', addRowAdjunto)

		const adjuntoModal = document.querySelector('#adjunto_modal')
		const modalAdj = new bootstrap.Modal(adjuntoModal)
		modalAdj.show()

		// e.preventDefault()
		// alert('No puede agregar más de 5 archivos adjuntos.')
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
	// leer archivo seleccionado en el input File
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

		f_validar.innerHTML = validateFile(archivo.size)
		// console.log(f_validar)
	}
}

const validateFile = (size) => {
	// comprobar archivo pesa menos de 3 MB
	if (size > 3000000) {
		const formCrear = document.querySelector('#form_crear')
		formCrear.classList.add('invalidado')
		// console.log(formCrear)
		return `<div class="btn btn-danger"><i class="bi bi-x"></i> Es mayor a 3 MB </div>`

	} else {
		const formCrear = document.querySelector('#form_crear')
		if (formCrear.classList.contains('invalidado')) {
			formCrear.classList.remove('invalidado')
			formCrear.classList.add('valid-files')
			// console.log(formCrear)
		}
		return `<div class="btn btn-success"><i class="bi bi-check-circle"></i> Correcto </div>`
	}
}

const fixedSize = (size) => {
	let unidad = ['B','KB','MB']
	let i = 0

	for (i; size > 1024; i++) {
		// size = size/1024
		size /= 1024
	}

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

const addItem = (e) => {
	
	const formAddItem = document.querySelector('#formAddItem')

	const thisBtn = e.target
	const usuario = thisBtn.getAttribute('data-usuario')
	const numero_os = thisBtn.getAttribute('data-numero')
	const lista_items = document.querySelector('#lista_items')

	// iniciar el conteo de elementos en 0 ( existente 01 elemento)
	let numItem = lista_items.childElementCount
	numItem == 0 ? numItem = 1 : numItem++

	console.log(numItem)
	console.log(numero_os)
	console.log(usuario)

	let fecha = document.querySelector('#input_fecha')
	let centro_costo = document.querySelector('#input_cc')
	let proveedor = document.querySelector('#input_proveedor')
	let descripcion = document.querySelector('#input_descripcion')
	let documento = document.querySelector('#input_documento')
	let total = document.querySelector('#input_total')
	const alertaMsg = document.querySelector('#alerta')

// let formatPounds = new Intl.NumberFormat(undefined, {
// 	style: 'currency',
// 	currency: 'PEN',
// 	currencySign: 'accounting'
// });

// // returns "£67,123.45"
// let pounds = formatPounds.format(total);
// console.log(pounds)

	const itemRow = document.createElement('tr')
	itemRow.classList.add('itemRow')
	// console.log(itemRow)

	// comprobar que este lleno descripcion y proveedor
	if (descripcion.value.length > 2 && proveedor.value.length > 2) {
			let content = `
	  	<td class="text-center btn btn-sm btn-ligth w-100">${numItem}</td>
	    <td class="d-none d-md-table-cell" > ${fecha.value}</td>
	    <td class="d-none d-md-table-cell">${centro_costo.value}</td>
	    <td class="d-none d-md-table-cell">${proveedor.value}</td>
	    <td class="d-none d-md-table-cell  " style="width: 420px;"> ${descripcion.value}</td>
	    <td >${documento.value}</td>
	    <td class="text-end">S/. ${total.value}</td>
		`

	  itemRow.innerHTML = content
	  lista_items.append(itemRow) 
	  console.log(itemRow)


		descripcion.classList.contains('is-invalid') ? descripcion.classList.remove('is-invalid') : null
		proveedor.classList.contains('is-invalid') ? proveedor.classList.remove('is-invalid') : null

		!alertaMsg.classList.contains('d-none') ? alertaMsg.classList.add('d-none') : null
	  formAddItem.reset()

	  setItemBtn()

	} else {
		!descripcion.classList.contains('is-invalid') ? descripcion.classList.add('is-invalid') : null
		!proveedor.classList.contains('is-invalid') ? proveedor.classList.add('is-invalid') : null

	  alertaMsg.classList.contains('d-none') ? alertaMsg.classList.remove('d-none') : null
	  formAddItem.reset()

	}

}

const setItemBtn = () => {
	const selectItem = document.querySelectorAll('.itemRow')
	selectItem.forEach(item => {
		item.addEventListener('click', selectItemRow)
	})
}

const selectItemRow = (e) => {
	const row = e.target.parentElement
	row.classList.toggle('selected-row')
	row.classList.toggle('itemSelected')
	// console.log(row)
}