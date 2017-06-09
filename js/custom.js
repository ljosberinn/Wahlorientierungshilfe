function start(str) {	

	$.ajax({
		url: 'modules/topic_selector.php',
		type: 'post',
		dataType: 'html',
		data: {
			reihenfolge: str
		},
		success: function (data) {
			$('.middle').fadeOut('slow', function () {
				$('.middle').empty();
				$('.middle').css('display', 'none');
				$('.middle').append(data);
				$('.middle').fadeIn('slow');
			});


		},
		error: function () {
			$('.middle').empty();
			$('.middle').css('display', 'none');
			$('.middle').append('<div class="middle-top">Der Server ist gerade unter hoher Last und kann Ihre Anfrage leider nicht durchführen. Bitte versuchen Sie es erneut.<br /><a href="https://wahl2017.gerritalex.de">Bitte klicken</a></span></div>');
			$('.middle').fadeIn('fast');
		}
	});

}

function imprint() {

	$.ajax({
		url: 'modules/impressum.html',
		type: 'get',
		dataType: 'html',
		success: function (data) {
			$('.middle-left').empty();
			$('.middle-right').remove();
			$('.middle-left').css({
				display: 'none',
				width: '100%'
			});
			$('.middle-left').append(data);
			$('.middle-left').fadeIn('fast');

			window.history.pushState('Wahlorientierungshilfe - Impressum', 'Wahlorientierungshilfe - Impressum', '');

			document.title = 'Wahlorientierungshilfe - Impressum';
		},
		error: function () {
			$('.middle-left').empty();
			$('.middle-left').css('display', 'none');
			$('.middle').append('<div class="middle-top">Der Server ist gerade unter hoher Last und kann Ihre Anfrage leider nicht durchführen. Bitte versuchen Sie es erneut.<br /><a href="https://wahl2017.gerritalex.de">Bitte klicken</a></span></div>');
			$('.middle-left').fadeIn('fast');
		}
	});

}

function landingpage() {

	$.ajax({
		url: 'modules/landing_page.php',
		type: 'get',
		dataType: 'html',
		success: function (data) {
			$('.middle').empty();
			$('.middle').css('display', 'none');
			$('.middle').append(data);
			$('.middle').fadeIn('fast');

		},
		error: function () {
			$('.middle').empty();
			$('.middle').css('display', 'none');
			$('.middle').append('<div class="middle-top">Der Server ist gerade unter hoher Last und kann Ihre Anfrage leider nicht durchführen. Bitte versuchen Sie es erneut.<br /><a href="https://wahl2017.gerritalex.de">Bitte klicken</a></span></div>');
			$('.middle').fadeIn('fast');
		}
	});

}

function next_topic(str) {

	$('.continue').find('button').attr('disabled', 'true');
	$('.continue').find('button').css('pointer-events', 'none');

	// Prüfung ob ein Zitat gewählt wurde
	if (!$('#1').is(':checked') && !$('#2').is(':checked') && !$('#3').is(':checked') && !$('#4').is(':checked') && !$('#5').is(':checked') && !$('#6').is(':checked')) {
		alert('Bitte wählen Sie ein Zitat aus.\nFür den Fall, dass Ihnen dieses Thema nicht wichtig ist oder Sie zu diesem Thema keine Meinung haben, können Sie am Schluss dieses Thema (und ein weiteres, maximal 2) als unwichtig markieren und nicht einfließen lassen.');

		$('.continue').find('button').removeAttr('disabled');
		$('.continue').find('button').css('pointer-events', 'all');
	} else {

		// Prüfung, welches Zitat gewählt wurde
		for (i = 1; i <= 6; i++) {

			if ($('#' + i + '').is(':checked')) {
				// Abholen der Werte des ausgewählten Zitats
				var zitat = new Array();
				$('input:checkbox:checked').each(function () {
					zitat.push($(this).val());
				});

				// Themenname zur Zuordnung
				var topic_name = $('.topic_name').text();

				$.ajax({
					url: 'modules/topic_selector.php',
					type: 'post',
					dataType: 'html',
					data: {
						reihenfolge: str,
						zitat: zitat[0],
						thema: topic_name
					},
					success: function (data) {
						$('.middle').fadeOut('slow', function () {
							$('.middle').empty();
							$('.middle').css('display', 'none');
							$('.middle').append(data);
							$('.middle').fadeIn('slow');
						});
					},
					error: function () {
						$('.middle').empty();
						$('.middle').css('display', 'none');
						$('.middle').append('<div class="middle-top">Der Server ist gerade unter hoher Last und kann Ihre Anfrage leider nicht durchführen. Bitte versuchen Sie es erneut.<br /><a href="https://wahl2017.gerritalex.de">Bitte klicken</a></span></div>');
						$('.middle').fadeIn('fast');
					}
				});
			}
		}
	}
}

