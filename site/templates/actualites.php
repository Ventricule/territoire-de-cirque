<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

	<div id="left-side">
		<?php snippet('menus/menu-second') ?>
	</div>

  <main id="panel" class="main wide cf" role="main">
		<?php snippet('actualites/filters', array('selectedFilter' => $filteredBy)) ?>
		<div class="events">

			<!--
			<div class="direction <?= $direction ?>">

				<a href='?direction=futur' class="futur-wrapper">
					<span class='arrow arrow-futur'></span>
					<span class='text-futur name'>Futur</span>
				</a>
				<a href='?direction=passe' class="passe-wrapper">
					<span class='text-past name'>Passé</span>
					<span class='arrow arrow-past'></span>
				</a>

			</div>
			-->

			<?php
			$pMonth = false;
			foreach($events as $event):
				$month = (string)$event->date('%m', 'start_date');
				if( $month != $pMonth ):
					$pMonth = $month;
					snippet('actualites/month', array('event' => $event));
				endif;
				snippet('actualites/event', array('event' => $event));
			endforeach;
			?>
		</div>

  </main>



<?php snippet('footer') ?>
