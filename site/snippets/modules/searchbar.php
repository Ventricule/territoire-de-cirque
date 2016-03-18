<div id="searchbar">
	<form>
		<input type="search" name="q" value="" placeholder="Rechercher">
		<select name="author">
			<option label="Auteur">Auteur</option>
			<?php foreach (page('ressources')->index()->pluck('author', ',', true) as $author) : ?>
				<option value="<?= html($author) ?>"><?= html($author) ?></option>
			<?php endforeach ?>
		</select>
		<select name="member">
			<option label="Membre">Membre</option>
				<?php foreach (page('ressources')->index()->pluck('member', ',', true) as $member) : ?>
			<option value="<?= $member ?>"><?= $member ?></option>
			<?php endforeach ?>
		</select>
		<select name="year">
			<option value="">Année</option>
			<?php for($i = 2009 ; $i <= date("Y") ; $i++) : ?>
				<option value="<?= $i ?>"><?= $i ?></option>
			<?php endfor ?>
		</select>
		<input type="submit" value=">">
	</form>
</div>