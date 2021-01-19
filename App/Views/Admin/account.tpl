<h1>Gegevens aanpassen</h1>

<p>
Hieronder kun je het email adres en de naam aanpassen.
Let op: bij het aanpassen van het email adres veranderd ook je login naam in dit email adres.
</p>

<form method="post" action="/inloggen/account/" id="formSettings">
	<label for="naam">Naam</label><br>
	<input type="text" name="naam" minlength="4" id="inputName" value="{$form['naam']}" required><br>
	<label for="email">E-mail</label><br>
	<input type="email" name="email" id="inputEmail" value="{$form['email']}" required><br>
	<input type="submit" name="opslaan" value="Opslaan" class="button">
</form>
