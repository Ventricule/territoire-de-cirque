<div id='actualites-principales'>

	<div id="tdc-accroche">
		<h4>Association<br>de structures<br>de production et de diffusion<br>artistique</h4>
		<div class="forme chapiteau"></div>
	</div>

	<?php
	foreach($page->actualites_principales()->toStructure()->limit(2) as $actu) :
	?>

	<div class="actu cf">

			<?php
			if($image = (string)$actu->image()->html()):
				if( $image = $page->file($image) ):
					echo '<figure>';
					echo $image->crop(800, 528)->html();
					echo "<figcaption>" . $image->caption() . "</figcaption>";
					echo '</figure>';
				endif;
			elseif($video = (string)$actu->video()):
				echo $actu->video()->embed();
			else:
				if($forme = (string)$actu->forme()):
					echo "<figure><div class='forme $forme'></div></figure>";
				endif;
			endif;
			?>


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
