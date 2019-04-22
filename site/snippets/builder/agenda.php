<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
  <tr>
    <td align="center" valign="top" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
      <table class="flexibleContainer" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
        <tr>
          <td class="flexibleContainerCell" align="center" valign="top" width="600" style="padding-top: 0px;padding-right: 0px;padding-left: 0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">

            <?php
            $events = page('membres/actualites-des-membres')->children()->visible()->filterBy('start_date', '>', $data->from())->filterBy('start_date', '<', $data->to())->sortBy('start_date');
            $num = 0;
            foreach($events as $event):

             $membres = array();
             foreach($event->membre()->split() as $membre):
            	 if ($pagemembre = page('membres/les-membres/'.$membre)):
            		 $membres[] = $pagemembre->title() . '<br>' . $pagemembre->ville()." ({$pagemembre->departement()}) ";
            	 else:
            		 $membres[] = $membre;
            	 endif;
             endforeach;
             $membres = implode($membres, ", ");
             $start = $event->date('%d.%m', 'start_date');
             $end = $event->date('%d.%m', 'end_date');
             $date = ($end && $end != $start) ? $start . ' — ' . $end : $start ;
             $type = $event->type();
             $titre = $event->title()->h();
             $soustitre = $event->subtitle()->h();
             $photo = $event->file( $event->visuel() ) ?: false ;
             $creditphoto = $photo ? $photo->caption()->h() : false ;
             $url = $event->url();
             ?>

              <table class="flexibleContainer" align="Left" border="0" cellpadding="0" cellspacing="0" width="200" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">

            		<tr>

                  <td class="textContent"  valign="top" style="font-family:<?= $page->parent()->letter_tfont() ?>; font-size:16px; line-height:125%; text-align:Left; color:#404040; padding-bottom:20px;">

                    <?php if($photo): ?>
                    <a href="<?= $url ?>">
            					<img src="<?= $photo->crop(180,100)->url() ?>" width="100%" class="flexibleImage" title="<?= $creditphoto ?>" style="width:180px;" />
            				</a>
            				<?php else: ?>
            				<a href="<?= $url ?>">
            					<div style="background-image:url('https://www.territoiresdecirque.fr/assets/images/diffusion.png'); width:180px; height:100px;" class="flexibleImage">&nbsp;</div>
            				</a>
                    <?php endif ?>

            				<h3><?= $date ?>&nbsp;</h3>

            				<h5><a href="<?= $url ?>"><?= $titre ?></a></h5>

            				<p class="small"><?= $membres ?>&nbsp;</p>

                  </td>

            		</tr>

              </table>

            	<?php
            	if ($num == 2) :
            		echo "<p class='clear'>&nbsp;</p>";
            		$num = 0;
            	else :
            		$num++;
            	endif;
            	endforeach;
            	?>

          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
