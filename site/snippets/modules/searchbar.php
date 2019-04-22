<div id="searchbar">
	<form action="<?= $page->url() ?>" method="get">
		<input type="search" name="q" value="" placeholder="Rechercher" autocomplete="off">
		<div class="btn-more"><span>+</span> <span>Recherche avancée</span></div>
		<input type="hidden" name="directory" value="<?= $page->uri() ?>">
		<div class="more">
			<div class="here">
				<input type="checkbox" name="here" id="here" /> <label for="here">Dans ce<br>dossier</label>
			</div>
			<select name="tag">
				<option value='' selected>Mot-clé</option>
				<?php foreach (page('ressources')->index()->pluck('tags', ',', true) as $tags) : ?>
					<option value="<?= $tags ?>"><?= $tags ?></option>
				<?php endforeach ?>
			</select>
			<select name="author">
				<option value=''>Auteur</option>
				<?php foreach (page('ressources')->index()->pluck('author', ',', true) as $author) : ?>
					<option value="<?= html($author) ?>"><?= html($author) ?></option>
				<?php endforeach ?>
			</select>
			<select name="member">
				<option value=''>Membre</option>
				<?php foreach (page('ressources')->index()->pluck('membre', ',', true) as $member) : ?>
					<?php 
					$pagemembre = page('membres/les-membres/'.$member);
					$member_full_name = $pagemembre ? $pagemembre->title() : $member; ?>
					<option value="<?= $member ?>"><?= $member_full_name ?></option>
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