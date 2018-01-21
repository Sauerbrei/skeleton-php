
	<h2>Adresse:</h2>
	<ul>
		<li>Anschrift: <?=$person->getAdresse()->getStrasse(). ' '.$person->getAdresse()->getHnr()?></li>
		<li>PLZ: <?=$person->getAdresse()->getPlz(). ' '.$person->getAdresse()->getOrt()?></li>
	</ul>
