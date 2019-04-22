<div id='actualites-secondaires' class="cf">

	<?php
	foreach($page->actualites_secondaires()->toStructure()->limit(3) as $actu) :
	?>

	<div class="actu">
		<figure>
			<?php
			if($image = (string)$actu->image()):
				if( $image = $page->file($image) ):
					echo $image->crop(800, 528)->html();
					echo "<figcaption>" . $image->caption() . "</figcaption>";
				endif;
			elseif($video = (string)$actu->video()):
				echo $actu->video()->embed();
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
	
</div>