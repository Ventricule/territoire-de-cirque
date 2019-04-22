
                    <?php if($page->parent()->letter_logo()->isNotEmpty()): ?>
                    <?php $image = $page->parent()->letter_logo(); ?>
                    <!-- Module -->
                    <!-- Newsletter logo -->
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr><td class="imageContent" align="center" valign="top" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">

                    <?php $logo = $page->parent()->letter_logo(); ?>
                    <?php if($logo): ?>
                    <img src="<?= $logo->resize(560)->toFile()->url() ?>" width="560" class="flexibleImage" style="max-width:560px;" />
                    <?php endif ?>

                    <h5 style="text-align: center;"><?= $page->title()->h() ?></h5>

                    </td></tr>
                    </table>
                    <?php endif; ?>
