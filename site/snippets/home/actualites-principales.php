<div id='actualites-principales'>
	
	<div id="tdc-accroche">
		<h4>Association<br>de structures<br>de production et de diffusion<br>artistique</h4>
		<div class="forme chapiteau"></div>
	</div>

	<?php
	foreach($page->actualites_principales()->toStructure()->limit(2) as $actu) :
	?>

	<div class="actu cf">
		<figure>
			<?php
			if($image = (string)$actu->image()):
				if( $image = $page->file($image) ):
					echo $image->crop(800, 528)->html();
					echo "<figcaption>" . $image->caption() . "</figcaption>";
				endif;
			elseif($video = (string)$actu->video()):
				echo $actu->video()->oembed();
				//echo vimeo($actu->video());
			else:
				if($forme = (string)$actu->forme()):
					echo "<div class='forme $forme'></div>";
				endif;
			endif;
			?>
			
		</figure>
		<div class="texte">
			<h3><?= $actu->rubrique() ?></h3>
			<?= $actu->texte()->kt() ?>
		</div>
	</div>


	<?php
	endforeach;
	?>
	
	<?= snippet("home/reseaux") ?>
	
</div>