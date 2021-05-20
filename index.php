<html>
    <head>
        <title>PPE 2</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles\cssbase.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Catamaran&display=swap" rel="stylesheet">
		<script src="js/jquery-3.5.1.min.js"></script>
		<link href='js/fullcalendar/core/main.css' rel='stylesheet' />
		<link href='js/fullcalendar/daygrid/main.css' rel='stylesheet' />
		<script src='js/fullcalendar/core/main.js'></script>
		<script src='js/fullcalendar/daygrid/main.js'></script>
        
    </head>
    <body>
		<table align="right">
			<tr>
				<td>
					<a href="include/php/register.php" class="inscription"> Inscription &nbsp;</a>
				</td>
				<td>
					<a href="include/php/Connexion.php" class="connexion"> Connexion</a>
				</td>
			</tr>
		</table>
		<script>
			document.addEventListener('DOMContentLoaded', function() {
			var calendarEl = document.getElementById('calendar');

			var calendar = new FullCalendar.Calendar(calendarEl, {
			plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
			defaultView: 'dayGridMonth',
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'dayGridMonth,timeGridWeek,timeGridDay'
			},
			events: [
			{
				title: 'Passage PPE 2',
				start: '2020-06-16'
			},
			{
				title: 'Stage',
				start: '2020-05-25',
				end: '2020-06-27'
			}
			]
			});

			calendar.render();
			});
		</script>
        <div class="corp">
            <a class="ecriture"> <h1>PPE 2</h1> </a>
            <a class="barre"></a>
            <a class="ecriture"> <h1>ESPACE DE TRAVAIL</h1> </a>
			<div class="saut3"></div>
			<div class="ecriture3">
				<div id='calendar'></div>
			</div>
			<div class="saut3"></div>
		</div>
    </body>
</html>
