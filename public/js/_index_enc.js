window.addEventListener('DOMContentLoaded', () => {
	const btnInit = document.querySelector('#btn_init')
	btnInit?.addEventListener('click', create)

	// let allInputOs = document.querySelectorAll('.input_os')
	// allInputOs.foreach( input => {
	// 	let sede_user = document.querySelector('#sede_user')
		
	// 	fetch('https://jsonplaceholder.typicode.com/posts')
	// 	.then((res) => res.json())
	// 	.then((data) => {
	// 		let output = '<h2>Posts </h2>'
	// 		data.forEach(function (post) {
	// 			output += `
	// 				<div>
	// 					<h3>${post.title}</h3>
	// 					<p>Id ${post.body}</p>
	// 				</div>

	// 			`
	// 		})

	// 		document.querySelector('#output').innerHTML = output
	// 		// console.log(data)
	// 	})
	// })

	checkModal()
})

const checkModal = () => {
	const successModal = document.querySelector('#success_modal')
	// console.log(successModal)
	if (successModal) {
		const modalSuccess = new bootstrap.Modal(successModal)
		modalSuccess.show()
	}
}


const create = (e) => {
	let btn = e.target
	let tipo = document.querySelector('input[name="tipo"]:checked')
	let id = document.querySelector('#mina').value
	
	let urlRoot 		= btn.getAttribute('data-url')
	let controller	= btn.getAttribute('data-controller')
	let method 			= btn.getAttribute('data-method')

	if (tipo && id) {
		tipo = tipo.value.toLowerCase()
		location.href = `${urlRoot}/${controller}/${method}/${tipo}/${id}`
	} else {

		const warningModal = document.querySelector('#warning_modal')
		const modalWarning = new bootstrap.Modal(warningModal)
		modalWarning.show()
	}
}

