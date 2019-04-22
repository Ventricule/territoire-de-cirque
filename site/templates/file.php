<?php snippet('header') ?>
<?php snippet('menus/menu') ?>
<?php
$membres = $page->membre()->split();
foreach($membres as $key=>$membre):
	$membres[$key] = page('membres/les-membres/'.$membre)->title();
endforeach;
$membres = implode(', ', $membres);
$infos = [ $page->date('%d.%m.%Y'), implode(', ', $page->author()->split()), $membres ] ;
?>

	<div id="left-side">
		<?php snippet('menus/menu-second') ?>
	</div>

  <main id="panel" class="main wide cf" role="main">
		
		<?php if ( (string)$page->une() ) : ?>
			<?php $une = $page->file($page->une()); ?>
			<div class="cover">
				<figure style="<?= $une ? 'background-image:url(' . $une->resize(1000)->url() . ')' : '' ; ?>">
					<figcaption><?= $une->caption()->kt() ?></figcaption>
				</figure>
			</div>
		<?php endif ?>
		<div class="file-content">
			<h1 class="main-title"><?= $page->title(); ?></h1>
			<div class="h3 introduction"><?= $page->introduction()->kt() ?></div>
			<div class="container">
				<div class="file-infos">
					<?php
					foreach($infos as $info):
						echo "<p class='small'>$info</p>";
					endforeach;
					?>
				</div>
				<div class="text-wrapper">
					<?= $page->text()->kt() ?>
				</div>
			</div>
		</div>
  </main>

<?php snippet('footer') ?>