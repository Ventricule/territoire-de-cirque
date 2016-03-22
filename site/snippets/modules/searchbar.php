<div id="searchbar">
	<form>
		<input type="search" name="q" value="" placeholder="Rechercher">
		<div class="btn-more"><span>+</span> <span>Recherche avancée</span></div>
		<div class="more">
			<div class="here">
				<input type="checkbox" name="here" id="here" /> <label for="here">Dans ce<br>dossier</label>
			</div>
			<select name="tags">
				<option label="Tags">Mot-clé</option>
					<?php foreach (page('ressources')->index()->pluck('tags', ',', true) as $tags) : ?>
				<option value="<?= $tags ?>"><?= $tags ?></option>
				<?php endforeach ?>
			</select>
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
		</div>
		
		<input type="submit" value=">">
	</form>
</div>