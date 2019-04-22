
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
              <?php if($image->extension() == 'gif'): ?>
                <img src="<?= $image->url() ?>" width="560" class="flexibleImage" style="max-width:560px;" />
              <?php else: ?>
                <img src="<?= $image->resize(560)->url() ?>" width="560" class="flexibleImage" style="max-width:560px;" />
              <?php endif; ?>
            <?php endif ?>
            <p class="small colored"><?= $data->caption()->h() ?></p>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
