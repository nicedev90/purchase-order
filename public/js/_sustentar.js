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

const addItem = () => {
	
	let num_item = 2
	let first_item = lista.lastChild.id
	if (first_item >=1) {
		num_item = +first_item+1
		console.log(num_item)
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

	const tipo = document.querySelector('#tipo').value
	console.log(tipo)

	const itemRow = document.createElement('div')
	itemRow.setAttribute('id', num_item)
	itemRow.classList.add('row','mb-3')

	// el array unidades  viene de la pagina crear.php
	let lista_unidades = ''
  for(let i=0; i < unidades.length; i++){	
		lista_unidades += `<option value="${unidades[i]['unidad']}">${unidades[i]['unidad']} </option>`
    // console.log(lista_unidades)
	}



	let content

	if (tipo == 'compra') {
		content = `
			<input type="hidden" name="item[${num_item}][usuario]" value="${user}">
			<input type="hidden" name="item[${num_item}][num_os]" value="${n_orden}">
			<input type="hidden" name="item[${num_item}][estado]" value="${estado}">
			<input type="hidden" name="item[${num_item}][tipo]" value="${tipo}">

			<input type="hidden" name="item[${num_item}][mina]" value="${n_mina}">
			<input type="hidden" name="item[${num_item}][categoria]" value="${n_cat}">

      <div class="col-4 d-flex-col col-md-1 position-relative">
        <label for="" class="d-md-none">Item</label>
        <input type="text" name="item[${num_item}][item]" class="form-control-plaintext form-control-sm text-center" id="numItem" value="${num_item}" required readonly>
      </div>

      <div class="col-4 d-flex-col  col-md-1 position-relative">
        <label for="" class="d-md-none">Cantidad</label>
        <input name="item[${num_item}][cantidad]"  type="number" step="any" min="0"  class="form-control form-control-sm" id="cantidad" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Introduce un número" required autocomplete="off">
        <div class="valid-tooltip">Correcto</div>
      </div>
                        
      <div class="col-4 d-flex-col flex-col  col-md-1 position-relative">
        <label for="" class="d-md-none">Unidad</label>
        <select name="item[${num_item}][unidad]" class="unidades form-select form-select-sm" id="validationTooltip04" required>
          <option selected disabled value="">Selecciona...</option>
          	${lista_unidades}
          </select>
        </select>
        <div class="invalid-tooltip"> Por favor selecciona una unidad. </div>
      </div>

      <div class="col-md-5 mt-2 mt-md-0 position-relative">
        <label for="" class="d-md-none">Descripcion</label>
        <input name="item[${num_item}][descripcion]" type="text" class="form-control form-control-sm" id="" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo descripción" required autocomplete="off">
        <div class="valid-tooltip"> Correcto </div>
      </div>

      <div class="col-md-2 mt-2 mt-md-0 position-relative">
        <label for="" class="d-md-none">Proveedor</label>
        <input name="item[${num_item}][proveedor]" type="text" class="form-control form-control-sm " id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo proveedor" required autocomplete="off">
        <div class="valid-tooltip">  Correcto </div>
      </div>

      <div class="col-md-2 mt-2 mt-md-0 position-relative">
        <label for="" class="d-md-none">Valor Referencial</label>
        <input name="item[${num_item}][valor]" type="number" step="any" min="0"  class="form-control form-control-sm " id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo valor" required autocomplete="off">
        <div class="valid-tooltip">  Correcto </div>
      </div>
    `
	} else {
		content = `
			<input type="hidden" name="item[${num_item}][usuario]" value="${user}">
			<input type="hidden" name="item[${num_item}][num_os]" value="${n_orden}">
			<input type="hidden" name="item[${num_item}][estado]" value="${estado}">
			<input type="hidden" name="item[${num_item}][tipo]" value="${tipo}">

			<input type="hidden" name="item[${num_item}][mina]" value="${n_mina}">
			<input type="hidden" name="item[${num_item}][categoria]" value="${n_cat}">

      <div class="col-4 d-flex-col col-md-1 position-relative">
        <label for="" class="d-md-none">Item</label>
        <input type="text" name="item[${num_item}][item]" class="form-control-plaintext form-control-sm text-center" id="numItem" value="${num_item}" required readonly>
      </div>

      <div hidden class="col-4 d-flex-col  col-md-1 position-relative">
        <label for="" class="d-md-none">Cantidad</label>
        <input name="item[${num_item}][cantidad]"  type="number" step="any" min="0"  class="form-control form-control-sm" id="cantidad" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Introduce un número" autocomplete="off">
        <div class="valid-tooltip">Correcto</div>
      </div>
                        
      <div hidden class="col-4 d-flex-col flex-col  col-md-1 position-relative">
        <label for="" class="d-md-none">Unidad</label>
        <select name="item[${num_item}][unidad]" class="form-select form-select-sm" id="validationTooltip04">
          <option selected value="">Selecciona...</option>
          <option>Metro</option>
          <option>Kilo</option>
          <option>Litro</option>
        </select>
        <div class="invalid-tooltip"> Por favor selecciona una unidad. </div>
      </div>

      <div class="col-md-8 mt-2 mt-md-0 position-relative">
        <label for="" class="d-md-none">Descripcion</label>
        <input name="item[${num_item}][descripcion]" type="text" class="form-control form-control-sm" id="" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo descripción" required autocomplete="off">
        <div class="valid-tooltip"> Correcto </div>
      </div>

      <div hidden class="col-md-2 mt-2 mt-md-0 position-relative">
        <label for="" class="d-md-none">Proveedor</label>
        <input name="item[${num_item}][proveedor]" type="text" class="form-control form-control-sm " id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo proveedor" autocomplete="off">
        <div class="valid-tooltip">  Correcto </div>
      </div>

      <div class="col-md-3 mt-2 mt-md-0 position-relative">
        <label for="" class="d-md-none">Valor Referencial</label>
        <input name="item[${num_item}][valor]" type="number" step="any" min="0"  class="form-control form-control-sm " id="validationTooltip02" value="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Llena este campo valor" required autocomplete="off">
        <div class="valid-tooltip">  Correcto </div>
      </div>
    `
	}
 
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