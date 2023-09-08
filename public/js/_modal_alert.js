window.addEventListener('DOMContentLoaded', () => {
	check_modal_alert()
})

const check_modal_alert = () => {
	let success_modal = document.querySelector('#success_modal')
	let warning_modal = document.querySelector('#warning_modal')

	if (success_modal) {
		let modal = new bootstrap.Modal(success_modal)
		modal.show()
	} else if (warning_modal) {
		let modal = new bootstrap.Modal(warning_modal)
		modal.show()
	}
}
