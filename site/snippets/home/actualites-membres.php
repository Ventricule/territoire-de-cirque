<div id='actualites-membres' class="cf">
	
	<div class="background"></div>

	<div class="event chapitre">
		<h4 class="event-type"><a href="<?= page('membres/actualites-des-membres')->url() ?>">Actualités<br> des membres</a></h4>
	</div>

	<?php
	$events = page('membres/actualites-des-membres')
						->children()
						->visible()
						->filterBy('start_date', '>=', date('Y-m-d') )
						->sortBy('start_date')
						->limit(8);
	foreach($events as $event) :
	?>

	<div class="event">
		<h2 class="event-date">
			<?= $event->date('%d.%m', 'start_date') ?>
			<?php if($enddate = $event->date('%d.%m', 'end_date')) echo ' — ' . $enddate ; ?>
		</h2>
		<h4 class="event-membre"><?= page('membres/les-membres/'.$event->membre())->title() ?></h4>
		<h4 class="event-type"><?= $event->type() ?></h4>
		<p class="event-title"><a href="<?= $event->url() ?>"><?= $event->title() ?></a></p>
		<p class="event-subtitle"><?= $event->subtitle() ?></p>
	</div>


	<?php
	endforeach;
	?>

</div>