function abwerten(str) {	

	var thema = str;

	$('#' + thema + '').css('pointer-events', 'none');

	$.ajax({
		url: 'modules/weighting.php',
		type: 'post',
		dataType: 'html',
		data: {
			thema: thema,
			abwerten: 'true'
		},
		success: function (data) {
			$('#' + thema + '').find('td:nth-child(2)').css('font-weight', '500');
			$('#' + thema + '').find('td:nth-child(2)').css('color', 'black');
			$('#' + thema + '').find('td:nth-child(2)').css('opacity', '0.25');
			$('#' + thema + '').css('pointer-events', 'all');
			$('#' + thema + '').find('td:nth-child(4)').empty();
			$('#' + thema + '').find('td:nth-child(5)').empty();
			$('#' + thema + '').find('td:nth-child(4)').append('<img src="img/x1.png" style="height: 50px; pointer-events: all; cursor: pointer;" alt="x1" title="Mit anderen Themen gleichstellen" id="' + thema + '" onclick="gleichstellen(this.id);" />');
			$('#' + thema + '').find('td:nth-child(5)').append('<img src="img/x2.png" style="height: 50px; pointer-events: all; cursor: pointer;" alt="x1" title="Dieses Thema doppelt werten" id="' + thema + '" onclick="aufwerten(this.id);" />');
			$('.middle').append(data);

		},
		error: function () {
			$('.middle').empty();
			$('.middle').css('display', 'none');
			$('.middle').append('<div class="middle-top">Der Server ist gerade unter hoher Last und kann Ihre Anfrage leider nicht durchführen. Bitte versuchen Sie es erneut.<br /><a href="https://wahl2017.gerritalex.de">Bitte klicken</a></span></div>');
			$('.middle').fadeIn('fast');
		}
	});
}

function aufwerten(str) {

	var thema = str;

	$('#' + thema + '').css('pointer-events', 'none');

	$.ajax({
		url: 'modules/weighting.php',
		type: 'post',
		dataType: 'html',
		data: {
			thema: thema,
			aufwerten: 'true'
		},
		success: function (data) {
			$('#' + thema + '').find('td:nth-child(2)').css('font-weight', '700');
			$('#' + thema + '').find('td:nth-child(2)').css('color', 'rgb(79, 176, 198)');
			$('#' + thema + '').find('td:nth-child(2)').css('opacity', '1');
			$('#' + thema + '').css('pointer-events', 'all');
			$('#' + thema + '').find('td:nth-child(5)').empty();
			$('#' + thema + '').find('td:nth-child(4)').empty();
			$('#' + thema + '').find('td:nth-child(4)').append('<img src="img/x0.png" style="height: 50px; opacity: 1; pointer-events: all; cursor: pointer;" alt="x1" title="Dieses Thema nicht werten" id="' + thema + '" onclick="abwerten(this.id);" />');
			$('#' + thema + '').find('td:nth-child(5)').append('<img src="img/x1.png" style="height: 50px; opacity: 1; pointer-events: all; cursor: pointer;" alt="x1" title="Mit anderen Themen gleichstellen" id="' + thema + '" onclick="gleichstellen(this.id);" />');
			$('.middle').append(data);

		},
		error: function () {
			$('.middle').empty();
			$('.middle').css('display', 'none');
			$('.middle').append('<div class="middle-top">Der Server ist gerade unter hoher Last und kann Ihre Anfrage leider nicht durchführen. Bitte versuchen Sie es erneut.<br /><a href="https://wahl2017.gerritalex.de">Bitte klicken</a></span></div>');
			$('.middle').fadeIn('fast');
		}
	});
}

function gleichstellen(str) {

	var thema = str;

	$('#' + thema + '').css('pointer-events', 'none');

	$.ajax({
		url: 'modules/weighting.php',
		type: 'post',
		dataType: 'html',
		data: {
			thema: thema,
			gleichstellen: 'true'
		},
		success: function (data) {
			$('#' + thema + '').find('td:nth-child(2)').css('font-weight', '500');
			$('#' + thema + '').find('td:nth-child(2)').css('color', 'black');
			$('#' + thema + '').find('td:nth-child(2)').css('opacity', '1');
			$('#' + thema + '').css('pointer-events', 'all');
			$('#' + thema + '').find('td:nth-child(5)').empty();
			$('#' + thema + '').find('td:nth-child(4)').empty();
			$('#' + thema + '').find('td:nth-child(4)').append('<img src="img/x0.png" style="height: 50px; opacity: 1; pointer-events: all; cursor: pointer;" alt="x1" title="Dieses Thema nicht werten" id="' + thema + '" onclick="abwerten(this.id);" />');
			$('#' + thema + '').find('td:nth-child(5)').append('<img src="img/x2.png" style="height: 50px; opacity: 1; pointer-events: all; cursor: pointer;" alt="x1" title="Dieses Thema doppelt werten" id="' + thema + '" onclick="aufwerten(this.id);" />');
			$('.middle').append(data);

		},
		error: function () {
			$('.middle').empty();
			$('.middle').css('display', 'none');
			$('.middle').append('<div class="middle-top">Der Server ist gerade unter hoher Last und kann Ihre Anfrage leider nicht durchführen. Bitte versuchen Sie es erneut.<br /><a href="https://wahl2017.gerritalex.de">Bitte klicken</a></span></div>');
			$('.middle').fadeIn('fast');
		}
	});
}

