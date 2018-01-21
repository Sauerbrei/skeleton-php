<ul>
	<?php foreach ($personen AS $id => $person): ?>
	<li>
		<a href="index.php?action=zeige&id=<?=$id?>">
			<?=$person->getName()?>, <?=$person->getVorname()?>
		</a>
	</li>
	<?php endforeach;?>
</ul>
