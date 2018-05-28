<ul class="cf">
	<?php foreach( $items as $item ) :	?>

		<?php
		if( in_array($item->intendedTemplate(), array('file', 'action') ) ) :
			$formes = array('cercle.png', 'arc.png', 'losange.png', 'ellipse.png', 'chapiteau.png', 'demicercle.png');
			$choixpeau = strlen( (string)$item->title() ) % count($formes);
			$forme = $formes[$choixpeau] ;
			$cover = $kirby->urls()->assets() . '/images/' . $forme;
			$cover = "<figure class='forme' style='background-image:url($cover);'></figure>";
			$file = $item->fichier() ? $item->file($item->fichier()) : false;
			$type = $item->intendedTemplate() == 'file' ? "Article" : ucfirst($item->intendedTemplate());
			$type = $file ? ucfirst($file->type()) : $type;
			$url = $file ? $file->url() : $item->url();
			$target = $file ? 'target="_blank"' : false ;
			$membres = $item->membre()->split();
			foreach($membres as $key=>$membre):
				$membres[$key] = page('membres/les-membres/'.$membre)->title();
			endforeach;
			$membres = implode(', ', $membres);
			$infos = [ $item->date('%m.%Y'), implode(', ', $item->author()->split()) ] ;
		else:
			$formes = array('trame-traits-transparent.png', 'trame-vibration-transparent.png');
			//$formes = array('trame-folder.png');
			$choixpeau = strlen( (string)$item->title() ) % count($formes);
			$forme = $formes[$choixpeau] ;
			$cover = $kirby->urls()->assets() . '/images/' . $forme;
			$cover = "<figure class='forme' style='background-image:url($cover);'></figure>";
			$type = "Dossier";
			$url = $item->url();
			$file = $membres = $target = false;
			$infos = [ $item->exergue()->kt() ] ;
		endif;

		?>

		<li data-uid='<?= $item->uid() ?>' class="<?= $item->intendedTemplate() ?> <?= $file ? 'download' : ''; ?>">
			<a href="<?= $url ?>" <?= $target ?>>
				<div class="icon"><?= $cover ?><h3><span class="type"><?= $type ?></span><span class="name"><?= $item->title() ?></span></h3></div>
			</a>
			<div class="caption">
				<?php
				
				foreach($infos as $info):
					echo "<div class='small'>$info</div>";
				endforeach;
				?>
			</div>
		</li>

	<?php endforeach	?>
</ul>