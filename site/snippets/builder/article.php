
<!-- Module -->
<!-- Rubriaue -->
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td align="center" valign="top" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
      <table class="flexibleContainer" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
        <tr>
          <td class="textContent" align="center" valign="top" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; padding-bottom: 40px;">
            <?php $image = $page->image($data->img()); ?>
            <?php if($image): ?>
            <img src="<?= $image->resize(280)->url() ?>" width="280" class="flexibleImage <?= $data->float() ?>" style="max-width:280px;" />
            <?php endif ?>
            <h5><?= $data->subtitle()->h() ?></h5>
            <h4><?= $data->title()->h() ?></h4>
            <?= $data->text()->kt() ?>
            <?php if($data->link_text()->isNotEmpty()): ?>
            <p><a href="<?= $data->link_url() ?>"><?= $data->link_text()->h() ?>&nbsp;&rarr;</a></p>
            <?php endif ?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