function edit(str) {

	var str = str.split('-');

	var reihenfolge = str[0];
	var thema = str[1];

	$.ajax({
		url: 'modules/edit.php',
		type: 'post',
		dataType: 'html',
		data: {
			reihenfolge: reihenfolge,
			thema: thema
		},
		success: function (data) {
			$('.middle').fadeOut('slow', function () {
				$('.middle').empty();
				$('.middle').css('display', 'none');
				$('.middle').append(data);
				$('.middle').fadeIn('slow');
			});

		},
		error: function () {
			$('.middle').empty();
			$('.middle').css('display', 'none');
			$('.middle').append('<div class="middle-top">Der Server ist gerade unter hoher Last und kann Ihre Anfrage leider nicht durchführen. Bitte versuchen Sie es erneut.<br /><a href="https://wahl2017.gerritalex.de">Bitte klicken</a></span></div>');
			$('.middle').fadeIn('fast');
		}
	});

}

function sichern(str) {

	if (!$('#1').is(':checked') && !$('#2').is(':checked') && !$('#3').is(':checked') && !$('#4').is(':checked') && !$('#5').is(':checked') && !$('#6').is(':checked')) {
		alert('Bitte wählen Sie ein Zitat aus.\nFür den Fall, dass Ihnen dieses Thema nicht wichtig ist oder Sie zu diesem Thema keine Meinung haben, können Sie am Schluss dieses Thema (und ein weiteres, maximal 2) als unwichtig markieren und nicht einfließen lassen.');

		$('.continue').find('button').removeAttr('disabled');
		
	} else {
		
		$('.continue').find('button').css('pointer-events', 'none');

		for (i = 1; i <= 6; i++) {

			if ($('#' + i + '').is(':checked')) {
				// Abholen der Werte des ausgewählten Zitats
				var zitat = new Array();
				$('input:checkbox:checked').each(function () {
					zitat.push($(this).val());
				});

				$.ajax({
					url: 'modules/save.php',
					type: 'post',
					dataType: 'html',
					data: {
						thema: str,
						zitat: zitat[0]
					},
					success: function (data) {
						$('.middle').fadeOut('slow', function () {
							$('.middle').empty();
							$('.middle').css('display', 'none');
							$('.middle').append(data);
							$('.middle').fadeIn('slow');
						});
					},
					error: function () {
						$('.middle').empty();
						$('.middle').css('display', 'none');
						$('.middle').append('<div class="middle-top">Der Server ist gerade unter hoher Last und kann Ihre Anfrage leider nicht durchführen. Bitte versuchen Sie es erneut.<br /><a href="https://wahl2017.gerritalex.de">Bitte klicken</a></span></div>');
						$('.middle').fadeIn('fast');
					}
				});
			}
		}
	}
}

function auswerten(str) {

	$('.continue').find('button').attr('disabled', 'true');
	$('.continue').find('button').css('pointer-events', 'none');

	$.ajax({
		url: 'modules/eval.php',
		type: 'post',
		dataType: 'html',
		data: {
			reihenfolge: str
		},
		success: function (data) {
			$('.middle').fadeOut('slow', function () {
				$('.middle').empty();
				$('.middle').css('display', 'none');
				$('.middle').append(data);
				$('.middle').fadeIn('slow');
			});

		},
		error: function () {
			$('.middle').empty();
			$('.middle').css('display', 'none');
			$('.middle').append('<div class="middle-top">Der Server ist gerade unter hoher Last und kann Ihre Anfrage leider nicht durchführen. Bitte versuchen Sie es erneut.<br /><a href="https://wahl2017.gerritalex.de">Bitte klicken</a></span></div>');
			$('.middle').fadeIn('fast');
		}
	});
}

function restart() {

	$('.restart').find('button').attr('disabled', 'true');
	$('.restart').find('button').css('pointer-events', 'none');

	$.ajax({
		url: 'modules/session_remover.php',
		type: 'get',
		dataType: 'html',
		success: function () {
			$('.middle').fadeOut('slow', function () {
				window.location.replace('https://wahl2017.gerritalex.de/');
			});

		},
		error: function () {
			$('.middle').empty();
			$('.middle').css('display', 'none');
			$('.middle').append('<div class="middle-top">Der Server ist gerade unter hoher Last und kann Ihre Anfrage leider nicht durchführen. Bitte versuchen Sie es erneut.<br /><a href="https://wahl2017.gerritalex.de">Bitte klicken</a></span></div>');
			$('.middle').fadeIn('fast');
		}
	});
}