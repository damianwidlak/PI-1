$(function() {
	$(".aDodajDoKoszyka").click(function() {
		const $link = $(this);
		const url = $(this).attr('href');
		const dodano = '<i class="fas fa-check-circle text-success"></i>';
		const liczbaOfert = $('#liczba_ofert');

		$.post(url, function(resp) {
			if (resp == 'ok') {
				$link.replaceWith(dodano);
				let liczba = liczbaOfert.text();
				try{
					liczba = Number(liczba) +1
				} catch (e) {
					//licza = liczbaOfert.text();
				}
				liczbaOfert.text(liczba);
			} else {
				alert('Wystąpił błąd');
			}
		});
		
		return false;
	});
});


$(function(){
	$(".aUsunZKoszyka").click(function(){
		
		const $link = $(this);
		const url = $(this).attr('href');
		const usunieto = '<i class="fas fa-trash"></i>';
		const liczbaOfert = $('#liczba_ofert');
		
		$.post(url, function(resp) {
			if (resp == 'ok') {
				$link.replaceWith(usunieto);
				let liczba = liczbaOfert.text();
				try{
					if(liczba > 0)
					{
						liczba = Number(liczba) -1
					}
				} catch (e) {
					//licza = liczbaOfert.text();
				}
				liczbaOfert.text(liczba);
			} else {
				alert('Wystąpił błąd');
			}
		});
		
		return false;
	});
});