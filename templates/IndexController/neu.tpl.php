<h2>Neue Person hinzufügen:</h2>
<form action="index.php?action=neu" method="POST">
	<input type="text" name="name" placeholder="Name"/>
	<input type="text" name="vorname" placeholder="Vorname"/>
	<br /><br />
	<input type="text" name="adresse[strasse]" placeholder="Straße"/>
	<input type="text" name="adresse[hnr]" placeholder="Hausnummer"/>
	<br />
	<input type="text" name="adresse[plz]" placeholder="Postleitzahl"/>
	<input type="text" name="adresse[ort]" placeholder="Ort"/>
	<br /><br />
	<input type="submit" value="Person anlegen"/>
</form>