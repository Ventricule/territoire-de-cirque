<?php snippet('header') ?>
<?php snippet('menus/menu') ?>
<?php
	$logo = $page->file($page->logo());
	//$wide = $logo->ratio() > 1.2 ? 'wide-logo' : '' ;
	$wide = 'wide-logo' ;
?>

	<div id="left-side">
			<?php snippet('menus/menu-second', array('page' => $page)) ?>
	</div>

  <main id="panel" class="main cf" role="main">	
		<div class="cartouche <?= $wide ?> cf">
			<div class="row"><div class="cell"><h1><?= $page->title() ?></h1></div></div>
			<div class="row trame50"><div class="cell"><h3><?= $page->complement() ?></h3></div></div>
			<div class="row emphase">
				<div class="column logo">
					<div class="cell">
						<figure class="logo"><?= $logo->resize(400)->html() ?></figure>
					</div>
				</div>
				<div class="column">
					<div class="cell">
						<span><?= $page->adresse()->kt() ?></span>
					</div>
				</div>
				<div class="column">
					<div class="cell">
						<ul class="contact">
						<?php	foreach( $page->contacts()->yaml() as $contact ) :	?>
								<li><a href="mailto:<?= $contact['email'] ?>"><?= $contact['nom'] ?></a>, <?= $contact['qualite'] ?> <br> <?= $contact['numero'] ?></li>
						<?php endforeach;		?>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="cell">
					<ul id="activites">
						<?php foreach($page->activites()->split() as $activite)	echo "<li class='emphase'>".id2title($activite)."</li>"; ?>
					</ul>
				</div>
			</div>
			<div class="row emphase">
				<div class="column">
					<div class="cell">
						<span>Créé en <?= $page->date_creation() ?> — Membre depuis <?= $page->date_tdc() ?></span>
					</div>
				</div>
				<div class="column">
					<div class="row">
						<?php if ($page->facebook() != '') : ?>
							<div class="column">
								<div class="cell text-center"><a href="<?= $page->facebook() ?>" target="_blank">facebook</a></div>
							</div>
						<?php endif ?>
						<div class="column">
							<div class="cell text-center trame50"><a href="<?= $page->website() ?>" target="_blank"><?= rtrim(str_replace(array('www.', 'http://', 'https://'), '', $page->website()), '/ ') ?></a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="text-wrapper">
			<?= $page->presentation()->kt() ?>
		</div>
		
		<div class="forme ligne"></div>
		
		<div id="actualites-membre">
			<?php $ds    = DS == '/' ? ':' : ';'; $membre = page('membres/les-membres/'.$page->uid())->uid() ; ?>
			<?php snippet('modules/actualites-membre', array('membre' => $membre )) ?>
			<h4><a class="lien-actus" href="<?= page('membres/actualites-des-membres')->url(). '/membre' . $ds . $membre ?>">Voir toutes les actualités du membre</a></h4>
		</div>
		
		
		
  </main>

	<div id="right-side">
		<?php snippet('modules/gallery', array('page' => $page)) ?>
	</div>

<?php snippet('footer') ?>