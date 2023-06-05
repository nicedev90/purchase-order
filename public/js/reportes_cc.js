window.addEventListener('DOMContentLoaded', () => {
	const btnCompra = document.querySelector('#btn_compra')
	btnCompra?.addEventListener('click', getReporteCompra)

	const btnFondos = document.querySelector('#btn_fondos')
	btnFondos?.addEventListener('click', getReporteFondos)
	
echarts.init(document.querySelector("#pieChart")).setOption({
                  title: {
                    text: 'Cuentas',
                    subtext: 'Personal Clonsa Ingeniería',
                    left: 'center'
                  },
                  tooltip: {
                    trigger: 'item'
                  },
                  legend: {
                    orient: 'vertical',
                    left: 'left'
                  },
                  series: [{
                    name: 'Cuenta',
                    type: 'pie',
                    radius: '70%',
                    data: [{
                        value: 1000,
                        name: 'Usuario'
                      },
                      {
                        value: 1000,
                        name: 'Encargado'
                      },
                      {
                        value: 600,
                        name: 'Coordinador'
                      },
                      {
                        value: 880,
                        name: 'Administrador'
                      },
                    ],
                    emphasis: {
                      itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                      }
                    }
                  }]
                });
})


const getReporteCompra = (e) => {
	let btn = e.target
	let mina = document.querySelector('#mina').value
	let mes = document.querySelector('#mes').value
	
	let urlRoot 		= btn.getAttribute('data-url')
	let controller	= btn.getAttribute('data-controller')
	let method 			= btn.getAttribute('data-method')
	let tipo 			= btn.getAttribute('data-tipo')

	console.log(btn)

	if (mina && mes) {
		location.href = `${urlRoot}/${controller}/${method}/${tipo}/${mina}/${mes}`
	} else {
		const warningModal = document.querySelector('#warning_modal')
		const modalWarning = new bootstrap.Modal(warningModal)
		modalWarning.show()
	}
}

const getReporteFondos = (e) => {
	let btn = e.target
	let mina = document.querySelector('#mina').value
	let mes = document.querySelector('#mes').value
	
	let urlRoot 		= btn.getAttribute('data-url')
	let controller	= btn.getAttribute('data-controller')
	let method 			= btn.getAttribute('data-method')
	let tipo 			= btn.getAttribute('data-tipo')


	console.log(btn)
	
	if (mina && mes) {
		location.href = `${urlRoot}/${controller}/${method}/${tipo}/${mina}/${mes}`
	} else {
		const warningModal = document.querySelector('#warning_modal')
		const modalWarning = new bootstrap.Modal(warningModal)
		modalWarning.show()
	}
}

