$(function() {
	$("#btnWyslij").click(function() {
		const $frm = $("#formZapytanie")
		
		$.post($frm.attr('action'), $frm.serializeArray(), function(resp) {
			if(resp == 'ok') {
				alert("Dziękujemy za wysłanie zapytania.")
				$("textarea").val('')
				$('#modalZapytanie').modal('hide')
			} else {
				alert("Wystąpił błąd")
			}
		});
		
		return false
	})
})