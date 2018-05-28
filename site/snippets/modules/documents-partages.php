<div class="docs attachment documents-partages-liste">
	
	
	<p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Pensez à envoyer vos pièces jointes dans les <a href="<?= page('espace-membre/documents-partages')->url() ?>">documents partagés</a> avant de commencer à écrire.</p>
	
	
	<div class="selected-documents cf">
		<div class="cf"><p><i class="fa fa-paperclip" aria-hidden="true"></i> Pièces jointes</p></div>
	</div>
	
	

			
			
	
	<ul>
	
	
		<li>
			<span><i class="fa fa-plus" aria-hidden="true"></i><i class="fa fa-minus" aria-hidden="true"></i> Document partagés</span>
			<ul>
				<?php foreach(page('documents-partages')->children() as $folder): ?>
				<li>
					<span><i class="fa fa-folder-o" aria-hidden="true"></i><i class="fa fa-folder-open-o" aria-hidden="true"></i> <?= $folder->title() ?></span>
					<ul class="cf">
						<?php foreach($folder->files() as $file): ?>
							<li class="item" data-url="<?= $file->uri() ?>">
								<figure class="cf">
									<?php if ($file->type() == 'image'): ?>
										<?= thumb($file, array('width' => 64, 'height' => 64, 'crop' => true)) ?> 
									<?php else: ?>
										<span class='extension'><?= strtoupper($file->extension()) ?></span>
									<?php endif ?>
									<figcaption><?= $file->filename() ?></figcaption>
								</figure>
							</li>
						<?php endforeach ?>
					</ul>
				</li>
				<?php endforeach ?>
			</ul>
		</li>
		
		<li class="submit">
			<?php if ($comments->validPreview()): ?>
				<input type="submit" name="<?php echo $comments->submitName() ?>" value="Envoyer" id="submit">
			<?php endif ?>
			<input type="submit" name="<?php echo $comments->previewName() ?>" value="Prévisualiser">
		</li>
		
	</ul>
</div>